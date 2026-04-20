<?php
$metode_bayar = $setting_bayar[0]->metode_bayar;
$masa_aktif = $order[0]->masa_aktif;
$trial = $setting[0]->trial;
$durasi = '+' . $trial . ' days';
$tglDaftar = $order[0]->created_at;
$tglExp = strtotime($durasi, strtotime($tglDaftar));
$tglExpFormated = date('d-m-Y H:i', $tglExp);
$today = strtotime('now');
$tglBayar = $pembayaran[0]->tglBayar;
$aktif = '+' . $masa_aktif . ' days';
$tglNonaktif = strtotime($aktif, strtotime($tglBayar));
$tglNonaktifFormated = date('d-m-Y H:i', $tglNonaktif) . ' WIB';
$expiry = strtotime($pembayaran[0]->transaction_expired);
$expiry_date = date('d-m-Y H:i A', $expiry);
$undanganUrl = rtrim(SITE_UNDANGAN, '/') . '/' . $order[0]->domain;
$hasWeeklyVisitors = false;

$statusLabel = 'Trial';
$statusClass = 'bg-warning text-warning-fg';
$statusMessage = 'Selesaikan pembayaran anda sebelum ' . $tglExpFormated . ' untuk menikmati fiturnya.';
$billingLabel = 'Belum Lunas';
$billingClass = 'bg-warning text-warning-fg';
$billingMeta = 'Trial sampai ' . $tglExpFormated;

if ($pembayaran[0]->status == 0) {
    if ($today >= $tglExp) {
        $statusLabel = 'Tidak Aktif';
        $statusClass = 'bg-danger text-danger-fg';
        $billingLabel = 'Trial Berakhir';
        $billingClass = 'bg-danger text-danger-fg';
        $billingMeta = 'Perlu pembayaran baru';
    }
} else if ($pembayaran[0]->status == 1 && $metode_bayar == 'manual') {
    $statusLabel = $today < $tglExp ? 'Menunggu Konfirmasi' : 'Tidak Aktif';
    $statusClass = $today < $tglExp ? 'bg-warning text-warning-fg' : 'bg-danger text-danger-fg';
    $statusMessage = 'Pembayaran anda menunggu dikonfirmasi.';
    $billingLabel = 'Menunggu Konfirmasi';
    $billingClass = 'bg-warning text-warning-fg';
    $billingMeta = 'Tim akan memverifikasi pembayaran';
} else if ($pembayaran[0]->status == 1 && $metode_bayar != 'manual') {
    $statusLabel = $today < $tglExp ? 'Menunggu Pembayaran' : 'Tidak Aktif';
    $statusClass = $today < $tglExp ? 'bg-warning text-warning-fg' : 'bg-danger text-danger-fg';
    $statusMessage = 'Selesaikan pembayaran anda sebelum ' . $expiry_date . '.';
    $billingLabel = 'Menunggu Pembayaran';
    $billingClass = 'bg-warning text-warning-fg';
    $billingMeta = 'Batas bayar ' . $expiry_date;
} else if ($pembayaran[0]->status == 2 && $today >= $tglNonaktif) {
    $statusLabel = 'Tidak Aktif';
    $statusClass = 'bg-danger text-danger-fg';
    $statusMessage = 'Masa aktif undangan sudah habis pada tanggal ' . $tglNonaktifFormated . '.';
    $billingLabel = 'Perlu Perpanjangan';
    $billingClass = 'bg-danger text-danger-fg';
    $billingMeta = 'Berakhir ' . $tglNonaktifFormated;
} else {
    $statusLabel = 'Aktif';
    $statusClass = 'bg-success text-success-fg';
    $statusMessage = 'Sampai ' . $tglNonaktifFormated . '.';
    $billingLabel = 'Lunas';
    $billingClass = 'bg-success text-success-fg';
    $billingMeta = 'Aktif sampai ' . $tglNonaktifFormated;
}

foreach ($total_mingguan as $row) {
    if ((int) $row->jumlah > 0) {
        $hasWeeklyVisitors = true;
        break;
    }
}
?>

