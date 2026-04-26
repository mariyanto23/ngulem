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
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Profil Pengguna</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input id="username" type="text" class="form-control" placeholder="Contoh: reydinda" value="<?= esc($user[0]->username) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password Baru</label>
                            <input id="password" type="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengganti password">
                            <small class="form-hint">Password hanya diubah jika kolom ini diisi.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input id="email" type="email" class="form-control" placeholder="Contoh: nama@email.com" value="<?= esc($user[0]->email) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nomor HP</label>
                            <input id="hp" type="tel" class="form-control" placeholder="Contoh: 6281234567890" value="<?= esc($user[0]->hp) ?>" required>
                            <small class="form-hint">Gunakan format internasional, misalnya 6281234567890.</small>
                        </div>

                        <button class="btn btn-primary" id="simpanUser">
                            <i class="ti ti-device-floppy me-2"></i>Simpan Profil
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body text-center">
                        <span class="avatar avatar-xl mb-3 diulem-profile-avatar">
                            <img src="<?= base_url('assets/dashboard'); ?>/img/boy.png" alt="Foto profil">
                        </span>
                        <h3 class="card-title mb-1"><?= esc($user[0]->username) ?></h3>
                        <div class="text-secondary mb-3"><?= esc($user[0]->email) ?></div>
                        <div class="text-secondary">Profil ini digunakan untuk akses dashboard pengguna.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$('#simpanUser').on('click', function() {
    var $button = $(this);
    var username = $('#username').val();
    var hp = $('#hp').val();
    var password = $('#password').val();
    var email = $('#email').val();

    DiulemDashboard.post("<?= base_url('user/update_user') ?>", {
        username: username,
        password: password,
        hp: hp,
        email: email
    }, {
        button: $button,
        successMessage: 'Profil berhasil diupdate.',
        errorMessage: 'Profil gagal diupdate.'
    });
});
</script>
