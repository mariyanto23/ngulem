<?php
$waGatewayRaw = $setting[0]->wa_gateway ?? 'nusagateway';
$waTokenRaw = $setting[0]->token_wa ?? '';
$waGatewayEnabled = (strpos($waGatewayRaw, 'off:') === 0 || strpos($waTokenRaw, '__disabled__:') === 0) ? '0' : '1';
$waGatewayProvider = strpos($waGatewayRaw, 'off:') === 0 ? substr($waGatewayRaw, 4) : $waGatewayRaw;
if (! in_array($waGatewayProvider, ['nusagateway', 'starsender', 'onesender'], true)) {
    $waGatewayProvider = 'nusagateway';
}
$waTokenValue = strpos($waTokenRaw, '__disabled__:') === 0 ? substr($waTokenRaw, 13) : $waTokenRaw;
$waGatewayLink = '';
if ($waGatewayProvider === 'nusagateway') {
    $waGatewayLink = 'https://nusagateway.com';
} elseif ($waGatewayProvider === 'starsender') {
    $waGatewayLink = 'https://starsender.online';
}
?>
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
                        <button class="btn btn-primary" id="simpanSetting2">
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
                            <label class="form-label mb-2">Status Whatsapp Gateway</label>
                            <label class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" id="wa_gateway_enabled" <?= $waGatewayEnabled === '1' ? 'checked' : '' ?>>
                                <span class="form-check-label">Aktifkan Whatsapp Gateway</span>
                            </label>
                            <div class="form-hint">Saat dimatikan, sistem tidak mengirim pesan WA dan tidak memblokir aksi apa pun.</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Whatsapp Gateway</label>
                            <select class="form-control" id="wa_gateway" name="wa_gateway" required>
                                <option value="nusagateway" <?= $waGatewayProvider == 'nusagateway' ? 'selected' : '' ?>>Nusagateway</option>
                                <option value="starsender" <?= $waGatewayProvider == 'starsender' ? 'selected' : '' ?>>Starsender</option>
                                <option value="onesender" <?= $waGatewayProvider == 'onesender' ? 'selected' : '' ?>>Onesender</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Token Whatsapp Gateway</label>
                            <input id="token_wa" type="text" class="form-control" placeholder="Masukkan token" value="<?= esc($waTokenValue) ?>" required>
                            <?php if ($waGatewayProvider != 'onesender' && ! empty($waGatewayLink)) { ?>
                                <small class="form-hint">
                                    Kosongkan jika tidak memiliki token atau
                                    <a target="_blank" href="<?= esc($waGatewayLink) ?>">klik disini</a>.
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
                        <button class="btn btn-primary" id="simpanSetting1">
                            <i class="ti ti-device-floppy me-2"></i>Simpan
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Musik Latar Bawaan</h3>
                    </div>
                    <form method="post" enctype="multipart/form-data" action="<?= base_url('admin/upload_musik_library'); ?>">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Judul Musik</label>
                                <input type="text" name="judul_musik" class="form-control" placeholder="Contoh: Romantic Piano">
                                <div class="form-hint">Opsional. Jika kosong, judul mengikuti nama file.</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">File MP3</label>
                                <input type="file" name="musik_library" class="form-control" accept=".mp3,audio/mpeg">
                                <div class="form-hint">Format MP3, maksimal 5MB.</div>
                            </div>
                            <button class="btn btn-primary" type="submit">
                                <i class="ti ti-upload me-2"></i>Tambah Musik
                            </button>
                        </div>
                    </form>
                    <div class="card-body border-top">
                        <div class="d-flex flex-column gap-3">
                            <?php if (! empty($music_library)) { ?>
                                <?php foreach ($music_library as $track) { ?>
                                    <div class="border rounded p-3">
                                        <div class="d-flex justify-content-between align-items-start gap-3 flex-wrap">
                                            <div>
                                                <div class="fw-semibold"><?= esc($track['title']) ?></div>
                                                <div class="text-secondary small"><?= esc($track['file']) ?></div>
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <?php if (! empty($track['is_default'])) { ?>
                                                    <span class="badge bg-azure text-azure-fg">Default</span>
                                                <?php } else { ?>
                                                    <form method="post" action="<?= base_url('admin/delete_musik_library'); ?>" onsubmit="return confirm('Hapus musik ini dari koleksi admin?');">
                                                        <input type="hidden" name="track_key" value="<?= esc($track['key']) ?>">
                                                        <button class="btn btn-outline-danger btn-sm" type="submit">
                                                            <i class="ti ti-trash me-1"></i>Hapus
                                                        </button>
                                                    </form>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <audio class="w-100 mt-3" controls preload="none">
                                            <source src="<?= esc($track['url']) ?>" type="audio/mpeg">
                                        </audio>
                                    </div>
                                <?php } ?>
                            <?php } else { ?>
                                <div class="empty">
                                    <div class="empty-img"><i class="ti ti-music fs-1 text-secondary"></i></div>
                                    <p class="empty-title">Belum ada musik tersedia</p>
                                    <p class="empty-subtitle text-secondary">Upload musik bawaan agar pengguna bisa memilih selain upload sendiri.</p>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Quote Pernikahan Bawaan</h3>
                    </div>
                    <form method="post" action="<?= base_url('admin/add_quote_library'); ?>">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Isi Quote</label>
                                <textarea name="quote_text" rows="4" class="form-control" placeholder="Masukkan quote pernikahan"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Sumber</label>
                                <input type="text" name="quote_source" class="form-control" placeholder="Contoh: QS. Ar-Rum: 21 atau Anonim">
                            </div>
                            <button class="btn btn-primary" type="submit">
                                <i class="ti ti-plus me-2"></i>Tambah Quote
                            </button>
                        </div>
                    </form>
                    <div class="card-body border-top">
                        <div class="d-flex flex-column gap-3">
                            <?php if (! empty($quote_library)) { ?>
                                <?php foreach ($quote_library as $quoteItem) { ?>
                                    <div class="border rounded p-3">
                                        <div class="d-flex justify-content-between align-items-start gap-3 flex-wrap">
                                            <div>
                                                <div class="fw-semibold">"<?= esc($quoteItem['text'] ?? '') ?>"</div>
                                                <div class="text-secondary small"><?= esc($quoteItem['source'] ?? 'Tanpa sumber') ?></div>
                                            </div>
                                            <form method="post" action="<?= base_url('admin/delete_quote_library'); ?>" onsubmit="return confirm('Hapus quote ini?');">
                                                <input type="hidden" name="quote_id" value="<?= esc($quoteItem['id'] ?? '') ?>">
                                                <button class="btn btn-outline-danger btn-sm" type="submit">
                                                    <i class="ti ti-trash me-1"></i>Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } else { ?>
                                <div class="empty">
                                    <div class="empty-img"><i class="ti ti-quote fs-1 text-secondary"></i></div>
                                    <p class="empty-title">Belum ada quote tersedia</p>
                                    <p class="empty-subtitle text-secondary">Tambahkan quote bawaan agar pengguna bisa memilih dengan cepat.</p>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$('#simpanSetting1').on('click', function() {
    DiulemAdmin.post("<?= base_url('admin/update_setting1') ?>", {
        host_email: $('#host_email').val(),
        email: $('#email').val(),
        pass_email: $('#pass_email').val(),
        wa_gateway: $('#wa_gateway').val(),
        wa_gateway_enabled: $('#wa_gateway_enabled').is(':checked') ? 1 : 0,
        token_wa: $('#token_wa').val(),
        no_wa: $('#no_wa').val(),
        pesan_wa: $('#pesan_wa').val()
    }, {
        button: $(this),
        successMessage: 'Kontak admin dan Whatsapp Gateway berhasil disimpan.',
        errorMessage: 'Kontak admin dan Whatsapp Gateway gagal disimpan.'
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
