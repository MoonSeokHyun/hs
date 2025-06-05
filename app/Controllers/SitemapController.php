<?php

namespace App\Controllers;

use App\Models\SitemapModel;
use CodeIgniter\Controller;

class SitemapController extends Controller
{
    public function index()
    {
        $sitemapModel = new SitemapModel();

        $totalEvents               = $sitemapModel->countAllEvents();
        $totalGasStations          = $sitemapModel->countAllGasStations();
        $totalParkingLots          = $sitemapModel->countAllParkingLots();
        $totalHotels               = $sitemapModel->countAllHotels();
        $totalRepairShops          = $sitemapModel->countAllRepairShops();
        $totalCarWashes            = $sitemapModel->countAllCarWashes();
        $totalTowedVehicleStorages = $sitemapModel->countAllTowedVehicleStorages();
        $totalParkingFacilities    = $sitemapModel->countAllParkingFacilities();
        $totalStores               = $sitemapModel->countAllStores();
        $totalEvStations           = $sitemapModel->countAllEvStations();
        $totalChargingStations     = $sitemapModel->countAllChargingStations();

        $itemsPerPage = 10000;

        $xml  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $xml .= "<sitemapindex xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

        $xml .= $this->addSitemapEntries('events',            ceil($totalEvents / $itemsPerPage));
        $xml .= $this->addSitemapEntries('gasstations',       ceil($totalGasStations / $itemsPerPage));
        $xml .= $this->addSitemapEntries('parkinglots',       ceil($totalParkingLots / $itemsPerPage));
        $xml .= $this->addSitemapEntries('hotel',             ceil($totalHotels / $itemsPerPage));
        $xml .= $this->addSitemapEntries('repairshops',       ceil($totalRepairShops / $itemsPerPage));
        $xml .= $this->addSitemapEntries('carwashes',         ceil($totalCarWashes / $itemsPerPage));
        $xml .= $this->addSitemapEntries('towedvehicle',      ceil($totalTowedVehicleStorages / $itemsPerPage));
        $xml .= $this->addSitemapEntries('parkingfacilities', ceil($totalParkingFacilities / $itemsPerPage));
        $xml .= $this->addSitemapEntries('stores',            ceil($totalStores / $itemsPerPage));
        $xml .= $this->addSitemapEntries('evstations',        ceil($totalEvStations / $itemsPerPage));
        $xml .= $this->addSitemapEntries('chargingstations',  ceil($totalChargingStations / $itemsPerPage));

        $xml .= "</sitemapindex>";

        return $this->response
            ->setHeader('Content-Type', 'application/xml; charset=utf-8')
            ->setBody($xml);
    }

    private function addSitemapEntries(string $type, int $pages): string
    {
        $entries = '';
        $today = date('Y-m-d');

        for ($i = 1; $i <= $pages; $i++) {
            $entries .= "<sitemap>\n";
            $entries .= "  <loc>" . base_url("sitemap/{$type}/{$i}") . "</loc>\n";
            $entries .= "  <lastmod>{$today}</lastmod>\n";
            $entries .= "</sitemap>\n";
        }

        return $entries;
    }

    public function events(int $pageNumber)             { return $this->generateSitemap('getEventsForSitemap', 'events/detail', 'created_at', $pageNumber, 'daily'); }
    public function gasstations(int $pageNumber)        { return $this->generateSitemap('getGasStationsForSitemap', 'gas_stations', 'data_reference_date', $pageNumber, 'daily'); }
    public function parkinglots(int $pageNumber)        { return $this->generateSitemap('getParkingLotsForSitemap', 'parking/detail', 'data_reference_date', $pageNumber, 'daily'); }
    public function hotel(int $pageNumber)              { return $this->generateSitemap('getHotelsForSitemap', 'hotel/detail', 'last_update_time', $pageNumber, 'daily'); }
    public function repairshops(int $pageNumber)        { return $this->generateSitemap('getRepairShopsForSitemap', 'automobile_repair_shop', 'data_reference_date', $pageNumber, 'daily'); }
    public function carwashes(int $pageNumber)          { return $this->generateSitemap('getCarWashesForSitemap', 'carwash/details', 'Data_Reference_Date', $pageNumber, 'daily'); }
    public function towedvehicle(int $pageNumber)       { return $this->generateSitemap('getTowedVehicleStoragesForSitemap', 'towed-vehicle-storage/detail', 'data_reference_date', $pageNumber, 'daily'); }
    public function parkingfacilities(int $pageNumber)  { return $this->generateSitemap('getParkingFacilitiesForSitemap', 'parking-facilities', '데이터기준일자', $pageNumber, 'daily'); }
    public function stores(int $pageNumber)             { return $this->generateSitemap('getStoresForSitemap', 'stores', 'updated_at', $pageNumber, 'daily'); }
    public function evstations(int $pageNumber)         { return $this->generateSitemap('getEvStationsForSitemap', 'ev-stations', '', $pageNumber, 'daily'); }
    public function chargingstations(int $pageNumber)   { return $this->generateSitemap('getChargingStationsForSitemap', 'station/detail', '', $pageNumber, 'daily'); }

    private function generateSitemap(
        string $method,
        string $baseRoute,
        string $dateField,
        int    $pageNumber,
        string $changefreq
    ) {
        $sitemapModel = new SitemapModel();
        $itemsPerPage = 10000;
        $offset = ($pageNumber - 1) * $itemsPerPage;
        $data = $sitemapModel->$method($itemsPerPage, $offset);

        $today = date('Y-m-d');

        $xml  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $xml .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

        foreach ($data as $item) {
            $idField = isset($item['ID']) ? 'ID' : 'id';
            $url = base_url("{$baseRoute}/{$item[$idField]}");

            $xml .= "  <url>\n";
            $xml .= "    <loc>{$url}</loc>\n";
            $xml .= "    <lastmod>{$today}</lastmod>\n";
            $xml .= "    <changefreq>{$changefreq}</changefreq>\n";
            $xml .= "  </url>\n";
        }

        $xml .= "</urlset>";

        return $this->response
            ->setHeader('Content-Type', 'application/xml; charset=utf-8')
            ->setBody($xml);
    }
}
