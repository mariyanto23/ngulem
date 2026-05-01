<?php
$siteFaviconFile = 'assets/base/img/favicon.ico';
if (is_file(FCPATH . 'assets/base/img/favicon.png')) {
    $siteFaviconFile = 'assets/base/img/favicon.png';
}
$siteFaviconUrl = base_url($siteFaviconFile) . '?v=' . (@filemtime(FCPATH . $siteFaviconFile) ?: time());
$siteLogoFile = 'assets/base/img/logo.png';
$siteLogoUrl = base_url($siteLogoFile) . '?v=' . (@filemtime(FCPATH . $siteLogoFile) ?: time());
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="<?= $siteFaviconUrl ?>" rel="icon">
    <title><?= $title ?></title>
    <link href="<?= base_url('assets/dashboard'); ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/dashboard'); ?>/vendor/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/dashboard'); ?>/css/diulem-dashboard.css" rel="stylesheet">
    <style>
        body.diulem-auth-page {
            min-height: 100vh;
            background: linear-gradient(180deg, #f6fbfa 0%, #eef5f3 100%);
        }

        .public-auth-main {
            padding: 48px 16px;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .public-auth-main .diulem-auth-shell {
            min-height: auto;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @media (max-width: 767.98px) {
            .public-auth-main {
                padding: 24px 16px;
            }
        }
    </style>

</head>

<body class="diulem-auth-page">
<main class="public-auth-main">
<?php echo view($view, ['siteLogoUrl' => $siteLogoUrl, 'siteFaviconUrl' => $siteFaviconUrl]); ?>
</main>
<script src="<?= base_url('assets/dashboard'); ?>/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/dashboard'); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
<script>
setTimeout("$('#ikierror').hide();", 2000);
</script>

</html>
