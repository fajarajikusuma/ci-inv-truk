<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Main::index');

// Kendaraan Routes
$routes->get('/kendaraan', 'Kendaraan::index');
$routes->get('/kendaraan/tambah', 'Kendaraan::tambah');
$routes->post('/kendaraan/simpan', 'Kendaraan::simpan', ['filter' => 'validate:kendaraan_simpan']);
$routes->get('/kendaraan/edit/(:any)', 'Kendaraan::edit/$1');
$routes->post('/kendaraan/update/(:any)', 'Kendaraan::update/$1', ['filter' => 'validate:kendaraan_edit']);
$routes->get('/kendaraan/hapus/(:any)', 'Kendaraan::hapus/$1');
$routes->get('/kendaraan/detail/(:any)', 'Kendaraan::detail/$1');

// Sopir Routes
$routes->get('/sopir', 'Sopir::index');
$routes->get('/sopir/tambah', 'Sopir::tambah');
$routes->post('/sopir/simpan', 'Sopir::simpan', ['filter' => 'validate:sopir_simpan']);
$routes->get('/sopir/edit/(:any)', 'Sopir::edit/$1');
$routes->post('/sopir/update/(:any)', 'Sopir::update/$1', ['filter' => 'validate:sopir_edit']);
$routes->get('/sopir/hapus/(:any)', 'Sopir::hapus/$1');

// Pemeliharaan Routes
$routes->get('/pemeliharaan', 'Pemeliharaan::index');
$routes->get('/pemeliharaan/tambah', 'Pemeliharaan::tambah');
$routes->post('/pemeliharaan/simpan', 'Pemeliharaan::simpan', ['filter' => 'validate:pemeliharaan_simpan']);
$routes->get('/pemeliharaan/edit/(:any)', 'Pemeliharaan::edit/$1');
$routes->post('/pemeliharaan/update/(:any)', 'Pemeliharaan::update/$1', ['filter' => 'validate:pemeliharaan_edit']);
$routes->get('/pemeliharaan/hapus/(:any)', 'Pemeliharaan::hapus/$1');
$routes->get('/pemeliharaan/detail/(:any)', 'Pemeliharaan::detail/$1');

// User Routes
$routes->get('/user', 'User::index');
$routes->get('/user/tambah', 'User::tambah');
$routes->post('/user/simpan', 'User::simpan', ['filter' => 'validate:user_simpan']);
$routes->get('/user/edit/(:any)', 'User::edit/$1');
$routes->post('/user/update/(:any)', 'User::update/$1', ['filter' => 'validate:user_edit']);
$routes->get('/user/hapus/(:any)', 'User::hapus/$1');
