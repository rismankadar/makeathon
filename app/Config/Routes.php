<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/updateCard/(:segment)', 'Home::getData/$1');
$routes->get('/getTable/(:segment)', 'Detail::getTable/$1');
$routes->get('/getTableAdjust/(:segment)', 'Detail::getTableAdjust/$1');
$routes->get('/detail/(:segment)', 'Detail::detail/$1');
$routes->get('/getChart/(:segment)', 'Detail::chart/$1');
$routes->get('/adjustValue/(:segment)', 'Detail::adjustValue/$1');
$routes->post('/tambah', 'Home::tambah');
$routes->post('/test_form', 'Test::test');
$routes->post('/test2', 'Test::test2');
$routes->post('/setValueAdjust', 'Detail::setValueAdjust');

$routes->post('ajax/request', 'AjaxController::handleRequest');
$routes->post('chart/update', 'ChartController::updateData');
$routes->get('/chart/update', 'ChartController::updateData');
$routes->get('/test', 'Test::index');
$routes->get('/getchartdata', 'Test::getchartdata');
$routes->get('/export/(:segment)', 'Test::export/$1');

$routes->post('/sensor', 'Test::create');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
