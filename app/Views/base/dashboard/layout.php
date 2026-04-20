<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="theme-color" content="#0f766e">
    <meta name="author" content="">
    <link href="<?= base_url('assets/base'); ?>/img/favicon.ico" rel="icon">
    <title><?= SITE_NAME; ?> - <?= $title; ?></title>

    <link href="<?= base_url('assets/dashboard/'); ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/dashboard/'); ?>/vendor/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/dashboard/'); ?>/css/ruang-admin.css" rel="stylesheet">
    <link href="<?= base_url('assets/dashboard/'); ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/css/tabler.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    <link href="<?= base_url('assets/dashboard/'); ?>/css/diulem-dashboard.css" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url() ?>/assets/base/css/croppie.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/base/css/pikaday.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/dashboard/css/qrscan.css">
    <script src="https://rawgit.com/sitepoint-editors/jsqrcode/master/src/qr_packed.js"></script>
    <script src="<?= base_url() ?>/assets/base/js/moment-with-locales.js"></script>
    <script src="<?= base_url('assets/dashboard'); ?>/vendor/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
</head>

<body>
<?php
$activeMenu = service('uri')->getSegment(2) ?: 'dashboard';
$websiteMenus = ['tampilan', 'pengaturan', 'mempelai', 'acara', 'album', 'cerita', 'rekening'];
$visitorMenus = ['riwayat', 'ucapan'];
$guestMenus = ['tamu', 'setting_bukutamu', 'data_hadir'];
?>
<div class="page">
    <aside class="navbar navbar-vertical navbar-expand-lg diulem-sidebar">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h1 class="navbar-brand navbar-brand-autodark d-none d-lg-flex">
                <a href="<?= base_url('user/dashboard'); ?>">
                    <img src="<?= base_url('assets/base'); ?>/img/logo2.png" width="34" height="34" alt="<?= SITE_NAME; ?>">
                    <span><?= SITE_NAME; ?></span>
                </a>
            </h1>
            <div class="nav-item dropdown d-lg-none diulem-mobile-profile">
                <a href="#" class="nav-link d-flex align-items-center p-0" data-toggle="dropdown" aria-label="Open user menu">
                    <span class="avatar avatar-sm" style="background-image: url(<?= base_url('assets/dashboard'); ?>/img/boy.png)"></span>
                    <span class="ms-2 fw-bold"><?= esc($_SESSION['uname']) ?></span>
                    <i class="ti ti-chevron-down ms-1"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a class="dropdown-item" href="<?= base_url('user/profil') ?>"><i class="ti ti-user me-2"></i>Profil</a>
                    <a class="dropdown-item" href="<?= base_url('user/invoice') ?>"><i class="ti ti-receipt me-2"></i>Tagihan</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="<?= base_url('user/logout') ?>"><i class="ti ti-logout me-2"></i>Logout</a>
                </div>
            </div>
            <div class="diulem-sidebar-tools d-none d-lg-block">
                <button id="diulemSidebarMinimize" class="btn btn-outline-primary btn-sm w-100" type="button" aria-label="Minimize sidebar">
                    <i class="ti ti-layout-sidebar-left-collapse me-2"></i>
                    <span>Ringkas sidebar</span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="sidebar-menu">
                <ul class="navbar-nav pt-lg-3">
                    <li class="nav-item">
                        <a class="nav-link <?= $activeMenu === 'dashboard' ? 'active' : '' ?>" href="<?= base_url('user/dashboard'); ?>">
                            <span class="nav-link-icon d-md-none d-lg-inline-block"><i class="ti ti-layout-dashboard"></i></span>
                            <span class="nav-link-title">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?= in_array($activeMenu, $websiteMenus, true) ? 'active' : '' ?>" href="#" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block"><i class="ti ti-browser"></i></span>
                            <span class="nav-link-title">Website</span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item <?= $activeMenu === 'tampilan' ? 'active' : '' ?>" href="<?= base_url('user/tampilan'); ?>">Tampilan</a>
                            <a class="dropdown-item <?= $activeMenu === 'pengaturan' ? 'active' : '' ?>" href="<?= base_url('user/pengaturan'); ?>">Pengaturan</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item <?= $activeMenu === 'mempelai' ? 'active' : '' ?>" href="<?= base_url('user/mempelai'); ?>">Mempelai</a>
                            <a class="dropdown-item <?= $activeMenu === 'acara' ? 'active' : '' ?>" href="<?= base_url('user/acara'); ?>">Acara</a>
                            <a class="dropdown-item <?= $activeMenu === 'album' ? 'active' : '' ?>" href="<?= base_url('user/album'); ?>">Gallery</a>
                            <a class="dropdown-item <?= $activeMenu === 'cerita' ? 'active' : '' ?>" href="<?= base_url('user/cerita'); ?>">Cerita & Quote</a>
                            <?php if ($_SESSION['kirim_hadiah'] == 1) { ?>
                                <a class="dropdown-item <?= $activeMenu === 'rekening' ? 'active' : '' ?>" href="<?= base_url('user/rekening'); ?>">Rekening</a>
                            <?php } ?>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?= in_array($activeMenu, $visitorMenus, true) ? 'active' : '' ?>" href="#" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block"><i class="ti ti-chart-line"></i></span>
                            <span class="nav-link-title">Pengunjung</span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item <?= $activeMenu === 'riwayat' ? 'active' : '' ?>" href="<?= base_url('user/riwayat'); ?>">Riwayat</a>
                            <a class="dropdown-item <?= $activeMenu === 'ucapan' ? 'active' : '' ?>" href="<?= base_url('user/ucapan'); ?>">Ucapan</a>
                        </div>
                    </li>

                    <?php if ($_SESSION['buku_tamu'] == 1) { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?= in_array($activeMenu, $guestMenus, true) ? 'active' : '' ?>" href="#" data-toggle="dropdown" role="button" aria-expanded="false">
                                <span class="nav-link-icon d-md-none d-lg-inline-block"><i class="ti ti-address-book"></i></span>
                                <span class="nav-link-title">Buku Tamu</span>
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item <?= $activeMenu === 'tamu' ? 'active' : '' ?>" href="<?= base_url('user/tamu'); ?>">Data Tamu</a>
                                <a class="dropdown-item <?= $activeMenu === 'setting_bukutamu' ? 'active' : '' ?>" href="<?= base_url('user/setting_bukutamu'); ?>">Setting Buku Tamu</a>
                                <a class="dropdown-item <?= $activeMenu === 'data_hadir' ? 'active' : '' ?>" href="<?= base_url('user/data_hadir'); ?>">Data Hadir</a>
                            </div>
                        </li>
                    <?php } ?>

                    <li class="nav-item">
                        <a class="nav-link <?= $activeMenu === 'testimoni' ? 'active' : '' ?>" href="<?= base_url('user/testimoni'); ?>">
                            <span class="nav-link-icon d-md-none d-lg-inline-block"><i class="ti ti-message-heart"></i></span>
                            <span class="nav-link-title">Testimonial</span>
                        </a>
                    </li>
                    <li class="nav-item mt-lg-3">
                        <a class="nav-link" href="https://api.whatsapp.com/send?phone=<?= $_SESSION['no_wa'] ?>" target="_blank">
                            <span class="nav-link-icon d-md-none d-lg-inline-block"><i class="ti ti-brand-whatsapp"></i></span>
                            <span class="nav-link-title">Hubungi Kami</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </aside>

    <div class="page-wrapper">
        <header class="navbar navbar-expand-md d-none d-lg-flex d-print-none diulem-topbar">
            <div class="container-xl">
                <div>
                    <div class="text-secondary small">Dashboard Pengguna</div>
                    <div class="h3 m-0"><?= esc($title) ?></div>
                </div>
                <div class="navbar-nav flex-row ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-toggle="dropdown" aria-label="Open user menu">
                            <span class="avatar avatar-sm" style="background-image: url(<?= base_url('assets/dashboard'); ?>/img/boy.png)"></span>
                            <div class="d-none d-xl-block ps-2">
                                <div><?= esc($_SESSION['uname']) ?></div>
                                <div class="mt-1 small text-secondary">Pengguna</div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <a class="dropdown-item" href="<?= base_url('user/profil') ?>"><i class="ti ti-user me-2"></i>Profil</a>
                            <a class="dropdown-item" href="<?= base_url('user/invoice') ?>"><i class="ti ti-receipt me-2"></i>Tagihan</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="<?= base_url('user/logout') ?>"><i class="ti ti-logout me-2"></i>Logout</a>
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
                <button class="btn btn-dark w-100" id="upload">Upload</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="myModal2">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Foto Slider</h4>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="resizer2"></div>
                <hr>
                <button class="btn btn-dark w-100" id="upload2">Upload</button>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/dashboard'); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/dashboard'); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="<?= base_url('assets/dashboard'); ?>/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/dashboard'); ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/assets/sweetalert/sweetalert2.all.min.js"></script>
