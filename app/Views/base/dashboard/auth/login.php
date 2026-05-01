<div class="diulem-auth-shell">
    <div class="diulem-auth-card">
        <div class="diulem-auth-brand text-center">
            <a href="<?= SITE_UTAMA ?>" class="diulem-auth-logo">
                <img src="<?= esc($siteLogoUrl ?? base_url('assets/base/img/logo.png')) ?>" alt="<?= SITE_NAME ?>">
            </a>
            <h1 class="diulem-auth-title">Login</h1>
            <p class="diulem-auth-subtitle">Masuk ke dashboard pengguna untuk melanjutkan pengaturan undangan.</p>
        </div>

        <?php
        $session = session();
        $errors = $session->getFlashdata('errors');
        if ($errors != null): ?>
            <div class="alert alert-danger" role="alert" id="ikierror">
                <strong>Gagal masuk.</strong>
                <?php foreach ($errors as $err): ?>
                    <div><?= esc($err) ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif;

        $success = $session->getFlashdata('success');
        if ($success != null): ?>
            <div class="alert alert-success" role="alert" id="ikierror">
                <strong>Berhasil.</strong>
                <?php foreach ($success as $succ): ?>
                    <div><?= esc($succ) ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="post" action="<?= base_url('do_auth'); ?>" class="diulem-auth-form">
            <div class="form-group">
                <label class="diulem-auth-label" for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="nama@email.com" name="email" autocomplete="email" required>
            </div>
            <div class="form-group">
                <label class="diulem-auth-label" for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Masukkan password" name="password" autocomplete="current-password" required>
            </div>
            <div class="form-group mb-4">
                <div class="custom-control custom-checkbox diulem-auth-check">
                    <input type="checkbox" class="custom-control-input" onclick="myFunction()" id="customCheck">
                    <label class="custom-control-label" for="customCheck">Tampilkan password</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>

        <div class="diulem-auth-links text-center">
            <a href="<?= base_url('lupa_password'); ?>">Lupa Password</a>
        </div>
    </div>
</div>

<script>
    function myFunction() {
        var input = document.getElementById('password');
        input.type = input.type === 'password' ? 'text' : 'password';
    }
</script>
