<div class="page-body">
    <div class="container-xl">
        <div class="page-header d-print-none mb-3">
            <div class="row align-items-center">
                <div class="col">
                    <div class="page-pretitle">Admin</div>
                    <h1 class="page-title"><?= esc($title); ?></h1>
                    <div class="diulem-admin-page-note">Kelola akun undangan, pantau masa aktif, dan masuk cepat ke data pengguna yang perlu dibantu.</div>
                </div>
            </div>
        </div>

        <?php foreach ($setting as $set) {
            $trial = $set->trial;
        } ?>

        <?php
        $totalPengguna = count($join);
        $aktifCount = 0;
        $trialCount = 0;
        $nonaktifCount = 0;
        $today = strtotime('now');
        foreach ($join as $summaryRow) {
            $masaAktif = $summaryRow->masa_aktif;
            $tglExpSummary = strtotime('+' . $trial . ' days', strtotime($summaryRow->tgl_daftar));
            $tglNonaktifSummary = strtotime('+' . $masaAktif . ' days', strtotime($summaryRow->tgl_bayar));
            if ($summaryRow->statusPembayaran == 2 && $today < $tglNonaktifSummary) {
                $aktifCount++;
            } elseif ($summaryRow->statusPembayaran != 2 && $today < $tglExpSummary) {
                $trialCount++;
            } else {
                $nonaktifCount++;
            }
        }
        ?>

        <div class="row row-cards mb-3">
            <div class="col-sm-6 col-lg-3">
                <div class="card diulem-admin-summary-card">
                    <div class="card-body">
                        <div>
                            <div class="diulem-admin-summary-label">Total Pengguna</div>
                            <div class="diulem-admin-summary-value"><?= $totalPengguna ?></div>
                            <div class="diulem-admin-summary-help">Semua akun undangan terdaftar.</div>
                        </div>
                        <span class="diulem-admin-stat-icon"><i class="ti ti-users"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card diulem-admin-summary-card">
                    <div class="card-body">
                        <div>
                            <div class="diulem-admin-summary-label">Aktif</div>
                            <div class="diulem-admin-summary-value"><?= $aktifCount ?></div>
                            <div class="diulem-admin-summary-help">Pembayaran lunas dan masa aktif berjalan.</div>
                        </div>
                        <span class="diulem-admin-stat-icon"><i class="ti ti-badge-check"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card diulem-admin-summary-card">
                    <div class="card-body">
                        <div>
                            <div class="diulem-admin-summary-label">Trial</div>
                            <div class="diulem-admin-summary-value"><?= $trialCount ?></div>
                            <div class="diulem-admin-summary-help">Masih dalam masa coba undangan.</div>
                        </div>
                        <span class="diulem-admin-stat-icon"><i class="ti ti-hourglass"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card diulem-admin-summary-card">
                    <div class="card-body">
                        <div>
                            <div class="diulem-admin-summary-label">Tidak Aktif</div>
                            <div class="diulem-admin-summary-value"><?= $nonaktifCount ?></div>
                            <div class="diulem-admin-summary-help">Perlu follow up atau aktivasi ulang.</div>
                        </div>
                        <span class="diulem-admin-stat-icon"><i class="ti ti-user-off"></i></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="card-title">Data Pengguna</h3>
                    <div class="diulem-admin-card-note">Daftar akun pengguna berikut domain undangan dan status masa aktifnya.</div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-vcenter card-table" id="dataTable">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Domain</th>
                            <th>Exp</th>
                            <th>Status</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($join as $row) {
                        $masa_aktif = $row->masa_aktif;
                        $tglExp = strtotime('+'.$trial.' days', strtotime($row->tgl_daftar));
                        $tglNonaktif = strtotime('+'.$masa_aktif.' days', strtotime($row->tgl_bayar));
                        $tglSelesai = $row->statusPembayaran == 2
                            ? date('d-m-Y H:i', $tglNonaktif) . ' WIB'
                            : date('d-m-Y H:i', $tglExp) . ' WIB';
                    ?>
                        <tr>
                            <td>
                                <div class="fw-semibold"><?= esc($row->username ?: $row->email) ?></div>
                                <span class="diulem-admin-meta"><?= esc($row->email) ?></span>
                            </td>
                            <td>
                                <a class="diulem-admin-table-link" target="_blank" href="<?= rtrim(SITE_UNDANGAN, '/') . '/' . esc($row->domain) ?>">
                                    <i class="ti ti-world"></i>
                                    <span><?= esc($row->domain) ?></span>
                                </a>
                            </td>
                            <td>
                                <span class="diulem-admin-mono"><?= esc($tglSelesai) ?></span>
                            </td>
                            <?php if ($row->statusPembayaran == 2 && $today < $tglNonaktif) { ?>
                                <td><span class="badge bg-success text-success-fg">Aktif</span></td>
                            <?php } elseif ($row->statusPembayaran != 2 && $today < $tglExp) { ?>
                                <td><span class="badge bg-warning text-warning-fg">Trial</span></td>
                            <?php } else { ?>
                                <td><span class="badge bg-danger text-danger-fg">Tidak Aktif</span></td>
                            <?php } ?>
                            <td class="text-end">
                                <div class="btn-list justify-content-end flex-nowrap">
                                    <form method="post" action="<?= base_url('admin/edit_pengguna/mempelai'); ?>">
                                        <input type="hidden" value="<?= esc($row->id_user) ?>" name="id">
                                        <button class="btn btn-sm btn-primary btn-icon" type="submit" title="Edit pengguna" aria-label="Edit pengguna">
                                            <i class="ti ti-pencil"></i>
                                        </button>
                                    </form>
                                    <button type="button" data-id="<?= esc($row->id_user) ?>" data-kunci="<?= esc($row->kunci) ?>" class="btn btn-sm btn-danger btn-icon hapus" data-bs-toggle="modal" data-bs-target="#modalHapus" title="Hapus pengguna" aria-label="Hapus pengguna">
                                        <i class="ti ti-trash"></i>
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

<div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalHapusLabel">Peringatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah kamu yakin ingin menghapus pengguna ini?<br>
                <strong>Semua data pengguna termasuk website akan terhapus.</strong>
                <input type="hidden" id="iduser" value="">
                <input type="hidden" id="kunci" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger" id="hapusBtn">Hapus</button>
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
$('.hapus').on('click', function () {
    $('#modalHapus #iduser').val($(this).data('id'));
    $('#modalHapus #kunci').val($(this).data('kunci'));
});

$('#hapusBtn').on('click', function() {
    DiulemAdmin.post("<?= base_url('admin/hapus_user') ?>", {
        id: $('#iduser').val(),
        kunci: $('#kunci').val()
    }, {
        button: $(this),
        successMessage: 'Pengguna berhasil dihapus.',
        errorMessage: 'Pengguna gagal dihapus.'
    });
});
</script>
