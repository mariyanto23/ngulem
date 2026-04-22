<div class="page-body">
    <div class="container-xl">
        <div class="page-header d-print-none mb-3">
            <div class="row align-items-center">
                <div class="col">
                    <div class="page-pretitle">Setting</div>
                    <h1 class="page-title"><?= esc($title); ?></h1>
                </div>
            </div>
        </div>

        <div class="row row-cards">
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-header"><h3 class="card-title">Gateway Pembayaran</h3></div>
                    <div class="card-body">
                        <h4>Manual</h4>
                        <div class="row g-3">
                            <div class="col-md-4"><label class="form-label">Nama Bank</label><input id="bank_manual" type="text" class="form-control" value="<?= esc($setting[0]->bank_manual) ?>" required></div>
                            <div class="col-md-4"><label class="form-label">No Rekening</label><input id="norek_manual" type="number" class="form-control" value="<?= esc($setting[0]->norek_manual) ?>" required></div>
                            <div class="col-md-4"><label class="form-label">Nama Pemilik</label><input id="nama_manual" type="text" class="form-control" value="<?= esc($setting[0]->nama_manual) ?>" required></div>
                        </div>
                        <hr>
                        <h4>Midtrans</h4>
                        <div class="row g-3">
                            <div class="col-md-12"><label class="form-label">URL Midtrans</label><input id="url_midtrans" type="text" class="form-control" value="<?= esc($setting[0]->url_midtrans) ?>" required></div>
                            <div class="col-md-6"><label class="form-label">Server Key</label><input id="serverkey_midtrans" type="text" class="form-control" value="<?= esc($setting[0]->serverkey_midtrans) ?>" required></div>
                            <div class="col-md-6"><label class="form-label">Client Key</label><input id="clientkey_midtrans" type="text" class="form-control" value="<?= esc($setting[0]->clientkey_midtrans) ?>" required></div>
                            <div class="col-md-6"><label class="form-label">Mode Production</label><select class="form-control" id="midtrans_production"><option value="true" <?= $setting[0]->midtrans_production == 'true' ? 'selected' : '' ?>>Ya</option><option value="false" <?= $setting[0]->midtrans_production == 'false' ? 'selected' : '' ?>>Tidak</option></select></div>
                        </div>
                        <hr>
                        <h4>Tripay</h4>
                        <div class="row g-3">
                            <div class="col-md-6"><label class="form-label">Kode Merchant</label><input id="merchantcode_tripay" type="text" class="form-control" value="<?= esc($setting[0]->merchantcode_tripay) ?>" required></div>
                            <div class="col-md-6"><label class="form-label">API Key</label><input id="apikey_tripay" type="text" class="form-control" value="<?= esc($setting[0]->apikey_tripay) ?>" required></div>
                            <div class="col-md-6"><label class="form-label">Private Key</label><input id="privatekey_tripay" type="text" class="form-control" value="<?= esc($setting[0]->privatekey_tripay) ?>" required></div>
                            <div class="col-md-6"><label class="form-label">URL Transaksi</label><input id="url_tripay" type="text" class="form-control" value="<?= esc($setting[0]->url_tripay) ?>" required></div>
                        </div>
                        <div class="mt-4"><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalSetting1"><i class="ti ti-device-floppy me-2"></i>Simpan Gateway</button></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header"><h3 class="card-title">Metode Pembayaran Tagihan</h3></div>
                    <div class="card-body">
                        <label class="form-label">Pilihan Pembayaran</label>
                        <select class="form-control" id="metode_bayar">
                            <option value="manual" <?= $setting[0]->metode_bayar == 'manual' ? 'selected' : '' ?>>Manual</option>
                            <option value="midtrans" <?= $setting[0]->metode_bayar == 'midtrans' ? 'selected' : '' ?>>Midtrans</option>
                            <option value="tripay" <?= $setting[0]->metode_bayar == 'tripay' ? 'selected' : '' ?>>Tripay</option>
                        </select>
                        <div class="mt-4"><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalSetting2"><i class="ti ti-device-floppy me-2"></i>Simpan Metode</button></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= view('admin/components/confirm_modal', ['modalId' => 'modalSetting1', 'message' => 'Apakah kamu yakin ingin menyimpan gateway pembayaran?', 'confirmId' => 'simpanSetting1', 'confirmText' => 'Ya, Simpan']) ?>
<?= view('admin/components/confirm_modal', ['modalId' => 'modalSetting2', 'message' => 'Apakah kamu yakin ingin menyimpan metode pembayaran?', 'confirmId' => 'simpanSetting2', 'confirmText' => 'Ya, Simpan']) ?>

<script>
$('#simpanSetting1').on('click', function() {
    DiulemAdmin.post("<?= base_url('admin/update_setting_pembayaran_1') ?>", {
        bank_manual: $('#bank_manual').val(),
        norek_manual: $('#norek_manual').val(),
        nama_manual: $('#nama_manual').val(),
        url_midtrans: $('#url_midtrans').val(),
        serverkey_midtrans: $('#serverkey_midtrans').val(),
        clientkey_midtrans: $('#clientkey_midtrans').val(),
        midtrans_production: $('#midtrans_production').val(),
        url_tripay: $('#url_tripay').val(),
        merchantcode_tripay: $('#merchantcode_tripay').val(),
        privatekey_tripay: $('#privatekey_tripay').val(),
        apikey_tripay: $('#apikey_tripay').val()
    }, { button: $(this), successMessage: 'Gateway pembayaran berhasil disimpan.', errorMessage: 'Gateway pembayaran gagal disimpan.' });
});

$('#simpanSetting2').on('click', function() {
    DiulemAdmin.post("<?= base_url('admin/update_setting_pembayaran_2') ?>", {
        metode_bayar: $('#metode_bayar').val()
    }, { button: $(this), successMessage: 'Metode pembayaran berhasil disimpan.', errorMessage: 'Metode pembayaran gagal disimpan.' });
});
</script>
