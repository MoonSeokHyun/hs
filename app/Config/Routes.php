<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HospitalController::index');
$routes->get('hospitals/detail/(:num)', 'HospitalController::detail/$1');