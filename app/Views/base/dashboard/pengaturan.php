<div class="page-body">
<?php
$waGatewayRaw = $setting[0]->wa_gateway ?? 'nusagateway';
$waTokenRaw = $setting[0]->token_wa ?? '';
$waGatewayEnabled = (strpos($waGatewayRaw, 'off:') === 0 || strpos($waTokenRaw, '__disabled__:') === 0) ? '0' : '1';
$waGatewayProvider = strpos($waGatewayRaw, 'off:') === 0 ? substr($waGatewayRaw, 4) : $waGatewayRaw;
if (! in_array($waGatewayProvider, ['nusagateway', 'starsender', 'onesender'], true)) {
    $waGatewayProvider = 'nusagateway';
}
$waGatewayLink = '';
if ($waGatewayProvider === 'nusagateway') {
    $waGatewayLink = 'https://nusagateway.com';
} elseif ($waGatewayProvider === 'starsender') {
    $waGatewayLink = 'https://starsender.online';
}
?>
    <div class="container-xl">
        <div class="page-header d-print-none mb-3">
            <div class="row align-items-center">
                <div class="col">
                    <div class="page-pretitle">Undangan</div>
                    <h1 class="page-title"><?= esc($title); ?></h1>
                </div>
            </div>
        </div>

        <div class="row row-cards">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pengaturan Undangan</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Domain / URL Undangan</label>
                            <div class="input-group">
                                <span class="input-group-text"><?= esc(DOMAIN_UNDANGAN) ?>/</span>
                                <input id="domain" type="text" class="form-control" placeholder="akudandia" value="<?= esc($order[0]->domain) ?>" onkeyup="nospaces(this)" required>
                            </div>
                        </div>
                        <button class="btn btn-primary" id="simpanDomain">
                            <i class="ti ti-device-floppy me-2"></i>Simpan Domain
                        </button>
                    </div>
                    <div class="card-body border-top">
                        <div class="mb-3">
                            <label class="form-label">Token Whatsapp Gateway</label>
                            <input id="token_wa" type="text" class="form-control" placeholder="Masukan Token Whatsapp Gateway anda" value="<?= esc($data[0]->token_wa) ?>">
                            <?php if ($waGatewayEnabled === '0') { ?>
                                <small class="form-hint text-warning">Whatsapp Gateway sedang dimatikan oleh admin.</small>
                            <?php } elseif ($waGatewayProvider != 'onesender' && ! empty($waGatewayLink)) { ?>
                                <small class="form-hint">
                                    Kosongkan jika tidak memiliki Token Whatsapp Gateway atau
                                    <a target="_blank" href="<?= esc($waGatewayLink) ?>">klik disini</a>.
                                </small>
                            <?php } ?>
                        </div>
                        <button class="btn btn-primary" id="simpanToken">
                            <i class="ti ti-device-floppy me-2"></i>Simpan Token
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Musik</h3>
                    </div>
                    <form method="post" enctype="multipart/form-data" action="<?= base_url('user/update_musik'); ?>">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Musik Latar</label>
                                <input type="file" name="musik" id="musik" class="form-control" accept=".mp3">
                                <small class="form-hint">Format MP3, maksimal 2MB.</small>
                            </div>
                            <button class="btn btn-primary" type="submit">
                                <i class="ti ti-upload me-2"></i>Upload Musik
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Salam Pembuka</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Salam Pembuka Undangan</label>
                            <textarea rows="4" id="salam_pembuka" class="form-control" required><?= esc($data[0]->salam_pembuka) ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Salam Pembuka Whatsapp Atas</label>
                            <textarea rows="4" id="salam_wa_atas" class="form-control" required><?= esc($data[0]->salam_wa_atas) ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Salam Pembuka Whatsapp Bawah</label>
                            <textarea rows="4" id="salam_wa_bawah" class="form-control" required><?= esc($data[0]->salam_wa_bawah) ?></textarea>
                        </div>
                        <button class="btn btn-primary" id="simpanSalam">
                            <i class="ti ti-device-floppy me-2"></i>Simpan Salam
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Fitur Undangan</h3>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" disabled checked id="setSampul">
                                    <span class="form-check-label">Halaman Sampul</span>
                                </label>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" disabled checked id="setMempelai">
                                    <span class="form-check-label">Halaman Mempelai</span>
                                </label>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" disabled checked id="setAcara">
                                    <span class="form-check-label">Halaman Acara</span>
                                </label>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" id="setUcapan" <?php if ($fitur[0]->komen == '1') echo 'checked'; ?>>
                                    <span class="form-check-label">Halaman Ucapan</span>
                                </label>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" id="setAlbum" <?php if ($fitur[0]->gallery == '1') echo 'checked'; ?>>
                                    <span class="form-check-label">Halaman Gallery/Album</span>
                                </label>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" id="setCerita" <?php if ($fitur[0]->cerita == '1') echo 'checked'; ?>>
                                    <span class="form-check-label">Halaman Cerita</span>
                                </label>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" id="setLokasi" <?php if ($fitur[0]->lokasi == '1') echo 'checked'; ?>>
                                    <span class="form-check-label">Halaman Lokasi</span>
                                </label>
                            </div>
                            <?php if ($paket[0]->buku_tamu == 1) { ?>
                                <div class="col-sm-6">
                                    <label class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input" id="setQrcode" <?php if ($fitur[0]->qrcode == '1') echo 'checked'; ?>>
                                        <span class="form-check-label">Halaman QrCode</span>
                                    </label>
                                </div>
                            <?php } ?>
                            <div class="col-sm-6">
                                <label class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" id="setProkes" <?php if ($fitur[0]->prokes == '1') echo 'checked'; ?>>
                                    <span class="form-check-label">Halaman Prokes</span>
                                </label>
                            </div>
                            <?php if ($paket[0]->kirim_hadiah == 1) { ?>
                                <div class="col-sm-6">
                                    <label class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input" id="setHadiah" <?php if ($fitur[0]->hadiah == '1') echo 'checked'; ?>>
                                        <span class="form-check-label">Halaman Kirim Hadiah</span>
                                    </label>
                                </div>
                            <?php } ?>
                            <div class="col-sm-6">
                                <label class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" id="setQuote" <?php if ($fitur[0]->quote == '1') echo 'checked'; ?>>
                                    <span class="form-check-label">Halaman Quote</span>
                                </label>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="button" class="btn btn-primary" id="simpanFitur">
                                <i class="ti ti-device-floppy me-2"></i>Simpan Fitur
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function nospaces(t) {
    if (t.value.match(/\s/g)) {
        t.value = t.value.replace(/\s/g, '');
    }
}

