<div class="page-body">
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">Undangan Video</div>
                    <h2 class="page-title"><?= esc($title); ?></h2>
                    <div class="diulem-admin-page-note">Kelola katalog tema video lengkap dengan kategori, harga, dan preview agar tim admin bisa meninjau konten lebih cepat.</div>
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
                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="card h-100 diulem-admin-theme-card">
                        <div class="diulem-admin-theme-preview">
                            <img src="<?= base_url() ?>/assets/themes_video/<?= esc($row->preview) ?>" alt="<?= esc($row->nama_tema) ?>">
                            <span class="badge bg-teal-lt text-teal diulem-admin-theme-status diulem-admin-theme-status-left"><?= esc($row->name) ?></span>
                        </div>
                        <div class="card-body">
                            <div class="card-title mb-1"><?= esc($row->nama_tema) ?></div>
                            <div class="text-secondary small"><?= rupiah($row->harga) ?></div>
                            <div class="diulem-admin-feature-list">
                                <span class="diulem-admin-feature-pill is-on"><i class="ti ti-category"></i><?= esc($row->name) ?></span>
                                <span class="diulem-admin-feature-pill is-on"><i class="ti ti-wallet"></i><?= rupiah($row->harga) ?></span>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <div class="d-flex gap-2">
                                <button class="btn btn-primary btn-icon btn-demo" data-link="<?= htmlentities($row->url_video) ?>" data-nama="<?= esc($row->nama_tema) ?>" title="Preview video">
                                    <i class="ti ti-player-play"></i>
                                </button>
                                <button class="btn btn-warning btn-icon btn-update" data-id="<?= esc($row->id_theme) ?>" data-harga="<?= esc($row->harga) ?>" data-link="<?= htmlentities($row->url_video) ?>" data-nama="<?= esc($row->nama_tema) ?>" data-kategori="<?= esc($row->category_id) ?>" title="Edit tema">
                                    <i class="ti ti-pencil"></i>
                                </button>
                                <button class="btn btn-danger btn-icon hapus ms-auto" data-id="<?= esc($row->id_theme) ?>" data-nama="<?= esc($row->preview) ?>" data-bs-toggle="modal" data-bs-target="#modalHapus" title="Hapus tema">
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

<form method="post" enctype="multipart/form-data" action="<?= base_url('admin/upload_theme_video'); ?>">
    <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">Tambah Tema Video</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Tema</label>
                        <input type="text" class="form-control" name="namatema" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select class="form-select" id="categories" name="categories" required>
                            <option value="0">Pilih kategori</option>
                            <?php foreach ($categories as $row) { ?>
                                <option value="<?= esc($row->id) ?>"><?= esc($row->name) ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Harga</label>
                        <input type="number" class="form-control" name="hargatema" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">URL Video</label>
                        <textarea class="form-control" name="urltema" rows="4"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Preview Undangan Video</label>
                        <input type="file" class="form-control" name="viewfile" required>
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

<form method="post" enctype="multipart/form-data" action="<?= base_url('admin/update_theme_video'); ?>">
    <div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="modalUpdateLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalUpdateLabel">Edit Tema Video</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Tema</label>
                        <input type="hidden" class="form-control idTema" name="idTema" required>
                        <input type="text" class="form-control namaTema" name="namaTema" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select class="form-select kategoriTema" id="kategoriTema" name="kategoriTema" required>
                            <option value="0">Pilih kategori</option>
                            <?php foreach ($categories as $row) { ?>
                                <option value="<?= esc($row->id) ?>"><?= esc($row->name) ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Harga</label>
                        <input type="number" class="form-control hargaTema" name="hargaTema" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">URL Video</label>
                        <textarea class="form-control urlTema" name="urlTema" rows="4"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Preview Undangan Video</label>
                        <input type="file" class="form-control" name="viewFile">
                        <div class="form-hint">Kosongkan jika preview tidak ingin diganti.</div>
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
    'modalId' => 'modalHapus',
    'title' => 'Hapus Tema Video',
    'message' => 'Tema video yang dihapus tidak bisa dikembalikan. Lanjutkan?',
    'hiddenName' => 'idTema',
    'hiddenId' => 'idTemaHapus',
    'confirmId' => 'pilihHapus',
    'confirmText' => 'Hapus',
    'confirmClass' => 'btn-danger',
]) ?>

<input type="hidden" id="namaTemaHapus" value="">

<div class="modal fade" id="sw-demo" tabindex="-1" role="dialog" aria-labelledby="modalDemoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDemoLabel">Preview Video <span class="nama_tema"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="ratio ratio-16x9 diulem-admin-video-preview">
                    <span class="demo-video" id="demo-video"></span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(function () {
    $('.hapus').on('click', function () {
        $('#idTemaHapus').val($(this).data('id'));
        $('#namaTemaHapus').val($(this).data('nama'));
    });

    $('#pilihHapus').on('click', function () {
        DiulemAdmin.post("<?= base_url('admin/delete_theme_video') ?>", {
            id: $('#idTemaHapus').val(),
            nama: $('#namaTemaHapus').val()
        }, {
            button: this,
            successMessage: 'Tema video berhasil dihapus.',
            errorMessage: 'Tema video gagal dihapus.'
        });
    });

    $('.btn-demo').on('click', function () {
        $('.demo-video').html($(this).data('link'));
        $('.nama_tema').text($(this).data('nama'));
        DiulemAdmin.showModal('sw-demo');
    });

    $('#sw-demo').on('hide.bs.modal', function () {
        $('.demo-video').html('');
        $('.nama_tema').text('');
    });

    $('.btn-update').on('click', function () {
        $('.idTema').val($(this).data('id'));
        $('.namaTema').val($(this).data('nama'));
        $('.kategoriTema').val($(this).data('kategori'));
        $('.urlTema').val($(this).data('link'));
        $('.hargaTema').val($(this).data('harga'));
        DiulemAdmin.showModal('modalUpdate');
    });
});
</script>
