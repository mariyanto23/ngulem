<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#0f766e">
    <link href="<?= base_url('assets/base'); ?>/img/favicon.ico" rel="icon">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/css/tabler.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    <link href="<?= base_url('assets/admin/'); ?>/css/diulem-admin.css?v=<?= filemtime(FCPATH . 'assets/admin/css/diulem-admin.css') ?>" rel="stylesheet">
</head>

<body>
<?php 
 echo view($view);
?>
<script src="<?= base_url('assets/dashboard'); ?>/vendor/jquery/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/js/tabler.min.js"></script>
</body>
<script>
setTimeout(function () {
    $('#ikierror').hide();
}, 2500);

function myFunction() {
    var password = document.getElementById('password');
    if (!password) {
        return;
    }
    password.type = password.type === 'password' ? 'text' : 'password';
}
</script>

</html>
