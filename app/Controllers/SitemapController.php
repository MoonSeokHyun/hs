<?php

namespace App\Controllers;

use App\Models\SitemapModel;
use CodeIgniter\Controller;

class SitemapController extends Controller
{
    public function index()
    {
        $sitemapModel = new SitemapModel();

        // 데이터 총 개수
        $totalEvents = $sitemapModel->countAllEvents();
        $totalGasStations = $sitemapModel->countAllGasStations();
        $totalParkingLots = $sitemapModel->countAllParkingLots();
        $totalHotels = $sitemapModel->countAllHotels();
        $totalRepairShops = $sitemapModel->countAllRepairShops();

        // 한 페이지에 10,000개 항목
        $itemsPerPage = 10000;

        // 페이지 계산
        $eventPages = ceil($totalEvents / $itemsPerPage);
        $gasStationPages = ceil($totalGasStations / $itemsPerPage);
        $parkingLotPages = ceil($totalParkingLots / $itemsPerPage);
        $hotelPages = ceil($totalHotels / $itemsPerPage);
        $repairShopPages = ceil($totalRepairShops / $itemsPerPage);

        // XML 시작
        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $xml .= "<sitemapindex xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

        // 각 사이트맵 추가
        $xml .= $this->addSitemapEntries('events', $eventPages);
        $xml .= $this->addSitemapEntries('gasstations', $gasStationPages);
        $xml .= $this->addSitemapEntries('parkinglots', $parkingLotPages);
        $xml .= $this->addSitemapEntries('hotel', $hotelPages);
        $xml .= $this->addSitemapEntries('repairshops', $repairShopPages);

        $xml .= "</sitemapindex>";

        return $this->response
            ->setHeader('Content-Type', 'application/xml; charset=utf-8')
            ->setBody($xml);
    }

    private function addSitemapEntries($type, $pages)
    {
        $entries = '';
        for ($i = 1; $i <= $pages; $i++) {
            $entries .= "<sitemap>\n";
            $entries .= "<loc>" . base_url("sitemap/{$type}/{$i}") . "</loc>\n";
            $entries .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
            $entries .= "</sitemap>\n";
        }
        return $entries;
    }

    public function events($pageNumber)
    {
        return $this->generateSitemap('getEventsForSitemap', 'events/detail', 'created_at', $pageNumber, 'daily', 0.8);
    }

    public function gasstations($pageNumber)
    {
        return $this->generateSitemap('getGasStationsForSitemap', 'gasstation/detail', 'data_reference_date', $pageNumber, 'daily', 0.7);
    }

    public function parkinglots($pageNumber)
    {
        return $this->generateSitemap('getParkingLotsForSitemap', 'parkinglot/detail', 'data_reference_date', $pageNumber, 'daily', 0.6);
    }

    public function hotel($pageNumber)
    {
        return $this->generateSitemap('getHotelsForSitemap', 'hotel/detail', 'last_update_time', $pageNumber, 'daily', 0.9);
    }

    public function repairshops($pageNumber)
    {
        return $this->generateSitemap('getRepairShopsForSitemap', 'automobile_repair_shop', 'data_reference_date', $pageNumber, 'daily', 0.7);
    }

    private function generateSitemap($method, $baseRoute, $dateField, $pageNumber, $changefreq, $priority)
    {
        $sitemapModel = new SitemapModel();
        $itemsPerPage = 10000;
        $offset = ($pageNumber - 1) * $itemsPerPage;

        $data = $sitemapModel->$method($itemsPerPage, $offset);

        // XML 시작
        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $xml .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

        foreach ($data as $item) {
            $url = base_url("{$baseRoute}/{$item['id']}");
            $lastMod = date('Y-m-d', strtotime($item[$dateField]));

            $xml .= "<url>\n";
            $xml .= "<loc>{$url}</loc>\n";
            $xml .= "<lastmod>{$lastMod}</lastmod>\n";
            $xml .= "<changefreq>{$changefreq}</changefreq>\n";
            $xml .= "<priority>{$priority}</priority>\n";
            $xml .= "</url>\n";
        }

        $xml .= "</urlset>";

        return $this->response
            ->setHeader('Content-Type', 'application/xml; charset=utf-8')
            ->setBody($xml);
    }
}
