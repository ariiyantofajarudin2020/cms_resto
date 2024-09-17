<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/warning', 'Management::warning');

 // Route untuk Management Aplikasi
$routes->get('/', 'Management::index');
$routes->post('/', 'Management::index');

$routes->get('/logout', 'Management::logout');
$routes->get('/login', 'Management::login');
$routes->post('/auth', 'Management::auth');
$routes->add('/akses_update/(:segment)', 'Management::akses_update/$1');
$routes->post('/insert_unit', 'Management::insert_unit');
$routes->add('/deleteunit/(:segment)', 'Management::delete_unit/$1');
$routes->post('/insert_induk', 'Management::insert_induk');
$routes->add('/deleteinduk/(:segment)', 'Management::delete_induk/$1');

//Route untuk Unit Aplikasi
$routes->get('/error', 'Unit::error');

$routes->get('/u/(:any)', 'Unit::index/$1');
$routes->post('/u/(:any)', 'Unit::index/$1');
$routes->get('/u', 'Unit::index');
$routes->post('/u', 'Unit::index');

$routes->add('/unit/mu_delete/(:any)/(:any)', 'Fitur::mu_delete/$1/$2');
$routes->post('/unit/auth', 'Unit::auth');

$routes->post('/unit/post/(:segment)', 'Fitur::http_post/$1');
$routes->post('/pos/post/(:segment)', 'Pos::http_post/$1');