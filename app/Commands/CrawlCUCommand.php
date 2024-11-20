<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Controllers\CrawlController;

class CrawlSearchCommand extends BaseCommand
{
    protected $group       = 'Crawling';
    protected $name        = 'crawl:search';
    protected $description = 'Search 페이지 전체 크롤링 명령어';

    public function run(array $params)
    {
        CLI::write("Search 크롤링 시작...", 'green');

        try {
            // CrawlController의 crawlSearch 메서드 호출
            $controller = new CrawlController();
            $controller->crawlSearch(); // 전체 크롤링
        } catch (\Exception $e) {
            CLI::error("크롤링 중 오류 발생: " . $e->getMessage());
        }

        CLI::write("Search 크롤링 완료!", 'blue');
    }
}
