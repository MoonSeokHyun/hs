<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// 기본 경로 설정
$routes->get('/', 'HospitalController::index');

// 병원 관련 라우트
$routes->get('hospitals/detail/(:num)', 'HospitalController::detail/$1');
$routes->post('/hospital/addReview', 'HospitalController::addReview');
$routes->get('hospital/search', 'HospitalController::search');

// 시설 관련 라우트
$routes->get('facility/detail/(:num)', 'FacilityController::detail/$1');
$routes->post('facility/addReview', 'FacilityController::addReview');

// 사이트맵 라우트
$routes->get('sitemap', 'SitemapController::index');
$routes->get('sitemap/page/(:num)', 'SitemapController::page/$1');

// 크롤링 관련 라우트
$routes->cli('crawl/cu', 'CrawlController::crawlCU');
$routes->get('crawl/cu', 'CrawlController::crawlCU'); // 브라우저에서 실행 가능
$routes->cli('crawl/gs25', 'GSCrawlController::crawlGS25');
$routes->get('crawl/gs25', 'GSCrawlController::crawlGS25');
$routes->get('crawl/seven', 'SevenCrawlController::crawlSeven');
$routes->get('crawl/emart24', 'Emart24CrawlController::crawlEmart24');
$routes->get('crawl/cspace', 'CspaceCrawlController::crawlCspace');
$routes->get('crawl/search', 'SearchCrawlController::crawlSearch');

// 이벤트 관련 라우트
$routes->get('/events', 'EventController::index');
$routes->get('events/detail/(:num)', 'EventController::detail/$1');
$routes->get('events/(:segment)', 'EventController::index/$1');
$routes->get('/event', 'EventListController::index');
$routes->get('/event/(:num)', 'EventListController::detail/$1');

// 크롤링 이벤트 라우트
$routes->get('/eventcrawler', 'EventCrawler::index');
$routes->get('/eventcrawler/crawl/(:num)', 'EventCrawler::crawl/$1');
