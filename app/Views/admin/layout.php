<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#0f766e">
    <link href="<?= base_url('assets/base'); ?>/img/favicon.ico" rel="icon">
    <title><?= SITE_NAME; ?> - <?= $title; ?></title>

    <link href="<?= base_url('assets/admin/'); ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/admin/'); ?>/vendor/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/admin/'); ?>/css/ruang-admin.css" rel="stylesheet">
    <link href="<?= base_url('assets/admin/'); ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/css/tabler.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/base/css/croppie.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/base/css/pikaday.css">
    <link href="<?= base_url('assets/admin/'); ?>/css/diulem-admin.css?v=<?= filemtime(FCPATH . 'assets/admin/css/diulem-admin.css') ?>" rel="stylesheet">

    <script src="<?= base_url() ?>/assets/base/js/moment-with-locales.js"></script>
    <script src="<?= base_url('assets/dashboard'); ?>/vendor/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">
</head>

<body>
<?php
$activeMenu = service('uri')->getSegment(2) ?: 'dashboard';
$themeMenus = ['category_tema', 'tema'];
$videoMenus = ['category_video', 'tema_video'];
$settingMenus = ['setting', 'setting_paket', 'setting_pembayaran'];
$isThemeMenu = in_array($activeMenu, $themeMenus, true);
$isVideoMenu = in_array($activeMenu, $videoMenus, true);
$isSettingMenu = in_array($activeMenu, $settingMenus, true);
?>
<div class="page">
    <aside class="navbar navbar-vertical navbar-expand-lg diulem-admin-sidebar">
        <div class="diulem-admin-sidebar-container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#adminSidebarMenu" aria-controls="adminSidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h1 class="navbar-brand navbar-brand-autodark d-none d-lg-flex">
                <a href="<?= base_url('admin/dashboard'); ?>">
                    <img src="<?= base_url('assets/base'); ?>/img/logo2.png" width="34" height="34" alt="<?= SITE_NAME; ?>">
                    <span><?= SITE_NAME; ?></span>
                </a>
            </h1>
            <div class="nav-item dropdown d-lg-none diulem-admin-mobile-profile">
                <a href="#" class="nav-link d-flex align-items-center p-0" data-toggle="dropdown" aria-label="Open admin menu">
                    <span class="avatar avatar-sm">
                        <img src="<?= base_url('assets/dashboard'); ?>/img/boy.png" alt="Foto profil">
                    </span>
                    <span class="ms-2 fw-bold"><?= esc($_SESSION['uname_admin']) ?></span>
                    <i class="ti ti-chevron-down ms-1"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a class="dropdown-item" href="<?= base_url('admin/profil') ?>"><i class="ti ti-user me-2"></i>Profil</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="<?= base_url('logout') ?>"><i class="ti ti-logout me-2"></i>Logout</a>
                </div>
            </div>

            <div class="collapse navbar-collapse" id="adminSidebarMenu">
                <ul class="navbar-nav pt-lg-3">
                    <li class="nav-item">
                        <a class="nav-link <?= $activeMenu === 'dashboard' ? 'active' : '' ?>" href="<?= base_url('admin/dashboard'); ?>">
                            <span class="nav-link-icon d-md-none d-lg-inline-block"><i class="ti ti-layout-dashboard"></i></span>
                            <span class="nav-link-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $activeMenu === 'pengguna' ? 'active' : '' ?>" href="<?= base_url('admin/pengguna'); ?>">
                            <span class="nav-link-icon d-md-none d-lg-inline-block"><i class="ti ti-users"></i></span>
                            <span class="nav-link-title">Data Pengguna</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $activeMenu === 'pembayaran' ? 'active' : '' ?>" href="<?= base_url('admin/pembayaran'); ?>">
                            <span class="nav-link-icon d-md-none d-lg-inline-block"><i class="ti ti-receipt"></i></span>
                            <span class="nav-link-title">Data Pembayaran</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $activeMenu === 'testimoni' ? 'active' : '' ?>" href="<?= base_url('admin/testimoni'); ?>">
                            <span class="nav-link-icon d-md-none d-lg-inline-block"><i class="ti ti-message-heart"></i></span>
                            <span class="nav-link-title">Testimonial</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown <?= $isThemeMenu ? 'show' : '' ?>">
                        <a class="nav-link dropdown-toggle <?= $isThemeMenu ? 'active' : '' ?>" href="#" data-toggle="dropdown" role="button" aria-expanded="<?= $isThemeMenu ? 'true' : 'false' ?>">
                            <span class="nav-link-icon d-md-none d-lg-inline-block"><i class="ti ti-browser"></i></span>
                            <span class="nav-link-title">Undangan Website</span>
                        </a>
                        <div class="dropdown-menu <?= $isThemeMenu ? 'show' : '' ?>">
                            <a class="dropdown-item <?= $activeMenu === 'category_tema' ? 'active' : '' ?>" href="<?= base_url('admin/category_tema'); ?>">Kategori</a>
                            <a class="dropdown-item <?= $activeMenu === 'tema' ? 'active' : '' ?>" href="<?= base_url('admin/tema'); ?>">Tema</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown <?= $isVideoMenu ? 'show' : '' ?>">
                        <a class="nav-link dropdown-toggle <?= $isVideoMenu ? 'active' : '' ?>" href="#" data-toggle="dropdown" role="button" aria-expanded="<?= $isVideoMenu ? 'true' : 'false' ?>">
                            <span class="nav-link-icon d-md-none d-lg-inline-block"><i class="ti ti-video"></i></span>
                            <span class="nav-link-title">Undangan Video</span>
                        </a>
                        <div class="dropdown-menu <?= $isVideoMenu ? 'show' : '' ?>">
                            <a class="dropdown-item <?= $activeMenu === 'category_video' ? 'active' : '' ?>" href="<?= base_url('admin/category_video'); ?>">Kategori</a>
                            <a class="dropdown-item <?= $activeMenu === 'tema_video' ? 'active' : '' ?>" href="<?= base_url('admin/tema_video'); ?>">Tema</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown <?= $isSettingMenu ? 'show' : '' ?>">
                        <a class="nav-link dropdown-toggle <?= $isSettingMenu ? 'active' : '' ?>" href="#" data-toggle="dropdown" role="button" aria-expanded="<?= $isSettingMenu ? 'true' : 'false' ?>">
                            <span class="nav-link-icon d-md-none d-lg-inline-block"><i class="ti ti-settings"></i></span>
                            <span class="nav-link-title">Setting</span>
                        </a>
                        <div class="dropdown-menu <?= $isSettingMenu ? 'show' : '' ?>">
                            <a class="dropdown-item <?= $activeMenu === 'setting' ? 'active' : '' ?>" href="<?= base_url('admin/setting'); ?>">Aplikasi</a>
                            <a class="dropdown-item <?= $activeMenu === 'setting_paket' ? 'active' : '' ?>" href="<?= base_url('admin/setting_paket'); ?>">Paket</a>
                            <a class="dropdown-item <?= $activeMenu === 'setting_pembayaran' ? 'active' : '' ?>" href="<?= base_url('admin/setting_pembayaran'); ?>">Pembayaran</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </aside>

    <div class="page-wrapper diulem-admin-wrapper">
        <header class="navbar navbar-expand-md d-none d-lg-flex d-print-none diulem-admin-topbar">
            <div class="container-xl">
                <div class="navbar-nav flex-row ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-toggle="dropdown" aria-label="Open admin menu">
                            <span class="avatar avatar-sm">
                                <img src="<?= base_url('assets/dashboard'); ?>/img/boy.png" alt="Foto profil">
                            </span>
                            <div class="d-none d-xl-block ps-2">
                                <div><?= esc($_SESSION['uname_admin']) ?></div>
                                <div class="mt-1 small text-secondary">Admin</div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <a class="dropdown-item" href="<?= base_url('admin/profil') ?>"><i class="ti ti-user me-2"></i>Profil</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="<?= base_url('logout') ?>"><i class="ti ti-logout me-2"></i>Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <?php
        if (! function_exists('rupiah')) {
            function rupiah($angka)
            {
                return 'Rp ' . number_format($angka, 0, ',', '.');
            }
        }

        echo view($view);
        ?>

        <footer class="footer footer-transparent d-print-none">
            <div class="container-xl">
                <div class="text-center text-secondary">
                    Copyright &copy; <?= date('Y') ?> - <?= SITE_NAME; ?>
                </div>
            </div>
        </footer>
    </div>
