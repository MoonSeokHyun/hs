<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use GuzzleHttp\Client;
use DOMDocument;
use DOMXPath;
use App\Models\EventCrawlingModel;

class EventCrawl extends BaseCommand
{
    protected $group       = 'tasks';
    protected $name        = 'eventcrawl';
    protected $description = 'Pyony 사이트에서 마지막 페이지까지 이벤트 데이터를 크롤링합니다.';
    protected $usage       = 'php spark eventcrawl [start_page]';

    public function run(array $params)
    {
        if (!isset($params[0])) {
            CLI::error('시작 페이지 번호를 입력하세요. 예: php spark eventcrawl 1709');
            return;
        }

        $startPage = (int)$params[0];
        $client = new Client();
        $model = new EventCrawlingModel();

        $page = $startPage;

        while (true) {
            $url = "https://pyony.com/posts/{$page}/";
            CLI::write("크롤링할 페이지: {$url}", 'green');

            try {
                $response = $client->request('GET', $url, ['http_errors' => false]);

                if ($response->getStatusCode() !== 200) {
                    CLI::write("페이지를 찾을 수 없음: {$url}. 크롤링 종료.", 'red');
                    break;
                }

                $html = $response->getBody()->getContents();

                // DOMDocument를 사용하여 UTF-8 설정 후 HTML 파싱
                $dom = new DOMDocument('1.0', 'UTF-8');
                @$dom->loadHTML('<?xml encoding="UTF-8">' . $html);
                $xpath = new DOMXPath($dom);

                // 제목 추출
                $titleNode = $xpath->query('//div[contains(@class, "card-header")]/span[@class="font-weight-bold"]');
                $title = $titleNode->item(0) ? trim($titleNode->item(0)->textContent) : '제목 없음';

                // 제목 없음 확인 및 크롤링 중단
                if ($title === '제목 없음') {
                    CLI::write("제목이 없음: {$url}. 크롤링을 종료합니다.", 'red');
                    break;
                }

                // 브랜드 추출
                $brand = $this->detectBrand($title);

                // 이미지 URL 추출
                $imageNode = $xpath->query('//div[contains(@class, "clearfix small mt-3")]/p/img');
                $imageUrl = $imageNode->item(0) ? $imageNode->item(0)->getAttribute('src') : null;

                // 이벤트 기간 추출 (제목에서 추출)
                preg_match('/\((.*?)\)/', $title, $matches);
                $eventPeriod = $matches[1] ?? '기간 정보 없음';

                // 중복 확인
                $existingEvent = $model->where('title', $title)
                                       ->where('brand', $brand)
                                       ->first();

                if ($existingEvent) {
                    CLI::write("중복 데이터: {$title}", 'blue');
                } else {
                    // 데이터 저장
                    $model->insert([
                        'brand' => $brand,
                        'title' => $title,
                        'image_url' => $imageUrl,
                        'event_period' => $eventPeriod,
                        'status' => '진행중',
                    ]);
                    CLI::write("데이터 저장 완료: {$title}", 'yellow');
                }
            } catch (\Exception $e) {
                CLI::write("크롤링 실패 (URL: {$url}): " . $e->getMessage(), 'red');
                break;
            }

            // 다음 페이지로 이동
            $page++;
        }

        CLI::write("크롤링 완료: 시작 페이지 {$startPage}부터 마지막 페이지까지.", 'green');
    }

    private function detectBrand($title)
    {
        $brands = ['씨스페이스', 'GS25', '세븐일레븐', 'CU', '이마트24'];
        foreach ($brands as $brand) {
            if (strpos($title, $brand) !== false) {
                return $brand;
            }
        }
        return '기타브랜드'; // 브랜드가 탐지되지 않을 경우 기본값
    }
}
