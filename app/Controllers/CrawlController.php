<?php

namespace App\Controllers;

use App\Models\EventModel;
use CodeIgniter\CLI\CLI;
use CodeIgniter\Database\ConnectionInterface;

class CrawlController extends BaseController
{
    protected $eventModel;
    protected $db;

    public function __construct()
    {
        $this->eventModel = new EventModel();
        $this->db = \Config\Database::connect(); // DB 연결
    }

    public function crawlCU()
    {
        ini_set('max_execution_time', 3000); // 최대 실행 시간 300초
        $baseUrl = 'https://pyony.com/brands/cu/';
        $page = 1;
        $totalInserted = 0;
        $totalUpdated = 0;

        while (true) {
            $url = $baseUrl . "?page=" . $page;
            CLI::write("크롤링 중: $url", 'green');

            $html = $this->fetchPageContent($url);
            $eventData = $this->parseEventData($html);

            if (empty($eventData)) {
                CLI::write("마지막 페이지 도달. 크롤링 종료.", 'yellow');
                break;
            }

            [$inserted, $updated] = $this->saveOrUpdateEventData($eventData);
            $totalInserted += $inserted;
            $totalUpdated += $updated;

            CLI::write("페이지 $page 크롤링 완료: $inserted 건 삽입, $updated 건 업데이트됨.", 'blue');
            $page++;
        }

        // 완료 시간 기록
        $this->logCrawlCompletion('CU');

        CLI::write("크롤링 완료: 총 $totalInserted 건 삽입, $totalUpdated 건 업데이트.", 'blue');
    }

    private function fetchPageContent($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 300);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; PHP cURL)');
        $content = curl_exec($ch);
        curl_close($ch);

        return mb_convert_encoding($content, 'HTML-ENTITIES', 'auto');
    }

    private function parseEventData($html)
    {
        $dom = new \DOMDocument('1.0', 'UTF-8');
        @$dom->loadHTML($html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $xpath = new \DOMXPath($dom);
        $data = [];

        $items = $xpath->query('//div[contains(@class, "col-md-6")]');
        foreach ($items as $item) {
            $brand = 'CU';
            $productName = trim($xpath->query('.//strong', $item)->item(0)->nodeValue);
            $eventType = trim($xpath->query('.//span[contains(@class, "badge bg-cu")]', $item)->item(0)->nodeValue);
            $priceRaw = trim($xpath->query('.//i[contains(@class, "fa-coins")]/following-sibling::text()[1]', $item)->item(0)->nodeValue);
            $price = str_replace(['원', ',', ' '], '', $priceRaw);
            $originalPriceRaw = $xpath->query('.//span[@class="text-muted small"]', $item)->item(0);
            $originalPrice = $originalPriceRaw ? str_replace(['(', ')', '원', ',', ' '], '', $originalPriceRaw->nodeValue) : null;
            $imageUrl = 'https:' . $xpath->query('.//img', $item)->item(0)->getAttribute('src');

            $data[] = [
                'brand' => $brand,
                'product_name' => $productName,
                'event_type' => $eventType,
                'price' => $price ? (float)$price : null,
                'original_price' => $originalPrice ? (float)$originalPrice : null,
                'discount_rate' => null,
                'image_url' => $imageUrl,
            ];
        }

        return $data;
    }

    private function saveImage($url, $folder)
    {
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        $filename = $folder . basename($url);
        if (file_exists($filename)) {
            CLI::write("이미지 존재: $filename. 다운로드 건너뜀.", 'yellow');
            return $filename;
        }

        $ch = curl_init($url);
        $fp = fopen($filename, 'wb');
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_TIMEOUT, 300);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; PHP cURL)');
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);

        CLI::write("이미지 저장 완료: $filename", 'green');
        return $filename;
    }

    private function saveOrUpdateEventData($data)
    {
        $inserted = 0;
        $updated = 0;
        $imageFolder = 'public/img/cu/';

        foreach ($data as $event) {
            $existing = $this->eventModel
                ->where('brand', $event['brand'])
                ->where('product_name', $event['product_name'])
                ->first();

            if ($existing) {
                if (
                    $existing['event_type'] !== $event['event_type'] ||
                    $existing['price'] !== $event['price'] ||
                    $existing['original_price'] !== $event['original_price']
                ) {
                    $event['image_url'] = $this->saveImage($event['image_url'], $imageFolder);
                    $this->eventModel->update($existing['id'], $event);
                    $updated++;
                }
            } else {
                $event['image_url'] = $this->saveImage($event['image_url'], $imageFolder);
                $this->eventModel->insert($event);
                $inserted++;
            }
        }

        return [$inserted, $updated];
    }

    private function logCrawlCompletion($brand)
    {
        $builder = $this->db->table('crawl_logs_ease');

        $builder->insert([
            'brand' => $brand,
            'completed_at' => date('Y-m-d H:i:s'),
        ]);

        CLI::write("크롤링 완료 시간 기록: " . date('Y-m-d H:i:s'), 'green');
    }
}
