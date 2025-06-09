<?php

use CodeIgniter\Router\RouteCollection;

use App\Controller\Frontend\TestController;
/**
 * @var RouteCollection $routes
 */

 $routes->get('/login', 'LoginController::index');
 $routes->post('/login/auth', 'LoginController::auth');
 
//  $routes->post('/login/auth', 'Login::auth');
 $routes->get('/logout', 'Login::logout');
// File: app/Config/Routes.php
$routes->get('/anggota/register', 'AnggotaController::register');
$routes->post('/anggota/saveRegister', 'AnggotaController::saveRegister');
$routes->get('/peminjaman', 'PeminjamanController::index');
$routes->post('/peminjaman/pinjam', 'PeminjamanController::pinjam');
$routes->get('/peminjaman/pengembalian/(:num)', 'PeminjamanController::pengembalian/$1');

$routes->get('/login', 'LoginController::index');
$routes->post('/login/auth', 'LoginController::auth');
$routes->get('/logout', 'LoginController::logout');
$routes->get('/dashboard', 'DashboardController::index');
$routes->get('/dashboard', 'DashboardController::index');
$routes->get('/peminjaman', 'PeminjamanController::index');
$routes->get('/pengembalian', 'PeminjamanController::pengembalian'); // jika pengembalian disatukan
$routes->get('/logout', 'LoginController::logout');
$routes->post('/peminjaman/kembalikan', 'PeminjamanController::kembalikan');
$routes->post('/peminjaman/pinjam', 'PeminjamanController::pinjam');

//admin
// $routes->get('admin/konfirmasi', 'AdminController::konfirmasi');
// $routes->get('admin/setujui/(:num)', 'AdminController::setujui/$1');
// $routes->get('admin/tolak/(:num)', 'AdminController::tolak/$1');
// $routes->get('/admin', 'Admin::index');
// $routes->get('/admin/konfirmasi/(:num)', 'Admin::konfirmasi/$1');
// $routes->post('/admin/proses_konfirmasi', 'Admin::prosesKonfirmasi');

// admin login
// $routes->get('/admin/login', 'Admin::login');
// // $routes->post('/admin/auth', 'Admin::auth');
// $routes->get('/admin/dashboard', 'Admin::dashboard');
// $routes->post('dashboard', 'Admin\Dashboard::index');
$routes->get('/admin/dashboard', 'AdminController::dashboard');
$routes->get('/admin', 'AdminController::dashboard');
// Admin routes
// $routes->get('/admin', 'AdminController::index');
$routes->get('/admin/login', 'AdminController::login');
$routes->post('/admin/dashboard', 'AdminController::prosesLogin');
$routes->get('/admin/konfirmasi/(:num)', 'AdminController::konfirmasi/$1');
// $routes->post('/admin/konfirmasi', 'AdminController::prosesKonfirmasi');
$routes->post('/admin/proses_konfirmasi', 'AdminController::prosesKonfirmasi');
$routes->get('/admin/logout', 'AdminController::logout');
// Di app/Config/Routes.php
$routes->post('/peminjaman/update-status/(:num)', 'PeminjamanController::updateStatus/$1');
$routes->post('admin/prosesKonfirmasi', 'AdminController::prosesKonfirmasi');
$routes->get('/admin/peminjaman', 'AdminController::peminjaman');

// $routes->post('/admin/proses_konfirmasi', 'AdminController::prosesKonfirmasi');
?>