<div class="page-body">
    <div class="container-xl">
        <div class="page-header d-print-none mb-3">
            <div class="row align-items-center">
                <div class="col">
                    <div class="page-pretitle">Buku Tamu</div>
                    <h1 class="page-title"><?= esc($title); ?></h1>
                </div>
                <div class="col-auto">
                    <a href="<?= rtrim(SITE_BUKUTAMU, '/') ?>/<?= esc($order[0]->domain) ?>" target="_blank" class="btn btn-primary">
                        <i class="ti ti-external-link me-2"></i>Lihat Website
                    </a>
                </div>
            </div>
        </div>

        <?php $kunci = $data[0]->kunci; ?>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Tamu Hadir</h3>
                <div class="card-actions" id="hadirTamuExport"></div>
            </div>
            <div class="table-responsive">
                <table class="table table-vcenter card-table table-striped" id="hadirTamu">
                    <thead>
                        <tr>
                            <th>Nama Tamu</th>
                            <th>Alamat Tamu</th>
                            <th>Waktu Kehadiran</th>
                            <th>Foto Selfi</th>
                            <th class="w-1">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($hadir as $row) {
                            $qrcode = $row->qrcode;
                        ?>
                            <tr>
                                <td><?= esc($row->nama_tamu) ?></td>
                                <td><?= esc($row->alamat_tamu) ?></td>
                                <td><?= esc($row->waktu_hadir) ?></td>
                                <td>
                                    <?php $selfieUrl = base_url() . '/assets/users/' . $kunci . '/' . $qrcode . '.png'; ?>
                                    <button type="button" class="btn p-0 border-0 bg-transparent hadir-selfie" data-image="<?= esc($selfieUrl) ?>" data-name="<?= esc($row->nama_tamu) ?>" data-toggle="modal" data-target="#modalSelfie" title="Lihat foto selfie">
                                        <img src="<?= esc($selfieUrl) ?>" alt="Foto selfie <?= esc($row->nama_tamu) ?>" class="hadir-selfie-thumb">
                                    </button>
                                </td>
                                <td>
                                    <button data-id="<?= esc($row->id_tamu) ?>" class="btn btn-sm btn-danger btn-icon hapus" data-toggle="modal" data-target="#modalHapus" title="Hapus data hadir" aria-label="Hapus data hadir">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= view('base/dashboard/components/confirm_modal', [
    'modalId' => 'modalHapus',
    'message' => 'Apakah kamu yakin ingin menghapus tamu dari daftar hadir?',
    'hiddenName' => 'idTamu',
    'hiddenId' => 'idTamu',
    'confirmId' => 'pilihHapus',
    'confirmText' => 'Ya, Hapus',
]) ?>

<div class="modal fade" id="modalSelfie" tabindex="-1" role="dialog" aria-labelledby="modalSelfieLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSelfieLabel">Foto Selfie</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="" alt="Foto selfie tamu" class="img-fluid rounded diulem-selfie-preview" id="selfiePreview">
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    $('.hapus').on('click', function () {
        var idtamu = $(this).data('id');
        $('#modalHapus #idTamu').val(idtamu);
    });

    $('.hadir-selfie').on('click', function () {
        $('#modalSelfieLabel').text('Foto Selfie - ' + $(this).data('name'));
        $('#selfiePreview').attr('src', $(this).data('image'));
    });

    $('#pilihHapus').on('click', function(event) {
        var idtamu = $('#idTamu').val();

        $.ajax({
            url : "<?= base_url('user/hapus_hadir') ?>",
            method : "POST",
            data : {id: idtamu},
            async : true,
            dataType : 'html',
            success: function($hasil){
               if($hasil == 'sukses'){
                location.reload();
               }
            }
        });
    });
});
</script>
