<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::index');
$routes->post('/login', 'Auth::prosesLogin');
$routes->get('/logout', 'Auth::logout');

// Halaman Admin
$routes->get('/dashboard-admin', 'Admin::index',['filter'=>'otentifikasi']);

// Halaman kasir
$routes->get('/dashboard-kasir', 'Kasir::index',['filter'=>'otentifikasi']);

// Satuan
$routes->get('/data-satuan', 'Satuan::index',['filter'=>'otentifikasi']);
$routes->get('/tambah-satuan', 'Satuan::tambahSatuan',['filter'=>'otentifikasi']);
$routes->post('/tambah-satuan', 'Satuan::prosesTambah');
$routes->get('/edit-satuan/(:num)', 'Satuan::editSatuan/$1',['filter'=>'otentifikasi']);
$routes->post('/edit-data-satuan/(:num)', 'Satuan::prosesEdit/$1');
$routes->post('/hapus-satuan/(:num)', 'Satuan::hapusSatuan/$1');
$routes->get('/cek-satuan-digunakan/(:num)', 'Satuan::cek_keterkaitan_data/$1',['filter'=>'otentifikasi']);

// Kategori
$routes->get('/data-kategori', 'Kategori::index',['filter'=>'otentifikasi']);
$routes->get('/tambah-kategori', 'Kategori::tambahKategori',['filter'=>'otentifikasi']);
$routes->post('/tambah-kategori', 'Kategori::prosesTambah');
$routes->get('/edit-kategori/(:num)', 'Kategori::editKategori/$1',['filter'=>'otentifikasi']);
$routes->post('/edit-kategori/(:num)', 'Kategori::prosesEdit/$1');
$routes->post('/hapus-kategori/(:num)', 'Kategori::hapusKategori/$1');
$routes->get('/cek-kategori-digunakan/(:num)', 'Kategori::cek_keterkaitan_data/$1',['filter'=>'otentifikasi']);

// Produk
$routes->get('/data-produk', 'Produk::index',['filter'=>'otentifikasi']);
$routes->get('/tambah-produk', 'Produk::tambahProduk',['filter'=>'otentifikasi']);
$routes->post('/tambah-produk', 'Produk::prosesTambah');
$routes->get('/edit-produk/(:num)', 'Produk::editProduk/$1',['filter'=>'otentifikasi']);
$routes->post('/edit-produk/(:num)', 'Produk::prosesEdit/$1');
$routes->post('/hapus-produk/(:num)', 'Produk::hapusProduk/$1');

// Pengguna
$routes->get('/data-pengguna', 'Pengguna::index',['filter'=>'otentifikasi']);
$routes->get('/tambah-pengguna', 'Pengguna::tambahPengguna',['filter'=>'otentifikasi']);
$routes->post('/tambah-pengguna', 'Pengguna::prosesTambah');
$routes->get('/edit-pengguna/(:any)', 'Pengguna::editPengguna/$1',['filter'=>'otentifikasi']);
$routes->post('/edit-pengguna/(:any)', 'Pengguna::prosesEdit/$1');
$routes->post('/hapus-pengguna/(:any)', 'Pengguna::hapusPengguna/$1');

// Transaksi
$routes->get('/penjualan', 'Penjualan::index',['filter'=>'otentifikasi']);
$routes->post('/tambah-penjualan', 'Penjualan::simpanPenjualan');
$routes->post('/hapus-detail/(:num)', 'Penjualan::hapusDetail/$1');
$routes->post('/pembayaran', 'Penjualan::simpanPembayaran');

// Laporan
$routes->get('/laporan-stok', 'LaporanStok::index',['filter'=>'otentifikasi']);
$routes->get('/pdf-stok', 'LaporanStok::generatePdf',['filter'=>'otentifikasi']);
$routes->get('/cetak-laporan', 'LaporanPendapatan::cetak_laporan',['filter'=>'otentifikasi']);
$routes->get('/laporan-penjualan', 'LaporanPendapatan::index',['filter'=>'otentifikasi']);
$routes->post('/laporan-penjualan', 'LaporanPendapatan::laporanPendapatan');
$routes->post('/laporan-pendapatan', 'LaporanPendapatan::generate_laporan');
