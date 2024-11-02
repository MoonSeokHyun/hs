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
