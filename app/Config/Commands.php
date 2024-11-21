<?php

namespace Config;

class Commands
{
    public $commands = [
        'crawl:search' => \App\Commands\CrawlSearchCommand::class,
        'crawl:event' => \App\Commands\CrawlCommand::class,
        'crawl:emart24' => \App\Commands\CrawlEmart24Command::class,
    ];
}
