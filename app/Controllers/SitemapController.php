<?php

namespace App\Controllers;

use App\Models\SitemapModel;
use CodeIgniter\Controller;

class SitemapController extends Controller
{
    public function index()
    {
        $sitemapModel = new SitemapModel();

        // 병원 데이터
        $totalHospitals = $sitemapModel->countAllHospitals();

        // 이벤트 데이터
        $totalEvents = $sitemapModel->countAllEvents();

        // 한 페이지에 10,000개 항목
        $itemsPerPage = 10000;

        // 병원과 이벤트 각각 페이지 계산
        $hospitalPages = ceil($totalHospitals / $itemsPerPage);
        $eventPages = ceil($totalEvents / $itemsPerPage);

        // XML 시작
        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $xml .= "<sitemapindex xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

        // 병원 사이트맵
        for ($i = 1; $i <= $hospitalPages; $i++) {
            $xml .= "<sitemap>\n";
            $xml .= "<loc>" . base_url("sitemap/hospitals/{$i}") . "</loc>\n";
            $xml .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
            $xml .= "</sitemap>\n";
        }

        // 이벤트 사이트맵
        for ($i = 1; $i <= $eventPages; $i++) {
            $xml .= "<sitemap>\n";
            $xml .= "<loc>" . base_url("sitemap/events/{$i}") . "</loc>\n";
            $xml .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
            $xml .= "</sitemap>\n";
        }

        $xml .= "</sitemapindex>";

        return $this->response
            ->setHeader('Content-Type', 'application/xml; charset=utf-8')
            ->setBody($xml);
    }

    public function hospitals($pageNumber)
    {
        $sitemapModel = new SitemapModel();
        $itemsPerPage = 10000;
        $offset = ($pageNumber - 1) * $itemsPerPage;

        $hospitals = $sitemapModel->getHospitalsForSitemap($itemsPerPage, $offset);

        // XML 시작
        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $xml .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

        foreach ($hospitals as $hospital) {
            $url = base_url("hospitals/detail/{$hospital['ID']}");
            $lastMod = date('Y-m-d', strtotime($hospital['LastUpdateTime']));

            $xml .= "<url>\n";
            $xml .= "<loc>{$url}</loc>\n";
            $xml .= "<lastmod>{$lastMod}</lastmod>\n";
            $xml .= "<changefreq>monthly</changefreq>\n";
            $xml .= "<priority>0.8</priority>\n";
            $xml .= "</url>\n";
        }

        $xml .= "</urlset>";

        return $this->response
            ->setHeader('Content-Type', 'application/xml; charset=utf-8')
            ->setBody($xml);
    }

    public function events($pageNumber)
    {
        $sitemapModel = new SitemapModel();
        $itemsPerPage = 10000;
        $offset = ($pageNumber - 1) * $itemsPerPage;

        $events = $sitemapModel->getEventsForSitemap($itemsPerPage, $offset);

        // XML 시작
        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $xml .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

        foreach ($events as $event) {
            $url = base_url("events/detail/{$event['id']}");
            $lastMod = date('Y-m-d', strtotime($event['created_at'])); // 'created_at' 기준

            $xml .= "<url>\n";
            $xml .= "<loc>{$url}</loc>\n";
            $xml .= "<lastmod>{$lastMod}</lastmod>\n";
            $xml .= "<changefreq>daily</changefreq>\n";
            $xml .= "<priority>0.8</priority>\n";
            $xml .= "</url>\n";
        }

        $xml .= "</urlset>";

        return $this->response
            ->setHeader('Content-Type', 'application/xml; charset=utf-8')
            ->setBody($xml);
    }
}
