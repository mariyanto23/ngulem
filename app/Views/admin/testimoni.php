<div class="page-body">
    <div class="container-xl">
        <div class="page-header d-print-none mb-3">
            <div class="row align-items-center">
                <div class="col">
                    <div class="page-pretitle">Admin</div>
                    <h1 class="page-title"><?= esc($title); ?></h1>
                    <div class="diulem-admin-page-note">Tinjau ulasan pelanggan, tampilkan yang paling layak dipublikasikan, dan jaga kualitas social proof di landing page.</div>
                </div>
            </div>
        </div>

        <?php
        $totalTestimoni = count($testimoni);
        $tampilCount = 0;
        $hiddenCount = 0;
        foreach ($testimoni as $item) {
            if ($item->status == '2') {
                $tampilCount++;
            } elseif ($item->status == '1') {
                $hiddenCount++;
            }
        }
        ?>

        <div class="row row-cards mb-3">
            <div class="col-sm-6 col-lg-4">
                <div class="card diulem-admin-summary-card">
                    <div class="card-body">
                        <div>
                            <div class="diulem-admin-summary-label">Total Testimonial</div>
                            <div class="diulem-admin-summary-value"><?= $totalTestimoni ?></div>
                            <div class="diulem-admin-summary-help">Semua ulasan yang masuk ke sistem.</div>
                        </div>
                        <span class="diulem-admin-stat-icon"><i class="ti ti-message-heart"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="card diulem-admin-summary-card">
                    <div class="card-body">
                        <div>
                            <div class="diulem-admin-summary-label">Sedang Tampil</div>
                            <div class="diulem-admin-summary-value"><?= $tampilCount ?></div>
                            <div class="diulem-admin-summary-help">Aktif sebagai social proof di publik.</div>
                        </div>
                        <span class="diulem-admin-stat-icon"><i class="ti ti-eye-check"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="card diulem-admin-summary-card">
                    <div class="card-body">
                        <div>
                            <div class="diulem-admin-summary-label">Tidak Tampil</div>
                            <div class="diulem-admin-summary-value"><?= $hiddenCount ?></div>
                            <div class="diulem-admin-summary-help">Masih disimpan tapi belum dipublikasikan.</div>
                        </div>
                        <span class="diulem-admin-stat-icon"><i class="ti ti-eye-off"></i></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="card-title">Data Testimonial</h3>
                    <div class="diulem-admin-card-note">Gunakan tabel ini untuk memilih testimonial terbaik dan menyembunyikan ulasan yang belum siap dipublikasikan.</div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-vcenter card-table" id="dataTable">
                    <thead>
                        <tr>
                            <th>Nama Lengkap</th>
                            <th>Kota</th>
                            <th>Provinsi</th>
                            <th>Ulasan</th>
                            <th>Status</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($testimoni as $row) { ?>
                        <tr>
                            <td><div class="fw-semibold"><?= esc($row->nama_lengkap) ?></div></td>
                            <td><?= esc($row->kota) ?></td>
                            <td><?= esc($row->provinsi) ?></td>
                            <td><div class="diulem-admin-meta text-wrap"><?= esc($row->ulasan) ?></div></td>
                            <?php if ($row->status == '1') { ?>
                                <td><span class="badge bg-warning text-warning-fg">Tidak Tampil</span></td>
                            <?php } elseif ($row->status == '2') { ?>
                                <td><span class="badge bg-success text-success-fg">Tampil</span></td>
                            <?php } else { ?>
                                <td><span class="badge bg-secondary text-secondary-fg">Draft</span></td>
                            <?php } ?>
                            <td class="text-end">
                                <div class="btn-list justify-content-end flex-nowrap">
                                    <button type="button" class="btn btn-success btn-sm btn-icon aktifBtn" data-id="<?= esc($row->id_testi) ?>" data-bs-toggle="modal" data-bs-target="#modalAktif" title="Aktifkan" aria-label="Aktifkan">
                                        <i class="ti ti-check"></i>
                                    </button>
                                    <button type="button" class="btn btn-warning btn-sm btn-icon nonaktifBtn" data-id="<?= esc($row->id_testi) ?>" data-bs-toggle="modal" data-bs-target="#modalNonaktif" title="Nonaktifkan" aria-label="Nonaktifkan">
                                        <i class="ti ti-eye-off"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm btn-icon hapus" data-id="<?= esc($row->id_testi) ?>" data-bs-toggle="modal" data-bs-target="#modalHapus" title="Hapus" aria-label="Hapus">
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

<?= view('admin/components/confirm_modal', [
    'modalId' => 'modalAktif',
    'message' => 'Apakah kamu yakin ingin mengaktifkan testimonial ini?',
    'hiddenName' => 'idtesti',
    'hiddenId' => 'idtestiAktif',
    'confirmId' => 'aktiftesti',
    'confirmText' => 'Ya, Aktifkan',
    'confirmClass' => 'btn-success',
]) ?>

<?= view('admin/components/confirm_modal', [
    'modalId' => 'modalNonaktif',
    'message' => 'Apakah kamu yakin ingin menonaktifkan testimonial ini?',
    'hiddenName' => 'idtesti',
    'hiddenId' => 'idtestiNonaktif',
    'confirmId' => 'nonaktiftesti',
    'confirmText' => 'Ya, Nonaktifkan',
    'confirmClass' => 'btn-warning',
]) ?>

<?= view('admin/components/confirm_modal', [
    'modalId' => 'modalHapus',
    'message' => 'Apakah kamu yakin ingin menghapus testimonial ini?',
    'hiddenName' => 'idtesti',
    'hiddenId' => 'idtestiHapus',
    'confirmId' => 'hapusBtn',
    'confirmText' => 'Hapus',
    'confirmClass' => 'btn-danger',
]) ?>

<script>
$('.aktifBtn').on('click', function () {
    $('#modalAktif #idtestiAktif').val($(this).data('id'));
});

$('.nonaktifBtn').on('click', function () {
    $('#modalNonaktif #idtestiNonaktif').val($(this).data('id'));
});

$('.hapus').on('click', function () {
    $('#modalHapus #idtestiHapus').val($(this).data('id'));
});

$('#aktiftesti').on('click', function() {
    DiulemAdmin.post("<?= base_url('admin/aktiftesti') ?>", {
        id: $('#idtestiAktif').val()
    }, {
        button: $(this),
        successMessage: 'Testimonial berhasil diaktifkan.',
        errorMessage: 'Testimonial gagal diaktifkan.'
    });
});

$('#nonaktiftesti').on('click', function() {
    DiulemAdmin.post("<?= base_url('admin/nonaktiftesti') ?>", {
        id: $('#idtestiNonaktif').val()
    }, {
        button: $(this),
        successMessage: 'Testimonial berhasil dinonaktifkan.',
        errorMessage: 'Testimonial gagal dinonaktifkan.'
    });
});

$('#hapusBtn').on('click', function() {
    DiulemAdmin.post("<?= base_url('admin/hapustesti') ?>", {
        id: $('#idtestiHapus').val()
    }, {
        button: $(this),
        successMessage: 'Testimonial berhasil dihapus.',
        errorMessage: 'Testimonial gagal dihapus.'
    });
});
</script>
