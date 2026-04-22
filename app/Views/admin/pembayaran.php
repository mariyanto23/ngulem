<div class="page-body">
    <div class="container-xl">
        <div class="page-header d-print-none mb-3">
            <div class="row align-items-center">
                <div class="col">
                    <div class="page-pretitle">Transaksi</div>
                    <h1 class="page-title"><?= esc($title); ?></h1>
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
        ?>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Pembayaran</h3>
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
                            <td>#<?= esc($row->invoice) ?></td>
                            <td><?= esc($row->username) ?></td>
                            <td><a target="_blank" href="<?= rtrim(SITE_UNDANGAN, '/') . '/' . esc($row->domain) ?>"><?= esc($row->domain) ?></a></td>
                            <td><?= rupiah($row->harga) ?></td>
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
                                    <?php if ($metode_bayar == 'manual') { ?>
                                        <button type="button" class="btn btn-info btn-sm btn-icon lihatBukti" title="Lihat bukti" aria-label="Lihat bukti"
                                            data-nama="<?= esc($row->nama_lengkap) ?>"
                                            data-bank="<?= esc($row->nama_bank) ?>"
                                            data-invoice="<?= esc($row->invoice) ?>"
                                            data-toggle="modal"
                                            data-target="#modalData">
                                            <i class="ti ti-eye"></i>
                                        </button>
                                    <?php } ?>
                                    <button type="button" class="btn btn-success btn-sm btn-icon konfirmasiBtn" title="Konfirmasi" aria-label="Konfirmasi" data-id="<?= esc($row->id_user) ?>" data-toggle="modal" data-target="#modalKonfirmasi">
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

<?= view('admin/components/confirm_modal', [
    'modalId' => 'modalKonfirmasi',
    'message' => 'Apakah kamu yakin ingin mengkonfirmasi pengguna?',
    'hiddenName' => 'iduser',
    'hiddenId' => 'iduser',
    'confirmId' => 'konfirmasi',
    'confirmText' => 'Ya, Konfirmasi',
    'confirmClass' => 'btn-success',
]) ?>

<div class="modal fade" id="modalData" tabindex="-1" role="dialog" aria-labelledby="modalDataLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDataLabel">Bukti Transfer</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input id="nama_lengkap" type="text" class="form-control" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Bank</label>
                    <input id="nama_bank" type="text" class="form-control" readonly>
                </div>
                <div>
                    <label class="form-label">Bukti Transfer</label>
                    <img id="bukti" src="" class="diulem-admin-proof" alt="Bukti transfer">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
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

$('.konfirmasiBtn').on('click', function () {
    $('#modalKonfirmasi #iduser').val($(this).data('id'));
});

$('#konfirmasi').on('click', function() {
    DiulemAdmin.post("<?= base_url('admin/konfirmasi') ?>", {
        id: $('#iduser').val()
    }, {
        button: $(this),
        successMessage: 'Pengguna berhasil dikonfirmasi.',
        errorMessage: 'Pengguna gagal dikonfirmasi.'
    });
});
</script>
