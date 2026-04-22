<div class="diulem-admin-login-page">
    <div class="diulem-admin-login-card mx-auto">
        <div class="text-center mb-4">
            <a href="<?= SITE_UTAMA ?>">
                <img src="<?= base_url() ?>/assets/base/img/logo.png" height="54" alt="<?= SITE_NAME ?>">
            </a>
        </div>

        <div class="card">
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <h1 class="h2 mb-1">Login Admin</h1>
                    <div class="text-secondary">Masuk untuk mengelola <?= SITE_NAME ?></div>
                </div>
                <?php
                $session = session();
                $errors = $session->getFlashdata('errors');
                if ($errors != null): ?>
                    <div class="alert alert-danger" role="alert" id="ikierror">
                        <strong>Login gagal.</strong>
                        <?php foreach ($errors as $err) {
                            echo esc($err);
                        } ?>
                    </div>
                <?php endif ?>
                <form method="post" action="<?= base_url('do_auth'); ?>">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" placeholder="admin@email.com" name="email" autocomplete="email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password" name="password" autocomplete="current-password">
                    </div>
                    <label class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" onclick="myFunction()" id="customCheck">
                        <span class="form-check-label">Tampilkan password</span>
                    </label>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="ti ti-login me-2"></i>Login
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
