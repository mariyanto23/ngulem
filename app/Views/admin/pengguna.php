<div class="page-body">
    <div class="container-xl">
        <div class="page-header d-print-none mb-3">
            <div class="row align-items-center">
                <div class="col">
                    <div class="page-pretitle">Admin</div>
                    <h1 class="page-title"><?= esc($title); ?></h1>
                </div>
            </div>
        </div>

        <?php foreach ($setting as $set) {
            $trial = $set->trial;
        } ?>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Pengguna</h3>
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
                        $today = strtotime('now');
                        $tglNonaktif = strtotime('+'.$masa_aktif.' days', strtotime($row->tgl_bayar));
                        $tglSelesai = $row->statusPembayaran == 2
                            ? date('d-m-Y H:i', $tglNonaktif) . ' WIB'
                            : date('d-m-Y H:i', $tglExp) . ' WIB';
                    ?>
                        <tr>
                            <td><?= esc($row->email) ?></td>
                            <td><a target="_blank" href="<?= rtrim(SITE_UNDANGAN, '/') . '/' . esc($row->domain) ?>"><?= esc($row->domain) ?></a></td>
                            <td><?= esc($tglSelesai) ?></td>
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
                                    <button type="button" data-id="<?= esc($row->id_user) ?>" data-kunci="<?= esc($row->kunci) ?>" class="btn btn-sm btn-danger btn-icon hapus" data-toggle="modal" data-target="#modalHapus" title="Hapus pengguna" aria-label="Hapus pengguna">
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
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah kamu yakin ingin menghapus pengguna ini?<br>
                <strong>Semua data pengguna termasuk website akan terhapus.</strong>
                <input type="hidden" id="iduser" value="">
                <input type="hidden" id="kunci" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger" id="hapusBtn">Hapus</button>
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
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
