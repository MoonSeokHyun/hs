<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HospitalController::index');
$routes->get('hospitals/detail/(:num)', 'HospitalController::detail/$1');

$routes->get('sitemap', 'SitemapController::index');
$routes->get('sitemap/page/(:num)', 'SitemapController::page/$1');

$routes->post('/hospital/addReview', 'HospitalController::addReview');

$routes->get('facility/detail/(:num)', 'FacilityController::detail/$1');
$routes->post('facility/addReview', 'FacilityController::addReview');

$routes->get('hospital/search', 'HospitalController::search');


// 크롤링 
$routes->cli('crawl/cu', 'CrawlController::crawlCU');
$routes->get('crawl/cu', 'CrawlController::crawlCU'); // 브라우저에서 실행 가능
$routes->cli('crawl/gs25', 'GSCrawlController::crawlGS25');
$routes->get('crawl/gs25', 'GSCrawlController::crawlGS25');
