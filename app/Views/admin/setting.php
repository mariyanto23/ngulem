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
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Setting Undangan</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Waktu Trial Undangan (hari)</label>
                            <input id="trial" type="number" class="form-control" value="<?= esc($setting[0]->trial) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Salam Pembuka Default</label>
                            <textarea rows="4" id="salam_pembuka" class="form-control" required><?= esc($setting[0]->salam_pembuka) ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Salam Pembuka Whatsapp Atas</label>
                            <textarea rows="4" id="salam_wa_atas" class="form-control" required><?= esc($setting[0]->salam_wa_atas) ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Salam Pembuka Whatsapp Bawah</label>
                            <textarea rows="4" id="salam_wa_bawah" class="form-control" required><?= esc($setting[0]->salam_wa_bawah) ?></textarea>
                        </div>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalSetting2">
                            <i class="ti ti-device-floppy me-2"></i>Simpan
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Contact Admin</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Host Email</label>
                            <input id="host_email" type="text" class="form-control" placeholder="Contoh: smtp.gmail.com" value="<?= esc($setting[0]->host_email) ?>" required>
                            <small class="form-hint">Kosongkan jika tidak membutuhkan notifikasi email.</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input id="email" type="email" class="form-control" placeholder="Masukkan email" value="<?= esc($setting[0]->email) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password Email</label>
                            <input id="pass_email" type="text" class="form-control" placeholder="Masukkan password email" value="<?= esc($setting[0]->pass_email) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Whatsapp Gateway</label>
                            <select class="form-control" id="wa_gateway" name="wa_gateway" required>
                                <option value="nusagateway" <?= $setting[0]->wa_gateway == 'nusagateway' ? 'selected' : '' ?>>Nusagateway</option>
                                <option value="starsender" <?= $setting[0]->wa_gateway == 'starsender' ? 'selected' : '' ?>>Starsender</option>
                                <option value="onesender" <?= $setting[0]->wa_gateway == 'onesender' ? 'selected' : '' ?>>Onesender</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Token Whatsapp Gateway</label>
                            <input id="token_wa" type="text" class="form-control" placeholder="Masukkan token" value="<?= esc($setting[0]->token_wa) ?>" required>
                            <?php if ($setting[0]->wa_gateway != 'onesender') { ?>
                                <small class="form-hint">
                                    Kosongkan jika tidak memiliki token atau
                                    <a target="_blank" href="<?php if ($setting[0]->wa_gateway == 'nusagateway') { echo 'https://nusagateway.com'; } elseif ($setting[0]->wa_gateway == 'starsender') { echo 'https://starsender.online'; } ?>">klik disini</a>.
                                </small>
                            <?php } ?>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">No Whatsapp</label>
                            <input id="no_wa" type="text" class="form-control" placeholder="Contoh: 628xxxxxx" value="<?= esc($setting[0]->no_wa) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pesan Whatsapp</label>
                            <textarea rows="4" id="pesan_wa" class="form-control" required><?= esc($setting[0]->pesan_wa) ?></textarea>
                        </div>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalSetting1">
                            <i class="ti ti-device-floppy me-2"></i>Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= view('admin/components/confirm_modal', [
    'modalId' => 'modalSetting1',
    'message' => 'Apakah kamu yakin ingin menyimpan contact admin?',
    'confirmId' => 'simpanSetting1',
    'confirmText' => 'Ya, Simpan',
]) ?>

<?= view('admin/components/confirm_modal', [
    'modalId' => 'modalSetting2',
    'message' => 'Apakah kamu yakin ingin menyimpan setting undangan?',
    'confirmId' => 'simpanSetting2',
    'confirmText' => 'Ya, Simpan',
]) ?>

<script>
$('#simpanSetting1').on('click', function() {
    DiulemAdmin.post("<?= base_url('admin/update_setting1') ?>", {
        host_email: $('#host_email').val(),
        email: $('#email').val(),
        pass_email: $('#pass_email').val(),
        wa_gateway: $('#wa_gateway').val(),
        token_wa: $('#token_wa').val(),
        no_wa: $('#no_wa').val(),
        pesan_wa: $('#pesan_wa').val()
    }, {
        button: $(this),
        successMessage: 'Contact admin berhasil disimpan.',
        errorMessage: 'Contact admin gagal disimpan.'
    });
});

$('#simpanSetting2').on('click', function() {
    DiulemAdmin.post("<?= base_url('admin/update_setting2') ?>", {
        trial: $('#trial').val(),
        salam_pembuka: $('#salam_pembuka').val(),
        salam_wa_atas: $('#salam_wa_atas').val(),
        salam_wa_bawah: $('#salam_wa_bawah').val()
    }, {
        button: $(this),
        successMessage: 'Setting undangan berhasil disimpan.',
        errorMessage: 'Setting undangan gagal disimpan.'
    });
});
</script>
