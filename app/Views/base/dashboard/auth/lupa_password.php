<div class="diulem-auth-shell">
    <div class="diulem-auth-card">
        <div class="diulem-auth-brand text-center">
            <a href="<?= SITE_UTAMA ?>" class="diulem-auth-logo">
                <img src="<?= esc($siteLogoUrl ?? base_url('assets/base/img/logo.png')) ?>" alt="<?= SITE_NAME ?>">
            </a>
            <h1 class="diulem-auth-title">Lupa Password</h1>
            <p class="diulem-auth-subtitle">Masukkan email akunmu. Kami akan kirim langkah untuk membuat password baru.</p>
        </div>

        <?php
        $session = session();
        $errors = $session->getFlashdata('errors');
        if ($errors != null): ?>
            <div class="alert alert-danger" role="alert" id="ikierror">
                <strong>Gagal mengirim.</strong>
                <?php foreach ($errors as $err): ?>
                    <div><?= esc($err) ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="post" action="<?= base_url('do_kirim'); ?>" class="diulem-auth-form">
            <div class="form-group">
                <label class="diulem-auth-label" for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="nama@email.com" name="email" autocomplete="email" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Kirim Link Reset</button>
        </form>

        <div class="diulem-auth-links text-center">
            <a href="<?= base_url('login'); ?>">Kembali ke Login</a>
        </div>
    </div>
</div>
