<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

/* ==============================
   AUTH (TANPA LOGIN)
================================ */
$routes->get('/login', 'Auth::index');
$routes->post('/auth/login', 'Auth::login', ['filter' => 'validate:login']);
$routes->get('/logout', 'Auth::logout');

// Riwayat Kendaraan (PUBLIK)
$routes->get('/cek_riwayat_kendaraan/(:any)', 'Auth::cek_riwayat_kendaraan/$1');


/* ==============================
   DASHBOARD (SEMUA ROLE LOGIN)
================================ */
$routes->get('/', 'Main::index', [
    'filter' => 'role:admin,operator_pemeliharaan,operator_pajak'
]);


/* ==============================
   MASTER DATA
   admin, operator_pemeliharaan
================================ */
$routes->group('kendaraan', ['filter' => 'role:admin,operator_pemeliharaan,operator_pajak'], function ($routes) {
    $routes->get('/', 'Kendaraan::index');
    $routes->get('tambah', 'Kendaraan::tambah');
    $routes->post('simpan', 'Kendaraan::simpan', ['filter' => 'validate:kendaraan_simpan']);
    $routes->get('edit/(:any)', 'Kendaraan::edit/$1');
    $routes->post('update/(:any)', 'Kendaraan::update/$1', ['filter' => 'validate:kendaraan_edit']);
    $routes->get('hapus/(:any)', 'Kendaraan::hapus/$1');
    $routes->get('detail/(:any)', 'Kendaraan::detail/$1');
});

$routes->group('sopir', ['filter' => 'role:admin,operator_pemeliharaan,operator_pajak'], function ($routes) {
    $routes->get('/', 'Sopir::index');
    $routes->get('tambah', 'Sopir::tambah');
    $routes->post('simpan', 'Sopir::simpan', ['filter' => 'validate:sopir_simpan']);
    $routes->get('edit/(:any)', 'Sopir::edit/$1');
    $routes->post('update/(:any)', 'Sopir::update/$1', ['filter' => 'validate:sopir_edit']);
    $routes->get('hapus/(:any)', 'Sopir::hapus/$1');
});


/* ==============================
   PEMELIHARAAN
   admin, operator_pemeliharaan
================================ */
$routes->group('pemeliharaan', ['filter' => 'role:admin,operator_pemeliharaan'], function ($routes) {
    $routes->get('/', 'Pemeliharaan::index');
    $routes->get('tambah/(:any)', 'Pemeliharaan::tambah/$1');
    $routes->post('simpan/(:any)', 'Pemeliharaan::simpan/$1', ['filter' => 'validate:pemeliharaan_simpan']);
    $routes->get('edit/(:any)', 'Pemeliharaan::edit/$1');
    $routes->post('update/(:any)', 'Pemeliharaan::update/$1', ['filter' => 'validate:pemeliharaan_edit']);
    $routes->get('hapus/(:any)', 'Pemeliharaan::hapus/$1');
    $routes->get('detail/(:any)', 'Pemeliharaan::detail/$1');
    $routes->post('detail/(:any)', 'Pemeliharaan::detail/$1');
    $routes->get('cetak_qrcode/(:any)', 'Pemeliharaan::cetak_qrcode/$1');
    $routes->get('filter', 'Pemeliharaan::filter');
});


/* ==============================
   PAJAK KENDARAAN
   admin, operator_pajak
================================ */
$routes->group('pajak_kendaraan', ['filter' => 'role:admin,operator_pajak'], function ($routes) {
    $routes->get('/', 'Pajak::index');
    $routes->get('tambah/(:any)', 'Pajak::tambah/$1');
    $routes->post('simpan/(:any)', 'Pajak::simpan/$1', ['filter' => 'validate:pajak_kendaraan_simpan']);
    $routes->get('edit/(:any)', 'Pajak::edit/$1');
    $routes->post('update/(:any)', 'Pajak::update/$1', ['filter' => 'validate:pajak_kendaraan_edit']);
    $routes->get('ajax_detail_pajak', 'Pajak::ajaxDetailPajak');
});


/* ==============================
   USER MANAGEMENT
   ADMIN ONLY
================================ */
$routes->group('user', ['filter' => 'role:admin'], function ($routes) {
    $routes->get('/', 'User::index');
    $routes->get('tambah', 'User::tambah');
    $routes->post('simpan', 'User::simpan', ['filter' => 'validate:user_simpan']);
    $routes->get('edit/(:any)', 'User::edit/$1');
    $routes->post('update/(:any)', 'User::update/$1', ['filter' => 'validate:user_edit']);
    $routes->get('hapus/(:any)', 'User::hapus/$1');
});


/* ==============================
   LAPORAN
   ADMIN ONLY
================================ */
$routes->group('laporan', ['filter' => 'role:admin,kasubag_umpeg'], function ($routes) {
    $routes->get('/', 'Laporan::index');
    $routes->get('pemeliharaan', 'Laporan::pemeliharaan');
    $routes->get('pemeliharaan/cetak', 'Laporan::cetak_pemeliharaan');
    $routes->get('filter', 'Laporan::filter');
    $routes->get('export', 'Laporan::export');
});