<script src="<?= base_url('assets/dashboard'); ?>/vendor/chart.js/Chart.min.js"></script>
<script src="<?= base_url('assets/dashboard'); ?>/js/demo/chart-area-demo.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>

<script>
$(document).ready(function () {
    $('#dataTable').DataTable();
    $('#dataTableHover').DataTable();
    $('#hadirTamu').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
        ]
    });
});

function copyToClipboard(element) {
    var $temp = $('<input>');
    $('body').append($temp);
    $temp.val($(element).text()).select();
    document.execCommand('copy');
    $temp.remove();
}

$('#diulemSidebarMinimize').on('click', function() {
    $('body').toggleClass('diulem-sidebar-collapsed');
    $(this).find('.ti')
        .toggleClass('ti-layout-sidebar-left-collapse')
        .toggleClass('ti-layout-sidebar-left-expand');
});
</script>
<script>
$(function() {
    <?php if (session()->has('success')) { ?>
        Swal.fire({
            icon: 'success',
            title: 'Great!',
            text: '<?= session('success') ?>'
        })
    <?php } ?>
    <?php if (session()->has('deleted')) { ?>
        Swal.fire({
            icon: 'warning',
            title: 'Great!',
            text: '<?= session('deleted') ?>'
        })
    <?php } ?>
    <?php if (session()->has('updated')) { ?>
        Swal.fire({
            icon: 'success',
            title: 'Great!',
            text: '<?= session('updated') ?>'
        })
    <?php } ?>
    <?php if (session()->has('error')) { ?>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '<?= session('error') ?>'
        })
    <?php } ?>
});
</script>
</body>

</html>
