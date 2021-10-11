<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Stok::index');
$routes->get('/print-laporan-stok', 'Stok::print_stok_barang');
$routes->get('/pengajuan-barang', 'StockOut::index');
$routes->post('/pengajuan-barang/show', 'StockOut::show');
$routes->post('/pengajuan-barang/tambah', 'StockOut::tambah');
$routes->post('/pengajuan-barang/update', 'StockOut::update');
$routes->post('/pengajuan-barang/hapus', 'StockOut::hapus');
$routes->get('/pengajuan-barang/print/(:num)', 'StockOut::print/$1');
$routes->get('/pengajuan-barang/laporan/(:num)/(:num)', 'StockOut::laporan_keluar/$1/$2');
$routes->get('/login', 'Auth::index');
$routes->get('/logout', 'Auth::logout');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
