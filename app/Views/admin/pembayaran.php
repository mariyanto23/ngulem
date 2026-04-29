<div class="page-body">
    <div class="container-xl">
        <div class="page-header d-print-none mb-3">
            <div class="row align-items-center">
                <div class="col">
                    <div class="page-pretitle">Transaksi</div>
                    <h1 class="page-title"><?= esc($title); ?></h1>
                    <div class="diulem-admin-page-note">Pantau invoice, validasi pembayaran, dan lihat status tagihan pengguna dari satu tempat.</div>
                </div>
            </div>
        </div>

        <?php
        foreach ($setting as $set) {
            $trial = $set->trial;
        }
        foreach ($setting_bayar as $bayar) {
            $metode_bayar = $bayar->metode_bayar;
        }
        $isManualPayment = in_array($metode_bayar, ['manual', 'manual_qris'], true);
        ?>

        <?php
        $totalInvoice = count($join);
        $pendingCount = 0;
        $expiredCount = 0;
        $unpaidCount = 0;
        $paidCount = 0;
        foreach ($join as $summaryRow) {
            $masaAktif = $summaryRow->masa_aktif;
            $tglNonaktifSummary = strtotime('+' . $masaAktif . ' days', strtotime($summaryRow->tgl_bayar));
            if ($summaryRow->statusPembayaran == '1') {
                $pendingCount++;
            } elseif ($summaryRow->statusPembayaran == 2 && strtotime('now') >= $tglNonaktifSummary) {
                $expiredCount++;
            } elseif ($summaryRow->statusPembayaran == 0) {
                $unpaidCount++;
            } else {
                $paidCount++;
            }
        }
        ?>

        <div class="row row-cards mb-3">
            <div class="col-sm-6 col-lg-3">
                <div class="card diulem-admin-summary-card">
                    <div class="card-body">
                        <div>
                            <div class="diulem-admin-summary-label">Total Invoice</div>
                            <div class="diulem-admin-summary-value"><?= $totalInvoice ?></div>
                            <div class="diulem-admin-summary-help">Semua tagihan yang tercatat.</div>
                        </div>
                        <span class="diulem-admin-stat-icon"><i class="ti ti-receipt-2"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card diulem-admin-summary-card">
                    <div class="card-body">
                        <div>
                            <div class="diulem-admin-summary-label">Menunggu</div>
                            <div class="diulem-admin-summary-value"><?= $pendingCount ?></div>
                            <div class="diulem-admin-summary-help">Perlu ditinjau dan dikonfirmasi.</div>
                        </div>
                        <span class="diulem-admin-stat-icon"><i class="ti ti-clock-hour-4"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card diulem-admin-summary-card">
                    <div class="card-body">
                        <div>
                            <div class="diulem-admin-summary-label">Belum Lunas</div>
                            <div class="diulem-admin-summary-value"><?= $unpaidCount ?></div>
                            <div class="diulem-admin-summary-help">Belum ada pembayaran yang valid.</div>
                        </div>
                        <span class="diulem-admin-stat-icon"><i class="ti ti-alert-circle"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card diulem-admin-summary-card">
                    <div class="card-body">
                        <div>
                            <div class="diulem-admin-summary-label">Lunas / Expired</div>
                            <div class="diulem-admin-summary-value"><?= $paidCount ?> / <?= $expiredCount ?></div>
                            <div class="diulem-admin-summary-help">Pembayaran aktif dibanding yang sudah habis.</div>
                        </div>
                        <span class="diulem-admin-stat-icon"><i class="ti ti-chart-donut-2"></i></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="card-title">Data Pembayaran</h3>
                    <div class="diulem-admin-card-note">Gunakan tabel ini untuk memeriksa bukti pembayaran dan mengaktifkan pesanan dengan cepat.</div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-vcenter card-table" id="dataTable">
                    <thead>
                        <tr>
                            <th>No Invoice</th>
                            <th>Pengguna</th>
                            <th>Domain</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($join as $row) {
                        $masa_aktif = $row->masa_aktif;
                        $tglExp = strtotime('+'.$trial.' days', strtotime($row->tgl_daftar));
                        $today = strtotime('now');
                        $tglNonaktif = strtotime('+'.$masa_aktif.' days', strtotime($row->tgl_bayar));
                    ?>
                        <tr>
                            <td>
                                <div class="diulem-admin-mono">#<?= esc($row->invoice) ?></div>
                                <span class="diulem-admin-meta"><?= esc($row->payment_type ?: 'manual') ?></span>
                            </td>
                            <td>
                                <div class="fw-semibold"><?= esc($row->username) ?></div>
                                <span class="diulem-admin-meta"><?= esc($row->nama_lengkap) ?></span>
                            </td>
                            <td>
                                <a class="diulem-admin-table-link" target="_blank" href="<?= rtrim(SITE_UNDANGAN, '/') . '/' . esc($row->domain) ?>">
                                    <i class="ti ti-world"></i>
                                    <span><?= esc($row->domain) ?></span>
                                </a>
                            </td>
                            <td><span class="diulem-admin-mono"><?= rupiah($row->harga) ?></span></td>
                            <?php if ($row->statusPembayaran == '1') { ?>
                                <td><span class="badge bg-warning text-warning-fg">Menunggu Konfirmasi</span></td>
                            <?php } elseif ($row->statusPembayaran == 2 && $today >= $tglNonaktif) { ?>
                                <td><span class="badge bg-danger text-danger-fg">Expired</span></td>
                            <?php } elseif ($row->statusPembayaran == 0) { ?>
                                <td><span class="badge bg-secondary text-secondary-fg">Belum Lunas</span></td>
                            <?php } else { ?>
                                <td><span class="badge bg-success text-success-fg">Lunas</span></td>
                            <?php } ?>
                            <td class="text-end">
                                <div class="btn-list justify-content-end flex-nowrap">
                                    <?php if ($isManualPayment) { ?>
                                        <button type="button" class="btn btn-info btn-sm btn-icon lihatBukti" title="Lihat bukti" aria-label="Lihat bukti"
                                            data-nama="<?= esc($row->nama_lengkap) ?>"
                                            data-bank="<?= esc($row->nama_bank) ?>"
                                            data-invoice="<?= esc($row->invoice) ?>"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalData">
                                            <i class="ti ti-eye"></i>
                                        </button>
                                    <?php } ?>
                                    <button type="button" class="btn btn-success btn-sm btn-icon konfirmasiBtn" title="Konfirmasi" aria-label="Konfirmasi" data-id="<?= esc($row->id_user) ?>">
                                        <i class="ti ti-check"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalData" tabindex="-1" role="dialog" aria-labelledby="modalDataLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDataLabel">Bukti Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input id="nama_lengkap" type="text" class="form-control" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Bank / E-Wallet</label>
                    <input id="nama_bank" type="text" class="form-control" readonly>
                </div>
                <div>
                    <label class="form-label">Bukti Pembayaran</label>
                    <img id="bukti" src="" class="diulem-admin-proof" alt="Bukti transfer">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
$('#modalData').on('show.bs.modal', function(e) {
    var $button = $(e.relatedTarget);
    $('#nama_lengkap').val($button.data('nama'));
    $('#nama_bank').val($button.data('bank'));
    $('#bukti').attr('src', '<?= base_url() ?>/assets/bukti/' + $button.data('invoice') + '.png');
});

$('.konfirmasiBtn').on('click', function() {
    var $button = $(this);

    DiulemAdmin.confirm({
        title: 'Konfirmasi Pembayaran',
        text: 'Konfirmasi pembayaran pengguna ini?',
        confirmButtonText: 'Ya, Konfirmasi'
    }).then(function(result) {
        if (!result.value) {
            return;
        }

        DiulemAdmin.post("<?= base_url('admin/konfirmasi') ?>", {
            id: $button.data('id')
        }, {
            button: $button,
            successMessage: 'Pengguna berhasil dikonfirmasi.',
            errorMessage: 'Pengguna gagal dikonfirmasi.'
        });
    });
});
</script>
