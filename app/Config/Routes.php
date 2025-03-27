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
$routes->get('sitemap/events/(:num)', 'SitemapController::events/$1');
$routes->get('sitemap/gasstations/(:num)', 'SitemapController::gasstations/$1');
$routes->get('sitemap/parkinglots/(:num)', 'SitemapController::parkinglots/$1');
$routes->get('sitemap/hotel/(:num)', 'SitemapController::hotel/$1');
$routes->get('sitemap/repairshops/(:num)', 'SitemapController::repairshops/$1');




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

//레시피 관련
$routes->get('/recipes', 'RecipeController::index');
$routes->get('/recipes/(:num)', 'RecipeController::detail/$1');

// 카허브 라우터 

$routes->get('parking', 'ParkingController::index');
$routes->get('parking/search', 'ParkingController::search');
$routes->get('parking/detail/(:num)', 'ParkingController::detail/$1');
$routes->get('gas_stations', 'GasStationController::index');
$routes->get('gas_stations/(:num)', 'GasStationController::detail/$1');

// 자동차 정비소 라우트 추가
$routes->get('/automobile_repair_shops', 'AutomobileRepairShopController::index');
$routes->get('/automobile_repair_shop/(:num)', 'AutomobileRepairShopController::detail/$1');

$routes->get('gas_stations/search', 'GasStationController::search');
// 자동차 정비소 검색 라우트 추가
$routes->get('automobile_repair_shops/search', 'AutomobileRepairShopController::search');


// 배치 관련 

$routes->cli('batch/update-parking-data', 'BatchController::updateParkingData');
$routes->get('/batch/update-parking-data', 'BatchController::updateParkingData');

// 주유소 배치 
$routes->cli('batch/update-gas-station-data', 'GasStationBatchController::updateGasStationData');
$routes->get('/batch/update-gas-station-data', 'GasStationBatchController::updateGasStationData');

// 주차장 댓글 
$routes->post('parking/saveComment', 'ParkingController::saveComment');
// 주유소 댓글 
$routes->post('/gas_station/saveComment', 'GasStationController::saveComment');
// 정비소 댓글
$routes->post('automobile_repair_shop/saveReview', 'AutomobileRepairShopController::saveReview');


//호텔
$routes->get('/hotel', 'HotelController::index'); // 목록 페이지
$routes->get('/hotel/detail/(:num)', 'HotelController::detail/$1'); // 뷰페이지
$routes->get('/hotel/search', 'HotelController::search');

// FestivalInfoController 관련 라우트
$routes->get('festival-info', 'FestivalInfoController::index'); // 축제 및 공연 목록 페이지
$routes->get('festival-info/(:num)', 'FestivalInfoController::detail/$1'); // 축제 상세 페이지
$routes->get('festival-info/eventdetail/(:num)', 'FestivalInfoController::eventDetail/$1'); // 공연 상세 페이지