</div>

<div class="modal" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Foto Mempelai</h4>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="resizer"></div>
                <hr>
                <button class="btn btn-primary w-100" id="upload">
                    <i class="ti ti-upload me-2"></i>Upload
                </button>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/dashboard'); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/dashboard'); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="<?= base_url('assets/dashboard'); ?>/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/dashboard'); ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/admin'); ?>/js/diulem-admin.js?v=<?= filemtime(FCPATH . 'assets/admin/js/diulem-admin.js') ?>"></script>
<script src="<?= base_url('assets/dashboard'); ?>/vendor/chart.js/Chart.min.js"></script>
<script src="<?= base_url('assets/admin'); ?>/js/demo/chart-area-demo.js"></script>

<script>
$(document).ready(function () {
    var diulemAdminDataTableLanguage = {
        lengthMenu: 'Tampilkan _MENU_ data',
        search: '',
        searchPlaceholder: 'Cari data...',
        info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
        infoEmpty: 'Belum ada data',
        infoFiltered: '(difilter dari _MAX_ data)',
        zeroRecords: 'Data tidak ditemukan',
        emptyTable: 'Belum ada data',
        paginate: {
            first: 'Pertama',
            last: 'Terakhir',
            next: 'Selanjutnya',
            previous: 'Sebelumnya'
        }
    };

    $('#dataTable').DataTable({
        language: diulemAdminDataTableLanguage
    });
    $('#dataTableHover').DataTable({
        language: diulemAdminDataTableLanguage
    });
});
</script>
<script>
$(function(){
    <?php if(session()->has("success")) { ?>
        DiulemAdmin.notify('success', 'Berhasil', '<?= session("success") ?>');
    <?php } ?>
    <?php if(session()->has("deleted")) { ?>
        DiulemAdmin.notify('warning', 'Berhasil', '<?= session("deleted") ?>');
    <?php } ?>
    <?php if(session()->has("updated")) { ?>
        DiulemAdmin.notify('success', 'Berhasil', '<?= session("updated") ?>');
    <?php } ?>
     <?php if(session()->has("error")) { ?>
        DiulemAdmin.notify('error', 'Gagal', '<?= session("error") ?>');
    <?php } ?>
});
</script>
</body>

</html>
