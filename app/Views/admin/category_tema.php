<div class="page-body">
    <div class="container-xl">
        <div class="page-header d-print-none mb-3">
            <div class="row align-items-center">
                <div class="col">
                    <div class="page-pretitle">Undangan Website</div>
                    <h1 class="page-title"><?= esc($title); ?></h1>
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                        <i class="ti ti-plus me-2"></i>Tambah Kategori
                    </button>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h3 class="card-title">Data Kategori Undangan Online</h3></div>
            <div class="table-responsive">
                <table class="table table-vcenter card-table" id="dataTable">
                    <thead><tr><th>Nama Kategori</th><th>Slug</th><th class="text-end">Aksi</th></tr></thead>
                    <tbody>
                    <?php foreach ($categories as $row) { ?>
                        <tr>
                            <td><?= esc($row->name) ?></td>
                            <td><?= esc($row->slug) ?></td>
                            <td class="text-end">
                                <div class="btn-list justify-content-end flex-nowrap">
                                    <button class="btn btn-warning btn-sm btn-icon btn-update" data-id="<?= esc($row->id) ?>" data-nama="<?= esc($row->name) ?>" data-slug="<?= esc($row->slug) ?>" title="Edit" aria-label="Edit"><i class="ti ti-pencil"></i></button>
                                    <button class="btn btn-danger btn-sm btn-icon hapus" data-id="<?= esc($row->id) ?>" data-bs-toggle="modal" data-bs-target="#modalHapus" title="Hapus" aria-label="Hapus"><i class="ti ti-trash"></i></button>
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

<form method="post" enctype="multipart/form-data" action="<?= base_url('admin/add_categoryTema'); ?>">
    <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog" role="document"><div class="modal-content">
            <div class="modal-header"><h5 class="modal-title" id="modalTambahLabel">Tambah Kategori</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
            <div class="modal-body">
                <div class="mb-3"><label class="form-label">Nama Kategori</label><input type="text" class="form-control" name="nama" required></div>
                <div class="mb-3"><label class="form-label">Slug Kategori</label><input type="text" class="form-control" name="slug" required></div>
            </div>
            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button><button type="submit" class="btn btn-primary">Simpan</button></div>
        </div></div>
    </div>
</form>

<form method="post" enctype="multipart/form-data" action="<?= base_url('admin/update_categoryTema'); ?>">
    <div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="modalUpdateLabel" aria-hidden="true">
        <div class="modal-dialog" role="document"><div class="modal-content">
            <div class="modal-header"><h5 class="modal-title" id="modalUpdateLabel">Update Kategori</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
            <div class="modal-body">
                <input type="hidden" class="idKategori" name="idKategori">
                <div class="mb-3"><label class="form-label">Nama Kategori</label><input type="text" class="form-control namaKategori" name="namaKategori" required></div>
                <div class="mb-3"><label class="form-label">Slug</label><input type="text" class="form-control slugKategori" name="slugKategori" required></div>
            </div>
            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button><button type="submit" class="btn btn-primary">Simpan</button></div>
        </div></div>
    </div>
</form>

<?= view('admin/components/confirm_modal', [
    'modalId' => 'modalHapus',
    'message' => 'Apakah kamu yakin ingin menghapus kategori?',
    'hiddenName' => 'idkategori',
    'hiddenId' => 'idkategori',
    'confirmId' => 'pilihHapus',
    'confirmText' => 'Hapus',
    'confirmClass' => 'btn-danger',
]) ?>

<script>
$('.hapus').on('click', function () {
    $('#modalHapus #idkategori').val($(this).data('id'));
});

$('#pilihHapus').on('click', function() {
    DiulemAdmin.post("<?= base_url('admin/delete_categoryTema') ?>", {
        id: $('#idkategori').val()
    }, { button: $(this), successMessage: 'Kategori berhasil dihapus.', errorMessage: 'Kategori gagal dihapus.' });
});

$('.btn-update').on('click', function() {
    $('.idKategori').val($(this).data('id'));
    $('.namaKategori').val($(this).data('nama'));
    $('.slugKategori').val($(this).data('slug'));
    DiulemAdmin.showModal('modalUpdate');
});
</script>
