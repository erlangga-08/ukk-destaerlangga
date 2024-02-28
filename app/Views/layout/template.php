<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>
    <link rel="shortcut icon" type="image/png" href="" />
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.min.css'); ?>" />
    <link rel="stylesheet" href="<?= base_url('plugins/datatables/datatables.min.css'); ?>" />
    <link rel="stylesheet" href="<?= base_url('plugins/select2/css/select2.min.css'); ?>" />
    <link rel="stylesheet" href="<?= base_url('plugins/chart.js/Chart.min.css'); ?>" />

    <style>
        body {
            background-color: #f3f4f6;
            /* Warna abu-abu keabuan */
        }

        .ti-coin {
            /* Mengatur warna ikon menjadi merah */
            transition: color 0.3s;
            /* Efek transisi ketika warna berubah */
        }

        .card:hover .ti-coin {
            color: #B22222;
            /* Mengubah warna ikon saat card dihover */
        }

        .ti-box-seam {
            /* Mengatur warna ikon menjadi merah */
            transition: color 0.3s;
            /* Efek transisi ketika warna berubah */
        }

        .card:hover .ti-box-seam {
            color: #B22222;
            /* Mengubah warna ikon saat card dihover */
        }

        .ti-businessplan {
            /* Mengatur warna ikon menjadi merah */
            transition: color 0.3s;
            /* Efek transisi ketika warna berubah */
        }

        .card:hover .ti-businessplan {
            color: #B22222;
            /* Mengubah warna ikon saat card dihover */
        }

        .ti-users {
            /* Mengatur warna ikon menjadi merah */
            transition: color 0.3s;
            /* Efek transisi ketika warna berubah */
        }

        .card:hover .ti-users {
            color: #B22222;
            /* Mengubah warna ikon saat card dihover */
        }
    </style>
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <div class="text-nowrap logo-img mx-3 mt-4">
                        <h3>
                            <b>Kasir UKK</b>
                        </h3>
                    </div>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        <?php if (session()->get('level') == 'kasir') : ?>
                            <li class="nav-small-cap">
                                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                                <span class="hide-menu">Home</span>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="<?= site_url('dashboard-kasir'); ?>" aria-expanded="false">
                                    <span>
                                        <i class="ti ti-layout-dashboard"></i>
                                    </span>
                                    <span class="hide-menu">Dashboard</span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (session()->get('level') == 'admin') : ?>
                            <li class="nav-small-cap">
                                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                                <span class="hide-menu">Home</span>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="<?= site_url('dashboard-admin'); ?>" aria-expanded="false">
                                    <span>
                                        <i class="ti ti-layout-dashboard"></i>
                                    </span>
                                    <span class="hide-menu">Dashboard</span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (session()->get('level') == 'admin') : ?>
                            <li class="nav-small-cap">
                                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                                <span class="hide-menu">Master Data</span>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="<?= site_url('data-satuan'); ?>" aria-expanded="false">
                                    <span>
                                        <i class="ti ti-scale"></i>
                                    </span>
                                    <span class="hide-menu">Satuan</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="<?= site_url('data-kategori'); ?>" aria-expanded="false">
                                    <span>
                                        <i class="ti ti-list-details"></i>
                                    </span>
                                    <span class="hide-menu">Kategori</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="<?= site_url('data-produk'); ?>" aria-expanded="false">
                                    <span>
                                        <i class="ti ti-box-seam"></i>
                                    </span>
                                    <span class="hide-menu">Produk</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="<?= site_url('data-pengguna'); ?>" aria-expanded="false">
                                    <span>
                                        <i class="ti ti-users"></i>
                                    </span>
                                    <span class="hide-menu">Pengguna</span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (session()->get('level') == 'kasir') : ?>
                            <li class="nav-small-cap">
                                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                                <span class="hide-menu">Master Transaksi</span>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="<?= site_url('penjualan'); ?>" aria-expanded="false">
                                    <span>
                                        <i class="ti ti-arrows-exchange"></i>
                                    </span>
                                    <span class="hide-menu">Penjualan</span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Master Laporan</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="<?= site_url('laporan-stok'); ?>" aria-expanded="false">
                                <span>
                                    <i class="ti ti-file-digit"></i>
                                </span>
                                <span class="hide-menu">Stok</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="<?= site_url('laporan-penjualan'); ?>" aria-expanded="false">
                                <span>
                                    <i class="ti ti-file-analytics"></i>
                                </span>
                                <span class="hide-menu">Penjualan</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Auth</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="<?= site_url('logout'); ?>" onclick="return confirm('Yakin ingin logout?')" aria-expanded="false">
                                <span>
                                    <i class="ti ti-logout"></i>
                                </span>
                                <span class="hide-menu">Logout</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Beranda</a>
                        </li>
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            <p class="mt-3"><?= session()->get('nama_pengguna'); ?></p>
                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="<?= site_url('logout'); ?>" onclick="return confirm('Yakin ingin logout?')" class="btn btn-outline-primary mx-3 mt-2 d-block" id="logoutBtn" data-toggle="modal" data-target="#confirmationModal">Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->
            <div class="container-fluid">
                <?= $this->renderSection('konten'); ?>
            </div>

        </div>
    </div>
    <!-- ./wrapper -->
    <?= $this->include('layout/js'); ?>
    <!-- render Javascript disini -->
    <?= $this->renderSection('js'); ?>

    <script>
        // table
        $(document).ready(function() {
            $('#myTable').DataTable({
                responsive: true
            });
        });
    </script>
</body>

</html>