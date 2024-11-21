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
    protected $description = 'CU 및 GS25 이벤트 페이지를 크롤링합니다.';

    public function run(array $params)
    {
        $url = $params[0] ?? 'https://cu.bgfretail.com/brand_info/news_view.do?category=brand_info&depth2=5&idx=1066';

        CLI::write("URL 크롤링 시작: {$url}", 'green');

        $client = new Client();
        try {
            $response = $client->get($url);
            $html = $response->getBody()->getContents();

            // HTML 파싱
            $dom = new DOMDocument();
            @$dom->loadHTML($html);
            $xpath = new DOMXPath($dom);

            // 제목 크롤링
            $titleNode = $xpath->query('//div[@class="relCon"]//th[1]');
            $title = $titleNode->item(0) ? $titleNode->item(0)->textContent : '제목 없음';

            // 날짜 크롤링
            $dateNode = $xpath->query('//div[@class="relCon"]//th[@class="date"]');
            $eventDate = $dateNode->item(0) ? $dateNode->item(0)->textContent : '날짜 없음';

            // 이미지 URL 크롤링
            $imageNode = $xpath->query('//div[@class="relCon"]//img');
            $imageUrl = $imageNode->item(0) ? $imageNode->item(0)->getAttribute('src') : null;

            if ($imageUrl) {
                $imageUrl = filter_var($imageUrl, FILTER_VALIDATE_URL) ? $imageUrl : 'http://cdn2.bgfretail.com' . $imageUrl;
            }

            // 데이터 출력
            CLI::write("제목: {$title}", 'yellow');
            CLI::write("이벤트 날짜: {$eventDate}", 'yellow');
            CLI::write("이미지 URL: {$imageUrl}", 'yellow');

            // 데이터베이스에 저장
            $db = \Config\Database::connect();
            $builder = $db->table('event_crawling'); // 테이블 이름 수정

            $builder->insert([
                'brand' => 'CU',
                'title' => $title,
                'image_url' => $imageUrl,
                'event_period' => $eventDate,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            CLI::write('데이터베이스 저장 완료.', 'green');

        } catch (\Exception $e) {
            CLI::error("크롤링 실패: " . $e->getMessage());
        }
    }
}
