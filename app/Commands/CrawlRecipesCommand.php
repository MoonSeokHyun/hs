<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use GuzzleHttp\Client;

class CrawlRecipesCommand extends BaseCommand
{
    protected $group       = 'Custom';
    protected $name        = 'crawl:recipes';
    protected $description = '만개의 레시피 사이트에서 레시피를 크롤링합니다.';

    public function run(array $params)
    {
        $baseUrl = "https://www.10000recipe.com/recipe/list.html?q=%ED%8E%B8%EC%9D%98%EC%A0%90&page=";
        $startPage = $params[0] ?? 1; // 기본 시작 페이지
        $endPage = $params[1] ?? $startPage + 1; // 기본 종료 페이지

        $client = new Client();
        $db = \Config\Database::connect();
        $builder = $db->table('recipes_ease');

        for ($page = $startPage; $page <= $endPage; $page++) {
            $listUrl = $baseUrl . $page;
            CLI::write("현재 페이지 크롤링 중: {$listUrl}", 'green');

            try {
                $response = $client->get($listUrl);
                $html = $response->getBody()->getContents();

                $dom = new \DOMDocument();
                @$dom->loadHTML($html);
                $xpath = new \DOMXPath($dom);

                // 각 레시피 카드 크롤링
                $cards = $xpath->query('//li[contains(@class, "common_sp_list_li")]');
                foreach ($cards as $card) {
                    // 제목
                    $titleNode = $xpath->query('.//div[contains(@class, "common_sp_caption_tit")]', $card);
                    $title = $titleNode->item(0) ? trim($titleNode->item(0)->textContent) : null;

                    // 이미지 (vod.png 필터링)
                    $imageNodes = $xpath->query('.//div[contains(@class, "common_sp_thumb")]//img', $card);
                    $imageUrl = null;
                    foreach ($imageNodes as $imageNode) {
                        $src = $imageNode->getAttribute('src');
                        if (!str_contains($src, 'vod.png')) {
                            $imageUrl = $src;
                            break;
                        }
                    }

                    // 상세 페이지 URL
                    $linkNode = $xpath->query('.//div[contains(@class, "common_sp_thumb")]//a', $card);
                    $detailUrl = $linkNode->item(0) ? "https://www.10000recipe.com" . $linkNode->item(0)->getAttribute('href') : null;

                    if ($title && $imageUrl && $detailUrl) {
                        CLI::write("레시피 제목: {$title}", 'yellow');
                        CLI::write("이미지 URL: {$imageUrl}", 'yellow');

                        // 상세 페이지 크롤링
                        $detailResponse = $client->get($detailUrl);
                        $detailHtml = $detailResponse->getBody()->getContents();

                        // JSON-LD 데이터 파싱
                        $ingredients = [];
                        $cookingSteps = [];
                        if (preg_match('/<script type="application\/ld\+json">(.+?)<\/script>/s', $detailHtml, $matches)) {
                            $jsonLd = json_decode($matches[1], true);

                            // JSON-LD 데이터가 예상 구조와 일치하는지 확인
                            if ($jsonLd && isset($jsonLd['recipeIngredient'], $jsonLd['recipeInstructions'])) {
                                // 재료
                                $ingredients = $jsonLd['recipeIngredient'] ?? [];

                                // 조리 과정
                                $instructions = $jsonLd['recipeInstructions'] ?? [];
                                foreach ($instructions as $instruction) {
                                    $cookingSteps[] = [
                                        'text' => $instruction['text'] ?? '',
                                        'image' => $instruction['image'] ?? '',
                                    ];
                                }
                            } else {
                                CLI::write("JSON-LD 데이터 구조가 예상과 다릅니다: {$detailUrl}", 'red');
                            }
                        } else {
                            CLI::write("JSON-LD 데이터 없음: {$detailUrl}", 'red');
                        }

                        // 조회수 기본값
                        $views = 0;

                        // 작성자 기본값
                        $author = '편잇';

                        // 데이터 저장
                        $builder->insert([
                            'title' => $title,
                            'image_url' => $imageUrl,
                            'views' => intval($views),
                            'ingredients' => json_encode($ingredients, JSON_UNESCAPED_UNICODE),
                            'cooking_steps' => json_encode($cookingSteps, JSON_UNESCAPED_UNICODE),
                            'author' => $author,
                            'recipe_url' => $detailUrl,
                        ]);
                        CLI::write("레시피 저장 완료: {$title}", 'green');
                    } else {
                        CLI::write("필수 데이터 누락: 제목 또는 이미지 또는 URL 없음", 'red');
                    }
                }
            } catch (\Exception $e) {
                CLI::error("크롤링 실패 (URL: {$listUrl}): " . $e->getMessage());
            }
        }

        CLI::write("크롤링 완료", 'green');
    }
}
