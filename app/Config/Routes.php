<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
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

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->setDefaultNamespace('');
$routes->get('/', 'Home::index');
$routes->get('/auth/login', 'Login::index');
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'Validasilogin']);
$routes->get('/auth/dashboard', 'Dashboard::index', ['filter' => 'Validasilogin']);
$routes->get('/auth/pengajar', 'Pengajar::index', ['filter' => 'Validasilogin']);
$routes->get('/auth/santri', 'Santri::index', ['filter' => 'Validasilogin']);
$routes->get('/auth/kelas', 'Santri::kelas', ['filter' => 'Validasilogin']);
$routes->get('/auth/infaq', 'Santri::infaq', ['filter' => 'Validasilogin']);
$routes->get('/auth/kegiatan', 'Kegiatan::index', ['filter' => 'Validasilogin']);
$routes->get('/auth/kegiatan/kategori', 'Kegiatan::kategori', ['filter' => 'Validasilogin']);
$routes->get('/auth/kegiatan/pendaftar', 'Kegiatan::pendaftar', ['filter' => 'Validasilogin']);
$routes->get('/auth/gallery', 'Gallery::index', ['filter' => 'Validasilogin']);
$routes->get('/auth/pengumuman', 'Pengumuman::index', ['filter' => 'Validasilogin']);
$routes->get('/auth/pengumuman/kelulusan', 'Pengumuman::kelulusan', ['filter' => 'Validasilogin']);
$routes->get('/auth/konfigurasi/web', 'Konfigurasi::index', ['filter' => 'Validasilogin']);
$routes->get('/auth/konfigurasi/user', 'Konfigurasi::user', ['filter' => 'Validasilogin']);
$routes->get('/auth/daftar/index', 'Daftar::index', ['filter' => 'Validasilogin']);
$routes->get('/auth/grafik', 'Grafikpengajar::index', ['filter' => 'Validasilogin']);

//Routes nilai disini
$routes->get('/auth/nilai', 'Nilai::index', ['filter' => 'Validasilogin']);
$routes->get('/nilai/delete/(:num)', 'Nilai::deleteData/$1'); //Routes fungsi Delete
$routes->post('nilai/getNilaiById', 'Nilai::getNilaiById');
$routes->post('nilai/simpan', 'Nilai::saveData'); //Routes fungsi Create


// $routes->group('pendaftar', ['filter' => 'Validasilogin'], function ($routes) {
//     $routes->get('/', 'PendaftarController::index', ['as' => 'pendaftar.index']);
//     $routes->get('(:num)/view', 'PendaftarController::view/$1', ['as' => 'pendaftar.view']);
//     $routes->get('(:num)/print', 'PendaftarController::print/$1', ['as' => 'pendaftar.print']);
//     $routes->get('(:num)/choose', 'PendaftarController::choose/$1', ['as' => 'pendaftar.choose']);
//     $routes->get('printall', 'PendaftarController::printall', ['as' => 'pendaftar.printall']);
//     $routes->get('excel', 'PendaftarController::excel', ['as' => 'pendaftar.excel']);
//     // $routes->delete('/', 'PendaftarController::destroy', ['as' => 'pendaftar.destroy']);
//     // $routes->get('print', 'PendaftarController::print', ['as' => 'pendaftar.print']);
// });


/**
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
