<div class="page-body">
    <div class="container-xl">
        <div class="page-header d-print-none mb-3">
            <div class="row align-items-center">
                <div class="col">
                    <div class="page-pretitle">Admin</div>
                    <h1 class="page-title"><?= esc($title); ?></h1>
                    <div class="diulem-admin-page-note">Perbarui identitas akun admin utama. Password sekarang opsional dan akan disimpan dengan hash modern jika diubah.</div>
                </div>
            </div>
        </div>

        <div class="row row-cards">
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h3 class="card-title">Profil Admin</h3>
                            <div class="diulem-admin-card-note">Jaga email dan username tetap terbaru agar akses masuk dan notifikasi admin tetap lancar.</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input id="username" type="text" class="form-control" placeholder="Contoh: admin" value="<?= esc($admin[0]->username) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password Baru</label>
                            <input id="password" type="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengganti password">
                            <small class="form-hint">Password hanya diubah jika kolom ini diisi. Minimal 8 karakter.</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input id="email" type="email" class="form-control" placeholder="Contoh: admin@email.com" value="<?= esc($admin[0]->email) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input id="nama" type="text" class="form-control" placeholder="Contoh: Admin Diulem" value="<?= esc($admin[0]->nama_lengkap) ?>" required>
                        </div>
                        <button class="btn btn-primary" id="simpanAdmin">
                            <i class="ti ti-device-floppy me-2"></i>Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$('#simpanAdmin').on('click', function() {
    DiulemAdmin.post("<?= base_url('admin/update_admin') ?>", {
        username: $('#username').val(),
        password: $('#password').val(),
        nama: $('#nama').val(),
        email: $('#email').val()
    }, {
        button: $(this),
        successMessage: 'Profil admin berhasil disimpan.',
        errorMessage: 'Profil admin gagal disimpan.'
    });
});
</script>
