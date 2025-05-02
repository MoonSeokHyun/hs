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
        $totalEvents               = $sitemapModel->countAllEvents();
        $totalGasStations          = $sitemapModel->countAllGasStations();
        $totalParkingLots          = $sitemapModel->countAllParkingLots();
        $totalHotels               = $sitemapModel->countAllHotels();
        $totalRepairShops          = $sitemapModel->countAllRepairShops();
        $totalCarWashes            = $sitemapModel->countAllCarWashes();
        $totalTowedVehicleStorages = $sitemapModel->countAllTowedVehicleStorages();
        $totalParkingFacilities    = $sitemapModel->countAllParkingFacilities(); // 공영주차장
        $totalStores               = $sitemapModel->countAllStores();
        $totalEvStations           = $sitemapModel->countAllEvStations(); // 전기차 충전소

        $itemsPerPage = 10000;

        // 페이지 수 계산
        $eventPages               = ceil($totalEvents               / $itemsPerPage);
        $gasStationPages          = ceil($totalGasStations          / $itemsPerPage);
        $parkingLotPages          = ceil($totalParkingLots          / $itemsPerPage);
        $hotelPages               = ceil($totalHotels               / $itemsPerPage);
        $repairShopPages          = ceil($totalRepairShops          / $itemsPerPage);
        $carWashPages             = ceil($totalCarWashes             / $itemsPerPage);
        $towedVehicleStoragePages = ceil($totalTowedVehicleStorages / $itemsPerPage);
        $parkingFacilityPages     = ceil($totalParkingFacilities     / $itemsPerPage); // 공영주차장
        $storePages               = ceil($totalStores               / $itemsPerPage);
        $evStationPages           = ceil($totalEvStations           / $itemsPerPage); // 전기차 충전소

        // XML 시작
        $xml  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $xml .= "<sitemapindex xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

        $xml .= $this->addSitemapEntries('events',            $eventPages);
        $xml .= $this->addSitemapEntries('gasstations',       $gasStationPages);
        $xml .= $this->addSitemapEntries('parkinglots',       $parkingLotPages);
        $xml .= $this->addSitemapEntries('hotel',             $hotelPages);
        $xml .= $this->addSitemapEntries('repairshops',       $repairShopPages);
        $xml .= $this->addSitemapEntries('carwashes',         $carWashPages);
        $xml .= $this->addSitemapEntries('towedvehicle',      $towedVehicleStoragePages);
        $xml .= $this->addSitemapEntries('parkingfacilities', $parkingFacilityPages); // 공영주차장
        $xml .= $this->addSitemapEntries('stores',            $storePages);
        $xml .= $this->addSitemapEntries('evstations',        $evStationPages); // 전기차 충전소
        $xml .= "</sitemapindex>";

        return $this->response
                    ->setHeader('Content-Type', 'application/xml; charset=utf-8')
                    ->setBody($xml);
    }

    private function addSitemapEntries(string $type, int $pages): string
    {
        $entries = '';
        for ($i = 1; $i <= $pages; $i++) {
            $entries .= "<sitemap>\n";
            $entries .= "  <loc>" . base_url("sitemap/{$type}/{$i}") . "</loc>\n";
            $entries .= "  <lastmod>" . date('Y-m-d') . "</lastmod>\n";
            $entries .= "</sitemap>\n";
        }
        return $entries;
    }

    public function events(int $pageNumber)
    {
        return $this->generateSitemap(
            'getEventsForSitemap',
            'events/detail',
            'created_at',
            $pageNumber,
            'daily',
            '0.8'
        );
    }

    public function gasstations(int $pageNumber)
    {
        return $this->generateSitemap(
            'getGasStationsForSitemap',
            'gas_stations',
            'data_reference_date',
            $pageNumber,
            'daily',
            '0.7'
        );
    }

    public function parkinglots(int $pageNumber)
    {
        return $this->generateSitemap(
            'getParkingLotsForSitemap',
            'parking/detail',
            'data_reference_date',
            $pageNumber,
            'daily',
            '0.6'
        );
    }

    public function hotel(int $pageNumber)
    {
        return $this->generateSitemap(
            'getHotelsForSitemap',
            'hotel/detail',
            'last_update_time',
            $pageNumber,
            'daily',
            '0.9'
        );
    }

    public function repairshops(int $pageNumber)
    {
        return $this->generateSitemap(
            'getRepairShopsForSitemap',
            'automobile_repair_shop',
            'data_reference_date',
            $pageNumber,
            'daily',
            '0.7'
        );
    }

    public function carwashes(int $pageNumber)
    {
        return $this->generateSitemap(
            'getCarWashesForSitemap',
            'carwash/details',
            'Data_Reference_Date',
            $pageNumber,
            'daily',
            '0.8'
        );
    }

    public function towedvehicle(int $pageNumber)
    {
        return $this->generateSitemap(
            'getTowedVehicleStoragesForSitemap',
            'towed-vehicle-storage/detail',
            'data_reference_date',
            $pageNumber,
            'daily',
            '0.8'
        );
    }

    public function parkingfacilities(int $pageNumber)
    {
        return $this->generateSitemap(
            'getParkingFacilitiesForSitemap',
            'parking-facilities',
            '데이터기준일자',
            $pageNumber,
            'daily',
            '0.8'
        );
    }

    public function stores(int $pageNumber)
    {
        return $this->generateSitemap(
            'getStoresForSitemap',
            'stores',
            'updated_at',
            $pageNumber,
            'daily',
            '0.8'
        );
    }

    // 전기차 충전소 엔드포인트
    public function evstations(int $pageNumber)
    {
        return $this->generateSitemap(
            'getEvStationsForSitemap', // SitemapModel 메서드
            'ev-stations',             // 라우트 prefix
            '',                        // 날짜 필드 없음, fallback to today
            $pageNumber,
            'daily',
            '0.7'
        );
    }

    private function generateSitemap(
        string $method,
        string $baseRoute,
        string $dateField,
        int    $pageNumber,
        string $changefreq,
        string $priority
    ) {
        $sitemapModel = new SitemapModel();
        $itemsPerPage = 10000;
        $offset       = ($pageNumber - 1) * $itemsPerPage;

        $data = $sitemapModel->$method($itemsPerPage, $offset);

        $xml  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $xml .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

        foreach ($data as $item) {
            $idField = isset($item['ID']) ? 'ID' : 'id';
            $url     = base_url("{$baseRoute}/{$item[$idField]}");
            $lastMod = date('Y-m-d', strtotime($item[$dateField] ?? date('Y-m-d')));

            $xml .= "<url>\n";
            $xml .= "  <loc>{$url}</loc>\n";
            $xml .= "  <lastmod>{$lastMod}</lastmod>\n";
            $xml .= "  <changefreq>{$changefreq}</changefreq>\n";
            $xml .= "  <priority>{$priority}</priority>\n";
            $xml .= "</url>\n";
        }

        $xml .= "</urlset>";

        return $this->response
                    ->setHeader('Content-Type', 'application/xml; charset=utf-8')
                    ->setBody($xml);
    }
}
