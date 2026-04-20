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
                                <div class="text-secondary">Pengunjung Hari Ini</div>
                                <div class="h1 mb-0"><?php if ($total_pengunjung_today == '') echo '0'; else echo esc($total_pengunjung_today); ?></div>
                            </div>
                            <div class="col-auto">
                                <span class="diulem-stat-icon"><i class="ti ti-users"></i></span>
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
                                <div class="text-secondary">Total Pengunjung</div>
                                <div class="h1 mb-0"><?= esc($total_pengunjung) ?></div>
                            </div>
                            <div class="col-auto">
                                <span class="diulem-stat-icon"><i class="ti ti-chart-line"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Pengunjung 7 Hari Terakhir</h3>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Pengunjung</h3>
                <div class="card-actions">
                    <button type="submit" form="formHapusRiwayat" class="btn btn-danger btn-sm">
                        <i class="ti ti-trash me-2"></i>Hapus Banyak
                    </button>
                </div>
            </div>
            <?= form_open('user/hapusbanyakriwayat', ['class' => 'formhapusbanyak', 'id' => 'formHapusRiwayat']) ?>
            <div class="table-responsive">
                <table class="table table-vcenter card-table table-striped" id="dataTable">
                    <thead>
                        <tr>
                            <th class="w-1"><input type="checkbox" id="centangSemua"></th>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th class="w-1">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pengunjung as $row) { ?>
                            <tr>
                                <td><input type="checkbox" class="centangPengunjung" name="idRiwayat[]" value="<?= esc($row->id) ?>"></td>
                                <td><?= esc(date('d M Y', strtotime($row->created_at))) ?></td>
                                <td><?= esc($row->nama_pengunjung) ?></td>
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
            <?= form_close(); ?>
        </div>
    </div>
</div>

<?= view('base/dashboard/components/confirm_modal', [
    'modalId' => 'modalHapus',
    'message' => 'Apakah kamu yakin ingin menghapus riwayat pengunjung ini?',
    'hiddenName' => 'idPengunjung',
    'hiddenId' => 'idPengunjung',
]) ?>

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

<script>
$(document).ready(function () {
    $('.hapus').on('click', function () {
        $('#centangSemua').prop('checked', false);
        $('.centangPengunjung').prop('checked', false);
        $('#modalHapus #idPengunjung').val($(this).data('id'));
    });

    $('#hapusBtn').on('click', function() {
        var id_pengunjung = $('#idPengunjung').val();

        $.ajax({
            url : "<?= base_url('user/hapus_riwayat') ?>",
            method : "POST",
            data : {id : id_pengunjung},
            async : true,
            dataType : 'html',
            success: function($hasil){
               if($hasil == 'sukses'){
                location.reload();
               }
            }
        });
    });

    $('#centangSemua').click(function() {
        $('.centangPengunjung').prop('checked', $(this).is(':checked'));
    });

    $('.formhapusbanyak').on('submit', function(e) {
        e.preventDefault();
        let jmldata = $('.centangPengunjung:checked');

        if (jmldata.length === 0) {
            return false;
        }

        Swal.fire({
            title: 'Hapus Banyak Data',
            text: `Yakin data Pengunjung dihapus sebanyak ${jmldata.length} data ?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus Data Pengunjung!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'post',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses
                            });
                            location.reload();
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            }
        });

        return false;
    });
});
</script>
