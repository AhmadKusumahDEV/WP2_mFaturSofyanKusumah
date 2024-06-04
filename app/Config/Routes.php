<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/contoh1', 'contoh1::P1');
$routes->get('/latihan1/(:num)/(:num)', 'latihan1::penjumlahan0/$1/$2');
$routes->get('/contoh3/(:num)/(:num)', 'latihan1::penjumlahan/$1/$2');
$routes->get('/matakuliah', 'Matakuliah::index');
$routes->get('/web', 'Web::index');
$routes->get('/about', 'Web::about');
$routes->add('/matakuliah/view', 'Matakuliah::cetak');

$routes->get('/table', 'table::index');

// routes kategori
$routes->get('/kategori', 'contohdb::find');

// routes buku
$routes->get('/buku', 'buku::find');
$routes->get('/buku/view', 'buku::view');
$routes->post('/buku/carikan', 'buku::findone');

// routes auth
$routes->get('/auth', 'auth::login');
$routes->get('/auth/register', 'auth::register');
$routes->get('/auth/logoutkan', 'auth::logout');
$routes->post('/auth/login', 'auth::signin');
$routes->post('/auth/daftarkan', 'auth::signup');

//dashboard
$routes->get('/admin/dashboard', 'admin::dashboard');
$routes->get('/admin/myprofil', 'admin::myprofil');
$routes->get('/admin/ubahprofil', 'admin::ubahprofil');
$routes->post('/admin/saveubah', 'admin::saveubah');
$routes->get('/admin/anggota', 'admin::anggota');