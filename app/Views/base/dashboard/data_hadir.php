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
            </div>
            <div class="table-responsive">
                <table class="table table-vcenter card-table table-striped" id="hadirTamu">
                    <thead>
                        <tr>
                            <th>Nama Tamu</th>
                            <th>Alamat Tamu</th>
                            <th>Domain Undangan</th>
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
                                <td>
                                    <a href="<?= rtrim(SITE_UNDANGAN, '/') ?>/<?= esc($row->domain) ?>/<?= esc($row->id_tamu) ?>" target="_blank">
                                        <?= esc(DOMAIN_UNDANGAN) ?>/<?= esc($row->domain) ?>/<?= esc($row->id_tamu) ?>
                                    </a>
                                </td>
                                <td><?= esc($row->waktu_hadir) ?></td>
                                <td>
                                    <span class="avatar avatar-xl" style="background-image: url(<?= base_url() ?>/assets/users/<?= esc($kunci) ?>/<?= esc($qrcode) ?>.png)"></span>
                                </td>
                                <td>
                                    <button data-id="<?= esc($row->id_tamu) ?>" class="btn btn-sm btn-danger hapus" data-toggle="modal" data-target="#modalHapus">
                                        Hapus
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

<script>
$(document).ready(function () {
    $('.hapus').on('click', function () {
        var idtamu = $(this).data('id');
        $('#modalHapus #idTamu').val(idtamu);
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
