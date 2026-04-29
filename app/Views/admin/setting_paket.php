<div class="page-body">
    <div class="container-xl">
        <div class="page-header d-print-none mb-3">
            <div class="row align-items-center">
                <div class="col">
                    <div class="page-pretitle">Setting</div>
                    <h1 class="page-title"><?= esc($title); ?></h1>
                    <div class="diulem-admin-page-note">Susun paket gratis dan berbayar, atur masa aktif, lalu tentukan fitur apa saja yang diterima setiap pelanggan.</div>
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modalTambahPaket">
                        <i class="ti ti-plus me-2"></i>Tambah Paket
                    </button>
                </div>
            </div>
        </div>

        <?php
        $totalPaket = count($setting);
        $freePaket = 0;
        foreach ($setting as $summaryPaket) {
            if ((int) $summaryPaket->harga_paket <= 0) {
                $freePaket++;
            }
        }
        ?>

        <div class="row row-cards mb-3">
            <div class="col-sm-6 col-lg-3">
                <div class="card diulem-admin-summary-card">
                    <div class="card-body">
                        <div>
                            <div class="diulem-admin-summary-label">Total Paket</div>
                            <div class="diulem-admin-summary-value"><?= $totalPaket ?></div>
                            <div class="diulem-admin-summary-help">Semua paket aktif yang tersedia saat ini.</div>
                        </div>
                        <span class="diulem-admin-stat-icon"><i class="ti ti-package"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card diulem-admin-summary-card">
                    <div class="card-body">
                        <div>
                            <div class="diulem-admin-summary-label">Paket Gratis</div>
                            <div class="diulem-admin-summary-value"><?= $freePaket ?></div>
                            <div class="diulem-admin-summary-help">Cocok untuk entry package atau trial panjang.</div>
                        </div>
                        <span class="diulem-admin-stat-icon"><i class="ti ti-gift"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-6">
                <div class="card diulem-admin-summary-card">
                    <div class="card-body">
                        <div>
                            <div class="diulem-admin-summary-label">Catatan Paket</div>
                            <div class="diulem-admin-summary-help">Gunakan harga `0` untuk paket gratis. Fitur paket di bawah membantu membedakan value tiap level tanpa harus membuat flow order terpisah.</div>
                        </div>
                        <span class="diulem-admin-stat-icon"><i class="ti ti-bulb"></i></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-cards">
            <?php foreach ($setting as $index => $paket) { ?>
            <div class="col-xl-4 col-lg-6">
                <form method="post" enctype="multipart/form-data" action="<?= base_url('admin/update_paket'); ?>">
                    <div class="card h-100">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between w-100">
                                <h3 class="card-title mb-0">Paket <?= $index + 1 ?></h3>
                                <?php if ((int) $paket->harga_paket <= 0) { ?>
                                    <span class="badge bg-azure text-azure-fg">Gratis</span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="id_paket" value="<?= esc($paket->id_paket) ?>">
                            <div class="mb-3">
                                <label class="form-label">Nama Paket Undangan</label>
                                <input name="nama_paket" type="text" class="form-control" placeholder="Masukkan nama paket" value="<?= esc($paket->nama_paket) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Harga Paket Undangan</label>
                                <input name="harga_paket" type="text" class="form-control" placeholder="Masukkan harga paket" value="<?= esc($paket->harga_paket) ?>" required>
                                <?php if ((int) $paket->harga_paket <= 0) { ?>
                                    <small class="form-hint">Paket ini akan aktif tanpa pembayaran.</small>
                                <?php } ?>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Masa Aktif Undangan (hari)</label>
                                <input name="masa_aktif" type="text" class="form-control" placeholder="Masa aktif undangan" value="<?= esc($paket->masa_aktif) ?>" required>
                            </div>
                            <div class="diulem-admin-info-grid">
                                <div class="diulem-admin-info-item">
                                    <span class="diulem-admin-info-label">Harga</span>
                                    <div class="diulem-admin-info-value"><?= (int) $paket->harga_paket <= 0 ? 'Gratis' : rupiah($paket->harga_paket) ?></div>
                                </div>
                                <div class="diulem-admin-info-item">
                                    <span class="diulem-admin-info-label">Masa Aktif</span>
                                    <div class="diulem-admin-info-value"><?= esc($paket->masa_aktif) ?> hari</div>
                                </div>
                            </div>
                            <?php
                            $switches = [
                                ['name' => 'setTamu', 'label' => 'Halaman Bukutamu', 'value' => $paket->buku_tamu],
                                ['name' => 'setKirim', 'label' => 'Kirim Whatsapp', 'value' => $paket->kirim_whatsapp],
                                ['name' => 'setTema', 'label' => 'Bebas Pilih Tema', 'value' => $paket->tema_bebas],
                                ['name' => 'setHadiah', 'label' => 'Kirim Hadiah', 'value' => $paket->kirim_hadiah],
                                ['name' => 'setImport', 'label' => 'Import Data Tamu (Excel)', 'value' => $paket->import_datatamu],
                            ];
                            foreach ($switches as $switch) {
                                $switchId = $switch['name'] . $index;
                            ?>
                            <label class="form-check form-switch mb-2">
                                <input type="checkbox" class="form-check-input" id="<?= esc($switchId) ?>" name="<?= esc($switch['name']) ?>" <?= $switch['value'] == '1' ? 'checked' : '' ?>>
                                <span class="form-check-label"><?= esc($switch['label']) ?></span>
                            </label>
                            <?php } ?>
                            <div class="diulem-admin-feature-list">
                                <?php foreach ($switches as $switch) { ?>
                                    <span class="diulem-admin-feature-pill <?= $switch['value'] == '1' ? 'is-on' : 'is-off' ?>">
                                        <i class="ti <?= $switch['value'] == '1' ? 'ti-check' : 'ti-minus' ?>"></i>
                                        <?= esc($switch['label']) ?>
                                    </span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <div class="d-flex gap-2">
                                <button class="btn btn-primary flex-fill" type="submit">
                                    <i class="ti ti-device-floppy me-2"></i>Simpan Paket
                                </button>
                                <button
                                    class="btn btn-danger btn-icon hapus-paket"
                                    type="button"
                                    data-id="<?= esc($paket->id_paket) ?>"
                                    data-nama="<?= esc($paket->nama_paket) ?>"
                                    title="Hapus paket"
                                    aria-label="Hapus paket">
                                    <i class="ti ti-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<form method="post" enctype="multipart/form-data" action="<?= base_url('admin/add_paket'); ?>">
        <div class="modal fade" id="modalTambahPaket" tabindex="-1" aria-labelledby="modalTambahPaketLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahPaketLabel">Tambah Paket Undangan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="diulem-admin-soft-panel mb-3">
                        <div class="diulem-admin-soft-panel-title">Panduan Singkat</div>
                        <div class="diulem-admin-soft-panel-note">Isi harga `0` untuk paket gratis. Aktifkan fitur sesuai value paket agar perbedaan antar level lebih jelas.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Paket Undangan</label>
                        <input name="nama_paket" type="text" class="form-control" placeholder="Masukkan nama paket" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Harga Paket Undangan</label>
                        <input name="harga_paket" type="text" class="form-control" placeholder="Masukkan harga paket" required>
                        <small class="form-hint">Isi `0` untuk membuat paket gratis.</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Masa Aktif Undangan (hari)</label>
                        <input name="masa_aktif" type="number" min="1" class="form-control" placeholder="Masa aktif undangan" required>
                    </div>
                    <label class="form-check form-switch mb-2">
                        <input type="checkbox" class="form-check-input" name="setTamu">
                        <span class="form-check-label">Halaman Bukutamu</span>
                    </label>
                    <label class="form-check form-switch mb-2">
                        <input type="checkbox" class="form-check-input" name="setKirim">
                        <span class="form-check-label">Kirim Whatsapp</span>
                    </label>
                    <label class="form-check form-switch mb-2">
                        <input type="checkbox" class="form-check-input" name="setTema">
                        <span class="form-check-label">Bebas Pilih Tema</span>
                    </label>
                    <label class="form-check form-switch mb-2">
                        <input type="checkbox" class="form-check-input" name="setHadiah">
                        <span class="form-check-label">Kirim Hadiah</span>
                    </label>
                    <label class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" name="setImport">
                        <span class="form-check-label">Import Data Tamu (Excel)</span>
                    </label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-device-floppy me-2"></i>Simpan Paket
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
$('.hapus-paket').on('click', function() {
    var $button = $(this);
    var namaPaket = $button.data('nama');

    DiulemAdmin.confirm({
        title: 'Hapus Paket',
        text: 'Paket "' + namaPaket + '" akan dihapus. Lanjutkan?',
        confirmButtonText: 'Ya, Hapus',
        icon: 'warning'
    }).then(function(result) {
        if (!result.value) {
            return;
        }

        DiulemAdmin.setButtonLoading($button, true, '<i class="ti ti-loader"></i>');

        $.ajax({
            url: "<?= base_url('admin/delete_paket') ?>",
            method: 'POST',
            data: {
                id: $button.data('id')
            }
        }).done(function(response) {
            response = $.trim(response);

            if (response === 'sukses') {
                DiulemAdmin.notify('success', 'Berhasil', 'Paket undangan berhasil dihapus.').then(function() {
                    DiulemAdmin.suppressNextFlash('success', 'Paket undangan berhasil dihapus');
                    DiulemAdmin.reload();
                });
                return;
            }

            if (response === 'dipakai') {
                DiulemAdmin.notify('warning', 'Tidak Bisa Dihapus', 'Paket sedang dipakai pengguna dan tidak bisa dihapus.');
                return;
            }

            if (response === 'terakhir') {
                DiulemAdmin.notify('warning', 'Tidak Bisa Dihapus', 'Paket terakhir tidak bisa dihapus.');
                return;
            }

            DiulemAdmin.notify('error', 'Gagal', 'Paket undangan gagal dihapus.');
        }).fail(function() {
            DiulemAdmin.notify('error', 'Gagal', 'Paket undangan gagal dihapus.');
        }).always(function() {
            DiulemAdmin.setButtonLoading($button, false);
        });
    });
});
</script>
