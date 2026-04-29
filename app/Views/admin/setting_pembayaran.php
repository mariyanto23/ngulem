<div class="page-body">
    <div class="container-xl">
        <?php
        $qrisManualImage = '';
        foreach (['png', 'jpg', 'jpeg', 'webp'] as $extension) {
            $qrisPath = FCPATH . 'assets/base/img/qris-manual.' . $extension;
            if (is_file($qrisPath)) {
                $qrisManualImage = base_url('assets/base/img/qris-manual.' . $extension) . '?v=' . filemtime($qrisPath);
                break;
            }
        }
        ?>
        <div class="page-header d-print-none mb-3">
            <div class="row align-items-center">
                <div class="col">
                    <div class="page-pretitle">Setting</div>
                    <h1 class="page-title"><?= esc($title); ?></h1>
                    <div class="diulem-admin-page-note">Kelola detail rekening, QRIS, gateway online, dan metode pembayaran yang akan dipakai pengguna saat checkout.</div>
                </div>
            </div>
        </div>

        <div class="row row-cards">
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h3 class="card-title">Gateway Pembayaran</h3>
                            <div class="diulem-admin-card-note">Simpan semua channel pembayaran di satu tempat. Bagian manual dan online dipisah supaya lebih mudah dirawat.</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="diulem-admin-section-heading">Manual Transfer</div>
                        <div class="diulem-admin-section-subtitle">Dipakai untuk transfer bank biasa. Pastikan nama bank, rekening, dan nama pemilik sesuai dengan tujuan pembayaran aktif.</div>
                        <div class="row g-3">
                            <div class="col-md-4"><label class="form-label">Nama Bank</label><input id="bank_manual" type="text" class="form-control" value="<?= esc($setting[0]->bank_manual) ?>" required></div>
                            <div class="col-md-4"><label class="form-label">No Rekening</label><input id="norek_manual" type="number" class="form-control" value="<?= esc($setting[0]->norek_manual) ?>" required></div>
                            <div class="col-md-4"><label class="form-label">Nama Pemilik</label><input id="nama_manual" type="text" class="form-control" value="<?= esc($setting[0]->nama_manual) ?>" required></div>
                        </div>
                        <div class="diulem-admin-section-divider">
                            <div class="diulem-admin-section-heading">Manual QRIS</div>
                            <div class="diulem-admin-section-subtitle">Upload QRIS terpisah dari rekening bank. Ini berguna kalau nama merchant berbeda dengan nama pemilik rekening transfer manual.</div>
                        </div>
                        <div class="row g-3 align-items-start">
                            <div class="col-md-6">
                                <label class="form-label">Nama Merchant QRIS</label>
                                <input id="merchant_qris_manual" type="text" class="form-control" value="<?= esc($setting[0]->merchant_qris_manual ?? $setting[0]->nama_manual) ?>" placeholder="Contoh: DIULEM DIGITAL INDONESIA">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Upload QRIS</label>
                                <input id="qris_manual_file" type="file" class="form-control" accept=".png,.jpg,.jpeg,.webp,image/png,image/jpeg,image/webp">
                                <small class="form-hint">Format PNG/JPG/JPEG/WEBP, maksimal 2MB.</small>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Preview QRIS</label>
                                <div class="diulem-admin-preview-frame">
                                    <?php if ($qrisManualImage !== '') { ?>
                                        <img id="qris_manual_preview" src="<?= esc($qrisManualImage) ?>" alt="QRIS Manual" class="img-fluid">
                                        <div id="qris_manual_empty" class="text-secondary d-none">Belum ada QRIS manual yang diupload.</div>
                                    <?php } else { ?>
                                        <img id="qris_manual_preview" src="" alt="QRIS Manual" class="img-fluid d-none">
                                        <div id="qris_manual_empty" class="text-secondary">Belum ada QRIS manual yang diupload.</div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="diulem-admin-section-divider">
                            <div class="diulem-admin-section-heading">Midtrans</div>
                            <div class="diulem-admin-section-subtitle">Gunakan jika ingin channel pembayaran online otomatis. Lengkapi key sandbox atau production sesuai mode yang dipilih.</div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-12"><label class="form-label">URL Midtrans</label><input id="url_midtrans" type="text" class="form-control" value="<?= esc($setting[0]->url_midtrans) ?>" required></div>
                            <div class="col-md-6"><label class="form-label">Server Key</label><input id="serverkey_midtrans" type="text" class="form-control" value="<?= esc($setting[0]->serverkey_midtrans) ?>" required></div>
                            <div class="col-md-6"><label class="form-label">Client Key</label><input id="clientkey_midtrans" type="text" class="form-control" value="<?= esc($setting[0]->clientkey_midtrans) ?>" required></div>
                            <div class="col-md-6"><label class="form-label">Mode Production</label><select class="form-control" id="midtrans_production"><option value="true" <?= $setting[0]->midtrans_production == 'true' ? 'selected' : '' ?>>Ya</option><option value="false" <?= $setting[0]->midtrans_production == 'false' ? 'selected' : '' ?>>Tidak</option></select></div>
                        </div>
                        <div class="diulem-admin-section-divider">
                            <div class="diulem-admin-section-heading">Tripay</div>
                            <div class="diulem-admin-section-subtitle">Alternatif gateway online selain Midtrans. Pastikan kode merchant dan private key diisi dari dashboard Tripay yang aktif.</div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6"><label class="form-label">Kode Merchant</label><input id="merchantcode_tripay" type="text" class="form-control" value="<?= esc($setting[0]->merchantcode_tripay) ?>" required></div>
                            <div class="col-md-6"><label class="form-label">API Key</label><input id="apikey_tripay" type="text" class="form-control" value="<?= esc($setting[0]->apikey_tripay) ?>" required></div>
                            <div class="col-md-6"><label class="form-label">Private Key</label><input id="privatekey_tripay" type="text" class="form-control" value="<?= esc($setting[0]->privatekey_tripay) ?>" required></div>
                            <div class="col-md-6"><label class="form-label">URL Transaksi</label><input id="url_tripay" type="text" class="form-control" value="<?= esc($setting[0]->url_tripay) ?>" required></div>
                        </div>
                        <div class="mt-4"><button class="btn btn-primary" id="simpanSetting1"><i class="ti ti-device-floppy me-2"></i>Simpan Gateway</button></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h3 class="card-title">Metode Pembayaran Tagihan</h3>
                            <div class="diulem-admin-card-note">Pilih channel utama yang tampil ke pengguna. Bagian ini menentukan pengalaman checkout, bukan hanya penyimpanan kredensial.</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="diulem-admin-soft-panel">
                            <div class="diulem-admin-soft-panel-title">Pilihan Aktif Saat Ini</div>
                            <div class="diulem-admin-soft-panel-note">Gunakan satu metode utama agar alur pembayaran tetap fokus dan tidak membingungkan pengguna saat checkout.</div>
                            <label class="form-label">Pilihan Pembayaran</label>
                            <select class="form-control" id="metode_bayar">
                                <option value="manual" <?= $setting[0]->metode_bayar == 'manual' ? 'selected' : '' ?>>Manual Transfer</option>
                                <option value="manual_qris" <?= $setting[0]->metode_bayar == 'manual_qris' ? 'selected' : '' ?>>Manual QRIS</option>
                                <option value="midtrans" <?= $setting[0]->metode_bayar == 'midtrans' ? 'selected' : '' ?>>Midtrans</option>
                                <option value="tripay" <?= $setting[0]->metode_bayar == 'tripay' ? 'selected' : '' ?>>Tripay</option>
                            </select>
                            <small class="form-hint">Manual QRIS hanya bisa diaktifkan jika gambar QRIS sudah diupload pada bagian Gateway Pembayaran.</small>
                        </div>
                        <div class="mt-4"><button class="btn btn-primary" id="simpanSetting2"><i class="ti ti-device-floppy me-2"></i>Simpan Metode</button></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$('#simpanSetting1').on('click', function() {
    var formData = new FormData();
    var qrisManualFile = $('#qris_manual_file')[0].files[0];

    formData.append('bank_manual', $('#bank_manual').val());
    formData.append('norek_manual', $('#norek_manual').val());
    formData.append('nama_manual', $('#nama_manual').val());
    formData.append('merchant_qris_manual', $('#merchant_qris_manual').val());
    formData.append('url_midtrans', $('#url_midtrans').val());
    formData.append('serverkey_midtrans', $('#serverkey_midtrans').val());
    formData.append('clientkey_midtrans', $('#clientkey_midtrans').val());
    formData.append('midtrans_production', $('#midtrans_production').val());
    formData.append('url_tripay', $('#url_tripay').val());
    formData.append('merchantcode_tripay', $('#merchantcode_tripay').val());
    formData.append('privatekey_tripay', $('#privatekey_tripay').val());
    formData.append('apikey_tripay', $('#apikey_tripay').val());

    if (qrisManualFile) {
        formData.append('qris_manual_file', qrisManualFile);
    }

    DiulemAdmin.post("<?= base_url('admin/update_setting_pembayaran_1') ?>", formData, { button: $(this), successMessage: 'Gateway pembayaran berhasil disimpan.', errorMessage: 'Gateway pembayaran gagal disimpan.' });
});

$('#simpanSetting2').on('click', function() {
    DiulemAdmin.post("<?= base_url('admin/update_setting_pembayaran_2') ?>", {
        metode_bayar: $('#metode_bayar').val()
    }, { button: $(this), successMessage: 'Metode pembayaran berhasil disimpan.', errorMessage: 'Metode pembayaran gagal disimpan.' });
});

$('#qris_manual_file').on('change', function() {
    var file = this.files && this.files[0] ? this.files[0] : null;
    var $preview = $('#qris_manual_preview');
    var $empty = $('#qris_manual_empty');

    if (!file) {
        if ($preview.attr('src')) {
            $preview.removeClass('d-none');
            $empty.addClass('d-none');
        } else {
            $preview.addClass('d-none').attr('src', '');
            $empty.removeClass('d-none');
        }
        return;
    }

    if (!file.type.match(/^image\//)) {
        $preview.addClass('d-none').attr('src', '');
        $empty.removeClass('d-none').text('File yang dipilih bukan gambar.');
        return;
    }

    var reader = new FileReader();
    reader.onload = function(event) {
        $preview.attr('src', event.target.result).removeClass('d-none');
        $empty.addClass('d-none').text('Belum ada QRIS manual yang diupload.');
    };
    reader.readAsDataURL(file);
});
</script>
