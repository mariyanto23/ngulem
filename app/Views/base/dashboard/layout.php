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
    <link href="<?= base_url('assets/dashboard/'); ?>/css/diulem-dashboard.css?v=<?= filemtime(FCPATH . 'assets/dashboard/css/diulem-dashboard.css') ?>" rel="stylesheet">

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
$undanganUrl = isset($order[0]->domain) ? rtrim(SITE_UNDANGAN, '/') . '/' . $order[0]->domain : rtrim(SITE_UNDANGAN, '/');
$websiteMenus = ['tampilan', 'pengaturan', 'mempelai', 'acara', 'album', 'cerita', 'rekening'];
$visitorMenus = ['riwayat', 'ucapan'];
$guestMenus = ['tamu', 'setting_bukutamu', 'data_hadir'];
$isWebsiteMenu = in_array($activeMenu, $websiteMenus, true);
$isVisitorMenu = in_array($activeMenu, $visitorMenus, true);
$isGuestMenu = in_array($activeMenu, $guestMenus, true);
?>
<div class="page">
    <aside class="navbar navbar-vertical navbar-expand-lg diulem-sidebar">
        <div class="diulem-sidebar-container">
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
                    <span class="avatar avatar-sm diulem-profile-avatar">
                        <img src="<?= base_url('assets/dashboard'); ?>/img/boy.png" alt="Foto profil">
                    </span>
                    <span class="ms-2 fw-bold"><?= esc($_SESSION['uname']) ?></span>
                    <i class="ti ti-chevron-down ms-1"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a class="dropdown-item" href="<?= base_url('user/profil') ?>"><i class="ti ti-user me-2"></i>Profil</a>
                    <a class="dropdown-item" href="<?= base_url('user/invoice') ?>"><i class="ti ti-receipt me-2"></i>Tagihan</a>
                    <a class="dropdown-item" href="<?= esc($undanganUrl) ?>" target="_blank"><i class="ti ti-external-link me-2"></i>Lihat Undangan</a>
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

                    <li class="nav-item dropdown <?= $isWebsiteMenu ? 'show' : '' ?>">
                        <a class="nav-link dropdown-toggle <?= $isWebsiteMenu ? 'active' : '' ?>" href="#" data-toggle="dropdown" role="button" aria-expanded="<?= $isWebsiteMenu ? 'true' : 'false' ?>">
                            <span class="nav-link-icon d-md-none d-lg-inline-block"><i class="ti ti-browser"></i></span>
                            <span class="nav-link-title">Undangan</span>
                        </a>
                        <div class="dropdown-menu <?= $isWebsiteMenu ? 'show' : '' ?>">
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

                    <li class="nav-item dropdown <?= $isVisitorMenu ? 'show' : '' ?>">
                        <a class="nav-link dropdown-toggle <?= $isVisitorMenu ? 'active' : '' ?>" href="#" data-toggle="dropdown" role="button" aria-expanded="<?= $isVisitorMenu ? 'true' : 'false' ?>">
                            <span class="nav-link-icon d-md-none d-lg-inline-block"><i class="ti ti-chart-line"></i></span>
                            <span class="nav-link-title">Pengunjung</span>
                        </a>
                        <div class="dropdown-menu <?= $isVisitorMenu ? 'show' : '' ?>">
                            <a class="dropdown-item <?= $activeMenu === 'riwayat' ? 'active' : '' ?>" href="<?= base_url('user/riwayat'); ?>">Riwayat</a>
                            <a class="dropdown-item <?= $activeMenu === 'ucapan' ? 'active' : '' ?>" href="<?= base_url('user/ucapan'); ?>">Ucapan</a>
                        </div>
                    </li>

                    <?php if ($_SESSION['buku_tamu'] == 1) { ?>
                        <li class="nav-item dropdown <?= $isGuestMenu ? 'show' : '' ?>">
                            <a class="nav-link dropdown-toggle <?= $isGuestMenu ? 'active' : '' ?>" href="#" data-toggle="dropdown" role="button" aria-expanded="<?= $isGuestMenu ? 'true' : 'false' ?>">
                                <span class="nav-link-icon d-md-none d-lg-inline-block"><i class="ti ti-address-book"></i></span>
                                <span class="nav-link-title">Buku Tamu</span>
                            </a>
                            <div class="dropdown-menu <?= $isGuestMenu ? 'show' : '' ?>">
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
                <div class="navbar-nav flex-row ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-toggle="dropdown" aria-label="Open user menu">
                            <span class="avatar avatar-sm diulem-profile-avatar">
                                <img src="<?= base_url('assets/dashboard'); ?>/img/boy.png" alt="Foto profil">
                            </span>
                            <div class="d-none d-xl-block ps-2">
                                <div><?= esc($_SESSION['uname']) ?></div>
                                <div class="mt-1 small text-secondary">Pengguna</div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <a class="dropdown-item" href="<?= base_url('user/profil') ?>"><i class="ti ti-user me-2"></i>Profil</a>
                            <a class="dropdown-item" href="<?= base_url('user/invoice') ?>"><i class="ti ti-receipt me-2"></i>Tagihan</a>
                            <a class="dropdown-item" href="<?= esc($undanganUrl) ?>" target="_blank"><i class="ti ti-external-link me-2"></i>Lihat Undangan</a>
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
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Foto Mempelai</h4>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="diulem-crop-area">
                    <div id="resizer"></div>
                </div>
                <div class="btn-list mt-3">
                    <button type="button" class="btn btn-outline-secondary rotate" data-deg="-90">
                        <i class="ti ti-rotate-2 me-2"></i>Putar Kiri
                    </button>
                    <button type="button" class="btn btn-outline-secondary rotate" data-deg="90">
                        <i class="ti ti-rotate-clockwise-2 me-2"></i>Putar Kanan
                    </button>
                    <button class="btn btn-primary ms-auto" id="upload">
                        <i class="ti ti-upload me-2"></i>Upload
                    </button>
                </div>
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
<script src="<?= base_url('assets/dashboard'); ?>/vendor/chart.js/Chart.min.js"></script>
<script src="<?= base_url('assets/dashboard'); ?>/js/demo/chart-area-demo.js?v=<?= filemtime(FCPATH . 'assets/dashboard/js/demo/chart-area-demo.js') ?>"></script>
<script src="<?= base_url('assets/dashboard'); ?>/js/diulem-dashboard.js?v=<?= filemtime(FCPATH . 'assets/dashboard/js/diulem-dashboard.js') ?>"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>

<script>
$(document).ready(function () {
    var diulemDataTableLanguage = {
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
        language: diulemDataTableLanguage
    });
    $('#dataTableHover').DataTable({
        language: diulemDataTableLanguage
    });
    var hadirTamuTable = $('#hadirTamu').DataTable({
        dom: "<'diulem-table-toolbar'lf>rtipB",
        language: diulemDataTableLanguage,
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="ti ti-file-spreadsheet me-2"></i>Unduh Excel',
                className: 'btn btn-success btn-sm',
                titleAttr: 'Unduh Excel Data Tamu Hadir'
            }
        ]
    });

    if ($('#hadirTamuExport').length) {
        hadirTamuTable.buttons().container().appendTo('#hadirTamuExport');
    }
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
        DiulemDashboard.notify('success', 'Berhasil', '<?= session('success') ?>');
    <?php } elseif (session()->has('deleted')) { ?>
        DiulemDashboard.notify('warning', 'Dihapus', '<?= session('deleted') ?>');
    <?php } elseif (session()->has('updated')) { ?>
        DiulemDashboard.notify('success', 'Berhasil', '<?= session('updated') ?>');
    <?php } elseif (session()->has('error')) { ?>
        DiulemDashboard.notify('error', 'Gagal', '<?= session('error') ?>');
    <?php } ?>
});
</script>
</body>

</html>