<div class="page-body">
    <div class="container-xl">
        <div class="diulem-hero mb-4">
            <div class="card-body p-4 p-lg-5">
                <div class="row align-items-center">
                    <div class="col-lg">
                        <div class="badge mb-3">Dashboard Pengguna</div>
                        <h1 class="page-title mb-2"><?= esc($title) ?></h1>
                        <p class="text-secondary mb-0">Selamat datang, <?= esc($_SESSION['uname']) ?>!</p>
                    </div>
                    <div class="col-lg-auto mt-4 mt-lg-0">
                        <div class="btn-list">
                            <a href="<?= $undanganUrl ?>" target="_blank" class="btn btn-light">
                                <i class="ti ti-external-link me-2"></i>Lihat Website
                            </a>
                            <a href="<?= base_url('user/invoice') ?>" class="btn btn-outline-light">
                                <i class="ti ti-receipt-2 me-2"></i>Invoice
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-cards mb-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="text-secondary">Status Undangan</div>
                                <div class="h2 mb-2"><span class="badge <?= $statusClass ?>"><?= $statusLabel ?></span></div>
                                <div class="text-secondary small"><?= esc($statusMessage) ?></div>
                            </div>
                            <div class="col-auto">
                                <span class="diulem-stat-icon"><i class="ti ti-shield-check"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="text-secondary">Status Tagihan</div>
                                <div class="h2 mb-2"><span class="badge <?= $billingClass ?>"><?= esc($billingLabel) ?></span></div>
                                <div class="text-secondary small"><?= esc($billingMeta) ?></div>
                            </div>
                            <div class="col-auto">
                                <span class="diulem-stat-icon"><i class="ti ti-receipt-2"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="text-secondary">Aktivitas</div>
                                <div class="h1 mb-0"><?= esc($total_pengunjung) ?></div>
                                <div class="text-secondary small"><?= esc($total_komentar) ?> ucapan masuk</div>
                            </div>
                            <div class="col-auto">
                                <span class="diulem-stat-icon"><i class="ti ti-users"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-cards">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pengunjung 7 Hari Terakhir</h3>
                    </div>
                    <div class="card-body">
                        <?php if ($hasWeeklyVisitors) { ?>
                            <div class="chart-area">
                                <canvas id="myAreaChart"></canvas>
                            </div>
                        <?php } else { ?>
                            <div class="empty">
                                <div class="empty-icon">
                                    <i class="ti ti-chart-line"></i>
                                </div>
                                <p class="empty-title">Belum ada data pengunjung minggu ini</p>
                                <p class="empty-subtitle text-secondary">Bagikan link undangan untuk mulai melihat aktivitas kunjungan.</p>
                                <div class="empty-action">
                                    <a href="<?= $undanganUrl ?>" target="_blank" class="btn btn-primary">
                                        <i class="ti ti-external-link me-2"></i>Lihat Website
                                    </a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Aksi Cepat</h3>
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="<?= base_url('user/pengaturan') ?>" class="list-group-item list-group-item-action">
                            <i class="ti ti-settings me-2 text-primary"></i>Pengaturan Website
                        </a>
                        <a href="<?= base_url('user/mempelai') ?>" class="list-group-item list-group-item-action">
                            <i class="ti ti-heart me-2 text-primary"></i>Data Mempelai
                        </a>
                        <a href="<?= base_url('user/acara') ?>" class="list-group-item list-group-item-action">
                            <i class="ti ti-calendar-event me-2 text-primary"></i>Data Acara
                        </a>
                        <a href="<?= base_url('user/tampilan') ?>" class="list-group-item list-group-item-action">
                            <i class="ti ti-palette me-2 text-primary"></i>Tampilan Undangan
                        </a>
                        <a href="<?= base_url('user/album') ?>" class="list-group-item list-group-item-action">
                            <i class="ti ti-photo me-2 text-primary"></i>Gallery
                        </a>
                        <?php if ($_SESSION['buku_tamu'] == 1) { ?>
                            <a href="<?= base_url('user/tamu') ?>" class="list-group-item list-group-item-action">
                                <i class="ti ti-address-book me-2 text-primary"></i>Data Tamu
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Ucapan</h3>
                        <div class="card-actions">
                            <a href="<?= base_url('user/ucapan') ?>" class="btn btn-outline-primary btn-sm">Lihat Semua</a>
                        </div>
                    </div>
                    <div class="list-group list-group-flush">
                        <?php
                        $limit = 0;
                        foreach ($komentar as $row) {
                            $limit++;
                            if ($limit > 4) {
                                break;
                            }
                        ?>
                            <div class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="avatar avatar-sm rounded"><i class="ti ti-message"></i></span>
                                    </div>
                                    <div class="col text-truncate">
                                        <div class="text-body d-block text-truncate"><?= esc($row->isi_komentar) ?></div>
                                        <div class="d-block text-secondary text-truncate mt-n1"><?= esc($row->nama_komentar) ?></div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if (empty($komentar)) { ?>
                            <div class="list-group-item text-secondary">Belum ada ucapan.</div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
var jumlah = [];
var tanggal = [];
moment.locale('id');
var namaBulan = moment().format('MMMM');

<?php foreach ($total_mingguan as $row) { ?>
jumlah.push(<?= $row->jumlah ?>);
tanggal.push(<?= $row->tanggal ?> + ' ' + namaBulan);
<?php } ?>
</script>
