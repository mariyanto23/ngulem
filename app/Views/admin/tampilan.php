<div class="page-body">
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">Undangan Website</div>
                    <h2 class="page-title"><?= esc($title); ?></h2>
                    <div class="diulem-admin-page-note">Kelola tema website, aktifkan yang siap dijual, dan atur katalog visual agar mudah discan oleh tim admin.</div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                        <i class="ti ti-plus me-2"></i>Tambah Tema
                    </button>
                </div>
            </div>
        </div>

        <div class="row row-cards">
            <?php foreach ($tema as $row) { ?>
                <?php $isActive = (string) $row->status !== '0'; ?>
                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="card h-100 diulem-admin-theme-card <?= $isActive ? '' : 'is-muted' ?>">
                        <div class="diulem-admin-theme-preview">
                            <img src="<?= base_url() ?>/assets/themes/<?= esc($row->nama_theme) ?>/preview.png" alt="<?= esc($row->nama_theme) ?>">
                            <span class="badge <?= $isActive ? 'bg-teal-lt text-teal' : 'bg-secondary-lt text-secondary' ?> diulem-admin-theme-status">
                                <?= $isActive ? 'Aktif' : 'Nonaktif' ?>
                            </span>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between gap-2">
                                <div>
                                    <div class="card-title mb-1"><?= esc($row->nama_theme) ?></div>
                                    <div class="text-secondary small"><?= esc($row->name) ?></div>
                                </div>
                            </div>
                            <div class="diulem-admin-feature-list">
                                <span class="diulem-admin-feature-pill is-on"><i class="ti ti-layout"></i>Kode <?= esc($row->kode_theme) ?></span>
                                <span class="diulem-admin-feature-pill <?= $isActive ? 'is-on' : 'is-off' ?>"><i class="ti <?= $isActive ? 'ti-check' : 'ti-ban' ?>"></i><?= $isActive ? 'Siap Digunakan' : 'Disembunyikan' ?></span>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <div class="d-flex gap-2">
                                <?php if (! $isActive) { ?>
                                    <button class="btn btn-success btn-icon pilih" data-id="<?= esc($row->id) ?>" data-bs-toggle="modal" data-bs-target="#modalAktif" title="Aktifkan tema">
                                        <i class="ti ti-check"></i>
                                    </button>
                                <?php } else { ?>
                                    <button class="btn btn-warning btn-icon pilih2" data-id="<?= esc($row->id) ?>" data-bs-toggle="modal" data-bs-target="#modalNonaktif" title="Nonaktifkan tema">
                                        <i class="ti ti-ban"></i>
                                    </button>
                                <?php } ?>
                                <a href="<?= SITE_UTAMA . '/demo/' . $row->nama_theme ?>" target="_blank" class="btn btn-primary btn-icon" title="Lihat demo">
                                    <i class="ti ti-eye"></i>
                                </a>
                                <button class="btn btn-danger btn-icon hapus ms-auto" data-id="<?= esc($row->id) ?>" data-bs-toggle="modal" data-bs-target="#modalHapus" title="Hapus tema">
                                    <i class="ti ti-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<form method="post" enctype="multipart/form-data" action="<?= base_url('admin/upload_theme'); ?>">
    <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">Tambah Tema Website</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Tema</label>
                        <input type="text" class="form-control" name="namatema" required>
                        <input type="hidden" class="form-control" name="kodetema" value="A<?= sprintf('%03s', $kode); ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select class="form-select" id="categories" name="categories" required>
                            <option value="">Pilih kategori</option>
                            <?php foreach ($categories as $row) { ?>
                                <option value="<?= esc($row->id) ?>"><?= esc($row->name) ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">File View Undangan (.php)</label>
                        <input type="file" class="form-control" name="viewfile" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">File Assets (.zip)</label>
                        <input type="file" class="form-control" name="assetfile" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-device-floppy me-2"></i>Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<?= view('admin/components/confirm_modal', [
    'modalId' => 'modalAktif',
    'title' => 'Aktifkan Tema',
    'message' => 'Apakah kamu yakin ingin mengaktifkan tema ini?',
    'hiddenName' => 'idTema',
    'hiddenId' => 'idTemaAktif',
    'confirmId' => 'pilihAktif',
    'confirmText' => 'Aktifkan',
    'confirmClass' => 'btn-success',
]) ?>

<?= view('admin/components/confirm_modal', [
    'modalId' => 'modalNonaktif',
    'title' => 'Nonaktifkan Tema',
    'message' => 'Apakah kamu yakin ingin menonaktifkan tema ini?',
    'hiddenName' => 'idTema',
    'hiddenId' => 'idTemaNonaktif',
    'confirmId' => 'pilihNonaktif',
    'confirmText' => 'Nonaktifkan',
    'confirmClass' => 'btn-warning',
]) ?>

<?= view('admin/components/confirm_modal', [
    'modalId' => 'modalHapus',
    'title' => 'Hapus Tema',
    'message' => 'Tema yang dihapus tidak bisa dikembalikan. Lanjutkan?',
    'hiddenName' => 'idTema',
    'hiddenId' => 'idTemaHapus',
    'confirmId' => 'pilihHapus',
    'confirmText' => 'Hapus',
    'confirmClass' => 'btn-danger',
]) ?>

<script>
$(function () {
    $('.pilih').on('click', function () {
        $('#idTemaAktif').val($(this).data('id'));
    });

    $('.pilih2').on('click', function () {
        $('#idTemaNonaktif').val($(this).data('id'));
    });

    $('.hapus').on('click', function () {
        $('#idTemaHapus').val($(this).data('id'));
    });

    $('#pilihAktif').on('click', function () {
        DiulemAdmin.post("<?= base_url('admin/aktif_tema') ?>", { id: $('#idTemaAktif').val() }, {
            button: this,
            successMessage: 'Tema berhasil diaktifkan.',
            errorMessage: 'Tema gagal diaktifkan.'
        });
    });

    $('#pilihNonaktif').on('click', function () {
        DiulemAdmin.post("<?= base_url('admin/nonaktif_tema') ?>", { id: $('#idTemaNonaktif').val() }, {
            button: this,
            successMessage: 'Tema berhasil dinonaktifkan.',
            errorMessage: 'Tema gagal dinonaktifkan.'
        });
    });

    $('#pilihHapus').on('click', function () {
        DiulemAdmin.post("<?= base_url('admin/delete_theme') ?>", { id: $('#idTemaHapus').val() }, {
            button: this,
            successMessage: 'Tema berhasil dihapus.',
            errorMessage: 'Tema gagal dihapus.'
        });
    });
});
</script>
