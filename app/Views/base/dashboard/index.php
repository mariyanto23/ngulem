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
$tglNonaktifFormated = date('d-m-Y H:i A', $tglNonaktif);
$expiry = strtotime($pembayaran[0]->transaction_expired);
$expiry_date = date('d-m-Y H:i A', $expiry);
$undanganUrl = rtrim(SITE_UNDANGAN, '/') . '/' . $order[0]->domain;

$statusLabel = 'Trial';
$statusClass = 'bg-warning text-warning-fg';
$statusMessage = 'Selesaikan pembayaran anda sebelum ' . $tglExpFormated . ' untuk menikmati fiturnya.';

if ($pembayaran[0]->status == 0) {
    if ($today >= $tglExp) {
        $statusLabel = 'Tidak Aktif';
        $statusClass = 'bg-danger text-danger-fg';
    }
} else if ($pembayaran[0]->status == 1 && $metode_bayar == 'manual') {
    $statusLabel = $today < $tglExp ? 'Menunggu Konfirmasi' : 'Tidak Aktif';
    $statusClass = $today < $tglExp ? 'bg-warning text-warning-fg' : 'bg-danger text-danger-fg';
    $statusMessage = 'Pembayaran anda menunggu dikonfirmasi.';
} else if ($pembayaran[0]->status == 1 && $metode_bayar != 'manual') {
    $statusLabel = $today < $tglExp ? 'Menunggu Pembayaran' : 'Tidak Aktif';
    $statusClass = $today < $tglExp ? 'bg-warning text-warning-fg' : 'bg-danger text-danger-fg';
    $statusMessage = 'Selesaikan pembayaran anda sebelum ' . $expiry_date . '.';
} else if ($pembayaran[0]->status == 2 && $today >= $tglNonaktif) {
    $statusLabel = 'Tidak Aktif';
    $statusClass = 'bg-danger text-danger-fg';
    $statusMessage = 'Masa aktif undangan sudah habis pada tanggal ' . $tglNonaktifFormated . '.';
} else {
    $statusLabel = 'Aktif';
    $statusClass = 'bg-success text-success-fg';
    $statusMessage = 'Undangan anda aktif sampai tanggal ' . $tglNonaktifFormated . '.';
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
                        <p class="text-secondary mb-0"><?= esc($statusMessage) ?></p>
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
                                <div class="h2 mb-0"><span class="badge <?= $statusClass ?>"><?= $statusLabel ?></span></div>
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
                                <div class="text-secondary">Total Pengunjung</div>
                                <div class="h1 mb-0"><?= esc($total_pengunjung) ?></div>
                            </div>
                            <div class="col-auto">
                                <span class="diulem-stat-icon"><i class="ti ti-users"></i></span>
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
                                <div class="text-secondary">Total Ucapan</div>
                                <div class="h1 mb-0"><?= esc($total_komentar) ?></div>
                            </div>
                            <div class="col-auto">
                                <span class="diulem-stat-icon"><i class="ti ti-messages"></i></span>
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
                        <div class="chart-area">
                            <canvas id="myAreaChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Aksi Cepat</h3>
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="<?= base_url('user/mempelai') ?>" class="list-group-item list-group-item-action">
                            <i class="ti ti-heart me-2 text-primary"></i>Data Mempelai
                        </a>
                        <a href="<?= base_url('user/acara') ?>" class="list-group-item list-group-item-action">
                            <i class="ti ti-calendar-event me-2 text-primary"></i>Data Acara
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
