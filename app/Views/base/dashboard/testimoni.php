<div class="page-body">
    <div class="container-xl">
        <div class="page-header d-print-none mb-3">
            <div class="row align-items-center">
                <div class="col">
                    <div class="page-pretitle">Akun</div>
                    <h1 class="page-title"><?= esc($title); ?></h1>
                </div>
                <div class="col-auto">
                    <a href="<?= rtrim(SITE_UNDANGAN, '/') ?>/<?= esc($order[0]->domain) ?>" target="_blank" class="btn btn-primary">
                        <i class="ti ti-external-link me-2"></i>Lihat Website
                    </a>
                </div>
            </div>
        </div>

        <div class="row row-cards">
            <div class="col-xl-6 col-lg-7">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Testimonial</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input id="nama" type="text" class="form-control" placeholder="Contoh: Rey Dinda" value="<?= esc($testimoni[0]->nama_lengkap) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kota</label>
                            <input id="kota" type="text" class="form-control" placeholder="Contoh: Demak" value="<?= esc($testimoni[0]->kota) ?>" required>
                        </div>

                        <input id="status" type="hidden" value="<?php if ($testimoni[0]->status == 0) {
                                                                    echo '1';
                                                                } else {
                                                                    echo esc($testimoni[0]->status);
                                                                } ?>">

                        <div class="mb-3">
                            <label class="form-label">Provinsi</label>
                            <input id="provinsi" type="text" class="form-control" placeholder="Contoh: Jawa Tengah" value="<?= esc($testimoni[0]->provinsi) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ulasan</label>
                            <textarea id="ulasan" class="form-control" rows="5"><?= esc($testimoni[0]->ulasan) ?></textarea>
                        </div>

                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalUser">
                            <i class="ti ti-device-floppy me-2"></i>Kirim
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= view('base/dashboard/components/confirm_modal', [
    'modalId' => 'modalUser',
    'message' => 'Apakah kamu yakin ingin menyimpan testimonial?',
    'confirmId' => 'simpanTesti',
    'confirmText' => 'Ya, Simpan',
    'confirmClass' => 'btn-primary',
]) ?>

<script>
    $('#simpanTesti').on('click', function() {
        DiulemDashboard.post("<?= base_url('user/update_testi') ?>", {
            nama: $('#nama').val(),
            kota: $('#kota').val(),
            provinsi: $('#provinsi').val(),
            ulasan: $('#ulasan').val(),
            status: $('#status').val()
        }, {
            button: $(this),
            successMessage: 'Testimonial berhasil disimpan.',
            errorMessage: 'Testimonial gagal disimpan.'
        });
    });
</script>