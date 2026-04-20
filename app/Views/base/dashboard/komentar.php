<div class="page-body">
    <div class="container-xl">
        <div class="page-header d-print-none mb-3">
            <div class="row align-items-center">
                <div class="col">
                    <div class="page-pretitle">Pengunjung</div>
                    <h1 class="page-title"><?= esc($title); ?></h1>
                </div>
            </div>
        </div>

        <div class="row row-cards mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="text-secondary">Ucapan Hari Ini</div>
                                <div class="h1 mb-0"><?= esc($total_komentar_today) ?></div>
                            </div>
                            <div class="col-auto">
                                <span class="diulem-stat-icon"><i class="ti ti-message-heart"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
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

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Ucapan</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-vcenter card-table table-striped" id="dataTable">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Ucapan</th>
                            <th class="w-1">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($komentar as $row) { ?>
                            <tr>
                                <td><?= esc($row->nama_komentar) ?></td>
                                <td class="text-wrap"><?= esc($row->isi_komentar) ?></td>
                                <td>
                                    <button data-id="<?= esc($row->id) ?>" class="btn btn-sm btn-danger hapus" data-toggle="modal" data-target="#modalHapus">
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
    'message' => 'Apakah kamu yakin ingin menghapus komentar ini?',
    'hiddenName' => 'idKomentar',
    'hiddenId' => 'idKomentar',
]) ?>

<script>
$('.hapus').on('click', function () {
    $('#modalHapus #idKomentar').val($(this).data('id'));
});

$('#hapusBtn').on('click', function() {
    var idkomentar = $('#idKomentar').val();

    $.ajax({
        url : "<?= base_url('user/hapus_komentar') ?>",
        method : "POST",
        data : {id: idkomentar},
        async : true,
        dataType : 'html',
        success: function($hasil){
           if($hasil == 'sukses'){
            location.reload();
           }
        }
    });
});
</script>
