<div class="diulem-auth-shell">
    <div class="diulem-auth-card">
        <div class="diulem-auth-brand text-center">
            <a href="<?= SITE_UTAMA ?>" class="diulem-auth-logo">
                <img src="<?= base_url() ?>/assets/base/img/logo.png" alt="Diulem">
            </a>
            <h1 class="diulem-auth-title">Ganti Password</h1>
            <p class="diulem-auth-subtitle">Buat password baru untuk mengamankan akun dashboard pengguna.</p>
        </div>

        <?php
        $session = session();
        $errors = $session->getFlashdata('errors');
        if ($errors != null): ?>
            <div class="alert alert-danger" role="alert" id="ikierror">
                <strong>Gagal memperbarui.</strong>
                <?php foreach ($errors as $err): ?>
                    <div><?= esc($err) ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="post" action="<?= base_url('update_password'); ?>" class="diulem-auth-form">
            <input type="hidden" name="id_user" value="<?= esc($id_user) ?>">
            <input type="hidden" name="reset_token" value="<?= esc($reset_token ?? '') ?>">
            <div class="form-group">
                <label class="diulem-auth-label" for="pass">Password Baru</label>
                <input type="password" class="form-control" id="pass" placeholder="Masukkan password baru" name="pass">
                <small class="form-text text-muted">Minimal 8 karakter.</small>
            </div>
            <div class="form-group">
                <label class="diulem-auth-label" for="pass2">Konfirmasi Password</label>
                <input type="password" class="form-control" id="pass2" placeholder="Ulangi password baru" name="pass2">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Ganti Password</button>
        </form>

        <div class="diulem-auth-links text-center">
            <a href="<?= base_url('login'); ?>">Kembali ke Login</a>
        </div>
    </div>
</div>