$('#simpanFitur').on('click', function() {
    var $button = $(this);
    var ucapan = $('#setUcapan').is(':checked') ? 1 : 0;
    var album = $('#setAlbum').is(':checked') ? 1 : 0;
    var cerita = $('#setCerita').is(':checked') ? 1 : 0;
    var lokasi = $('#setLokasi').is(':checked') ? 1 : 0;
    var prokes = $('#setProkes').is(':checked') ? 1 : 0;
    var qrcode = $('#setQrcode').is(':checked') ? 1 : 0;
    var hadiah = $('#setHadiah').is(':checked') ? 1 : 0;
    var quote = $('#setQuote').is(':checked') ? 1 : 0;

    DiulemDashboard.post("<?= base_url('user/update_fitur') ?>", {
        ucapan: ucapan,
        album: album,
        cerita: cerita,
        lokasi: lokasi,
        prokes: prokes,
        qrcode: qrcode,
        hadiah: hadiah,
        quote: quote
    }, {
        button: $button,
        successMessage: 'Data fitur berhasil diupdate.',
        errorMessage: 'Data fitur gagal diupdate.'
    });
});

$('#simpanDomain').on('click', function() {
    var $button = $(this);
    var domain = $('#domain').val();

    DiulemDashboard.post("<?= base_url('user/update_domain') ?>", {
        domain: domain
    }, {
        button: $button,
        reload: false,
        errorMessage: 'Domain gagal diupdate.',
        onSuccess: function(result) {
            result = $.trim(result);

            if (result === 'sukses') {
                DiulemDashboard.reloadAfterSuccess(result, 'Domain berhasil diupdate.', 'Domain gagal diupdate.');
                return;
            }

            DiulemDashboard.notify('error', 'Gagal', 'Gagal mengganti nama domain. Nama domain sudah dipakai.');
        }
    });
});

$('#simpanToken').on('click', function() {
    var $button = $(this);
    var token_wa = $('#token_wa').val();

    DiulemDashboard.post("<?= base_url('user/update_wa') ?>", {
        token_wa: token_wa
    }, {
        button: $button,
        successMessage: 'Token Whatsapp Gateway berhasil diupdate.',
        errorMessage: 'Token Whatsapp Gateway gagal diupdate.'
    });
});

$('#simpanSalam').on('click', function() {
    var $button = $(this);
    var salam_pembuka = $('#salam_pembuka').val();
    var salam_wa_atas = $('#salam_wa_atas').val();
    var salam_wa_bawah = $('#salam_wa_bawah').val();

    DiulemDashboard.post("<?= base_url('user/update_salam') ?>", {
        salam_pembuka: salam_pembuka,
        salam_wa_atas: salam_wa_atas,
        salam_wa_bawah: salam_wa_bawah
    }, {
        button: $button,
        successMessage: 'Salam pembuka berhasil diupdate.',
        errorMessage: 'Salam pembuka gagal diupdate.'
    });
});
</script>
