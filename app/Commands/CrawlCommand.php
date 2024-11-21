<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use GuzzleHttp\Client;
use DOMDocument;
use DOMXPath;

class CrawlCommand extends BaseCommand
{
    protected $group       = 'Custom';
    protected $name        = 'crawl:event';
    protected $description = 'CU 및 GS25 이벤트 페이지를 자동 크롤링합니다.';

    public function run(array $params)
    {
        $startIdx = $params[0] ?? 1066; // 시작 인덱스
        $endIdx = $params[1] ?? $startIdx + 100; // 종료 인덱스 (기본: 시작 인덱스 + 10)

        CLI::write("크롤링 범위: {$startIdx}부터 {$endIdx}까지", 'green');

        $client = new Client();
        $db = \Config\Database::connect();
        $builder = $db->table('event_crawling');

        for ($idx = $startIdx; $idx <= $endIdx; $idx++) {
            $url = "https://cu.bgfretail.com/brand_info/news_view.do?category=brand_info&depth2=5&idx={$idx}";

            CLI::write("URL 크롤링 시작: {$url}", 'green');

            try {
                $response = $client->get($url);
                $html = $response->getBody()->getContents();

                // HTML 파싱
                $dom = new DOMDocument();
                @$dom->loadHTML($html);
                $xpath = new DOMXPath($dom);

                // 제목 크롤링
                $titleNode = $xpath->query('//div[@class="relCon"]//th[1]');
                $title = $titleNode->item(0) ? trim($titleNode->item(0)->textContent) : null;

                // 날짜 크롤링
                $dateNode = $xpath->query('//div[@class="relCon"]//th[@class="date"]');
                $eventDate = $dateNode->item(0) ? trim($dateNode->item(0)->textContent) : null;

                // 이미지 URL 크롤링
                $imageNode = $xpath->query('//div[@class="relCon"]//img');
                $imageUrl = $imageNode->item(0) ? $imageNode->item(0)->getAttribute('src') : null;

                if ($imageUrl) {
                    $imageUrl = filter_var($imageUrl, FILTER_VALIDATE_URL) ? $imageUrl : 'http://cdn2.bgfretail.com' . $imageUrl;
                }

                // 중복 체크
                $exists = $builder->where('title', $title)->countAllResults();
                if ($exists > 0) {
                    CLI::write("중복 데이터 발견, 건너뜀: {$title}", 'yellow');
                    continue;
                }

                // 데이터베이스 저장
                if ($title && $eventDate && $imageUrl) {
                    $builder->insert([
                        'brand' => 'CU',
                        'title' => $title,
                        'image_url' => $imageUrl,
                        'event_period' => $eventDate,
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
