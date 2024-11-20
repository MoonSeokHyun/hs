<?php

namespace App\Controllers;

use CodeIgniter\CLI\CLI;

class CrawlController extends BaseController
{
    protected $db;

    public function __construct()
    {
        ini_set('memory_limit', '2G'); // PHP 메모리 할당 2GB
        $this->db = \Config\Database::connect(); // DB 연결
    }

    public function crawlSearch()
    {
        ini_set('max_execution_time', 0); // 실행 시간 제한 해제
        $baseUrl = 'https://pyony.com/search/'; // 크롤링 대상 URL
        $page = 1;
        $totalPages = 380; // 총 예상 페이지 수

        $statusSummary = [
            'inserted' => 0,
            'updated' => 0,
            'skipped' => 0,
        ];

        CLI::write("Search 크롤링 시작...", 'green');

        while ($page <= $totalPages) {
            $url = $baseUrl . "?page=" . $page;
            CLI::write("\n크롤링 중: $url", 'green');

            // HTML 가져오기
            $html = $this->fetchPageContent($url);

            // 데이터 파싱
            $eventData = $this->parseEventData($html);

            // 데이터 저장 및 업데이트
            if (!empty($eventData)) {
                $status = $this->saveOrUpdateEventData($eventData);
                $statusSummary['inserted'] += $status['inserted'];
                $statusSummary['updated'] += $status['updated'];
                $statusSummary['skipped'] += $status['skipped'];

                CLI::write(
                    "페이지 {$page} 완료 - 삽입: {$status['inserted']}, 업데이트: {$status['updated']}, 건너뜀: {$status['skipped']}",
                    'blue'
                );
            } else {
                CLI::write("페이지 {$page}에 데이터 없음. 스킵.", 'yellow');
            }

            $page++;
        }

        CLI::write("\n크롤링 완료 요약:", 'green');
        CLI::write("삽입: {$statusSummary['inserted']}", 'blue');
        CLI::write("업데이트: {$statusSummary['updated']}", 'blue');
        CLI::write("건너뜀: {$statusSummary['skipped']}", 'blue');
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

        return mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'); // HTML-ENTITIES 변환
    }

    private function parseEventData($html)
    {
        $dom = new \DOMDocument('1.0', 'UTF-8');
        @$dom->loadHTML('<?xml encoding="UTF-8">' . $html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $xpath = new \DOMXPath($dom);
        $data = [];

        $items = $xpath->query('//div[contains(@class, "col-md-6")]');
        foreach ($items as $item) {
            $brandElement = $xpath->query('.//small[contains(@class, "font-")]', $item);
            $brand = $brandElement->length > 0 ? trim($brandElement->item(0)->nodeValue) : 'Unknown';

            $productName = trim($xpath->query('.//strong', $item)->item(0)->nodeValue);

            // 가격 정보 파싱
            $priceRaw = $xpath->query('.//i[contains(@class, "fa-coins")]/following-sibling::text()', $item);
            $price = $priceRaw->length > 0 ? str_replace(['원', ',', ' '], '', trim($priceRaw->item(0)->nodeValue)) : null;
            $price = is_numeric($price) ? (float)$price : null;

            $originalPriceElement = $xpath->query('.//span[@class="text-muted small"]', $item);
            $originalPrice = $originalPriceElement->length > 0
                ? str_replace(['(', ')', '원', ',', ' '], '', trim($originalPriceElement->item(0)->nodeValue))
                : null;
            $originalPrice = is_numeric($originalPrice) ? (float)$originalPrice : null;

            // 할인율 계산
            $discountRate = null;
            if ($price !== null && $originalPrice !== null && $originalPrice > 0) {
                $discountRate = round((($originalPrice - $price) / $originalPrice) * 100, 2);
            }

            // 카테고리 정보 파싱
            $categoryElement = $xpath->query('.//small[contains(@class, "float-right font-weight-bold")]', $item);
            $category = $categoryElement->length > 0 ? trim($categoryElement->item(0)->nodeValue) : 'Unknown';

            $imageUrlElement = $xpath->query('.//img', $item);
            $imageUrl = $imageUrlElement->length > 0 ? $imageUrlElement->item(0)->getAttribute('src') : null;
            if (!str_starts_with($imageUrl, 'http')) {
                $imageUrl = 'https:' . $imageUrl;
            }

            $eventTypeElement = $xpath->query('.//span[contains(@class, "badge")]', $item);
            $eventType = $eventTypeElement->length > 0 ? trim($eventTypeElement->item(0)->nodeValue) : 'Unknown';

            $data[] = [
                'brand' => $brand,
                'product_name' => $productName,
                'price' => $price,
                'original_price' => $originalPrice,
                'discount_rate' => $discountRate,
                'category' => $category, // 카테고리 추가
                'event_type' => $eventType,
                'image_url' => $imageUrl,
            ];
        }

        return $data;
    }

    private function saveOrUpdateEventData($data)
    {
        $inserted = 0;
        $updated = 0;
        $skipped = 0;
        $builder = $this->db->table('events_ease');
        $historyBuilder = $this->db->table('price_history');

        foreach ($data as $event) {
            $existingQuery = $builder->where('brand', $event['brand'])
                ->where('product_name', $event['product_name'])
                ->get();

            if ($existingQuery === false) {
                CLI::error("쿼리 실패: " . $this->db->error()['message']);
                continue;
            }

            $existing = $existingQuery->getRow();

            if ($existing) {
                $shouldUpdate = false;

                if ($existing->price !== $event['price']) {
                    $historyBuilder->insert([
                        'product_id' => $existing->id,
                        'price' => $event['price'],
                        'change_date' => date('Y-m-d H:i:s'),
                    ]);
                    $shouldUpdate = true;
                }

                if (
                    $existing->event_type !== $event['event_type'] ||
                    $existing->original_price !== $event['original_price'] ||
                    $existing->category !== $event['category'] // 카테고리 변경 확인
                ) {
                    $shouldUpdate = true;
                }

                if ($shouldUpdate) {
                    $builder->where('id', $existing->id)->update([
                        'event_type' => $event['event_type'],
                        'price' => $event['price'],
                        'original_price' => $event['original_price'],
                        'discount_rate' => $event['discount_rate'],
                        'category' => $event['category'], // 카테고리 업데이트
                        'image_url' => $event['image_url'],
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
                    $updated++;
                } else {
                    $skipped++;
                }
            } else {
                $builder->insert([
                    'brand' => $event['brand'],
                    'product_name' => $event['product_name'],
                    'event_type' => $event['event_type'],
                    'price' => $event['price'],
                    'original_price' => $event['original_price'],
                    'discount_rate' => $event['discount_rate'],
                    'category' => $event['category'], // 카테고리 삽입
                    'image_url' => $event['image_url'],
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
                $inserted++;
            }
        }

        return ['inserted' => $inserted, 'updated' => $updated, 'skipped' => $skipped];
    }
}
