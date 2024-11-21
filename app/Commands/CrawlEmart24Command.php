<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use GuzzleHttp\Client;
use DOMDocument;
use DOMXPath;

class CrawlEmart24Command extends BaseCommand
{
    protected $group       = 'Custom';
    protected $name        = 'crawl:emart24';
    protected $description = 'Emart24 이벤트 페이지를 크롤링합니다.';

    public function run(array $params)
    {
        $startIdx = $params[0] ?? 3265; // 기본 시작 인덱스
        $endIdx = $params[1] ?? $startIdx + 2; // 기본 종료 인덱스

        CLI::write("크롤링 범위: {$startIdx}부터 {$endIdx}까지", 'green');

        $client = new Client();
        $db = \Config\Database::connect();
        $builder = $db->table('event_crawling');

        for ($idx = $startIdx; $idx <= $endIdx; $idx++) {
            $url = "https://emart24.co.kr/event/{$idx}";

            CLI::write("URL 크롤링 시작: {$url}", 'green');

            try {
                $response = $client->get($url, ['http_errors' => false]);

                if ($response->getStatusCode() !== 200) {
                    CLI::write("페이지를 찾을 수 없음: {$url}", 'red');
                    continue;
                }

                $html = $response->getBody()->getContents();

                // HTML 파싱
                $dom = new DOMDocument();
                @$dom->loadHTML($html);
                $xpath = new DOMXPath($dom);

                // 이벤트 상태 (진행중, 종료)
                $statusNode = $xpath->query('//div[@class="etitleWrap"]//p[contains(@class, "ing") or contains(@class, "endEventobj")]');
                $status = $statusNode->item(0) ? trim($statusNode->item(0)->textContent) : '상태 없음';

                // 제목 크롤링
                $titleNode = $xpath->query('//div[@class="etitleWrap"]//div[@class="titleWrap"]/p[2]/a');
                $title = $titleNode->item(0) ? trim($titleNode->item(0)->textContent) : null;

                // 이벤트 기간 크롤링
                $dateNode = $xpath->query('//div[@class="etitleWrap"]//p[@class="eventDate"]');
                $eventPeriod = $dateNode->item(0) ? trim($dateNode->item(0)->textContent) : null;

                // 이미지 URL 크롤링
                $imageNode = $xpath->query('//div[@class="contentWrap banner"]//img');
                $imageUrl = $imageNode->item(0) ? $imageNode->item(0)->getAttribute('src') : null;

                if ($imageUrl) {
                    // 이미지 경로 보정
                    $imageUrl = filter_var($imageUrl, FILTER_VALIDATE_URL) ? $imageUrl : 'https://emart24.co.kr' . $imageUrl;
                }

                // 데이터 출력
                CLI::write("제목: {$title}", 'yellow');
                CLI::write("이벤트 상태: {$status}", 'yellow');
                CLI::write("이벤트 기간: {$eventPeriod}", 'yellow');
                CLI::write("이미지 URL: {$imageUrl}", 'yellow');

                // 중복 체크
                if ($title) {
                    $exists = $builder->where('title', $title)->countAllResults();
                    if ($exists > 0) {
                        CLI::write("중복 데이터 발견, 건너뜀: {$title}", 'yellow');
                        continue;
                    }
                }

                // 데이터베이스 저장
                if ($title && $eventPeriod && $imageUrl) {
                    $builder->insert([
                        'brand' => 'Emart24',
                        'title' => $title,
                        'image_url' => $imageUrl,
                        'event_period' => $eventPeriod,
                        'status' => $status,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                    CLI::write("데이터 저장 완료: {$title}", 'green');
                } else {
                    CLI::write("필수 데이터 누락: {$url}", 'red');
                }

            } catch (\Exception $e) {
                CLI::write("크롤링 실패 (URL: {$url}): " . $e->getMessage(), 'red');
            }
        }

        CLI::write("크롤링 완료: {$startIdx}부터 {$endIdx}까지", 'green');
    }
}
