<?php

namespace App\Controllers;

use App\Models\SitemapModel;
use CodeIgniter\Controller;

class SitemapController extends Controller
{
    public function index()
    {
        $sitemapModel = new SitemapModel();
        $totalHospitals = $sitemapModel->countAllHospitals();
        $itemsPerPage = 10000; // 한 페이지에 10000개의 항목을 포함

        $pages = ceil($totalHospitals / $itemsPerPage);

        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $xml .= "<sitemapindex xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
        for ($i = 1; $i <= $pages; $i++) {
            $xml .= "<sitemap>\n";
            $xml .= "<loc>" . base_url("sitemap/page/{$i}") . "</loc>\n";
            $xml .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
            $xml .= "</sitemap>\n";
        }
        $xml .= "</sitemapindex>";

        return $this->response
            ->setHeader('Content-Type', 'application/xml; charset=utf-8')
            ->setBody($xml);
    }

    public function page($pageNumber)
    {
        $sitemapModel = new SitemapModel();
        $itemsPerPage = 10000;
        $offset = ($pageNumber - 1) * $itemsPerPage;

        $hospitals = $sitemapModel->getHospitalsForSitemap($itemsPerPage, $offset);

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
}