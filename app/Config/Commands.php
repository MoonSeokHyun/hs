<?php

namespace Config;

use CodeIgniter\Commands\Autoload;

class Commands extends Autoload
{
    public function init()
    {
        parent::init();

        // 커맨드 등록
        $this->commands = array_merge($this->commands, [
            'crawl:search' => \App\Commands\CrawlSearchCommand::class,
        ]);
    }
}
