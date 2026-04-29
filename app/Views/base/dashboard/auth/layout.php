<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="<?= base_url('assets/base'); ?>/img/favicon.ico" rel="icon">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/base'); ?>/css/fontawesome.css">
    <link rel="stylesheet" href="<?= base_url('assets/beranda/themes/assets/css/sw-main.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/beranda/themes/assets/css/sw-responsive.css') ?>">
    <link href="<?= base_url('assets/dashboard'); ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/dashboard'); ?>/vendor/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/dashboard'); ?>/css/diulem-dashboard.css" rel="stylesheet">
    <style>
        body.diulem-auth-page {
            min-height: 100vh;
            background: linear-gradient(180deg, #f6fbfa 0%, #eef5f3 100%);
        }

        .public-auth-main {
            padding: 128px 16px 72px;
        }

        .public-auth-main .diulem-auth-shell {
            min-height: calc(100vh - 320px);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @media (max-width: 767.98px) {
            .public-auth-main {
                padding-top: 112px;
                padding-bottom: 56px;
            }
        }
    </style>

</head>

<body class="diulem-auth-page">
<?= view('base/beranda/components/public_header') ?>
<main class="public-auth-main">
<?php echo view($view); ?>
</main>
<?= view('base/beranda/components/public_footer') ?>
<script src="<?= base_url('assets/dashboard'); ?>/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/dashboard'); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/base/js/jquery.easing.min.js') ?>"></script>
<script src="<?= base_url('assets/beranda/themes/assets/js/sw-main.js') ?>"></script>
</body>
<script>
setTimeout("$('#ikierror').hide();", 2000);
</script>

</html>
