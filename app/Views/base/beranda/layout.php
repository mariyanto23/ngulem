<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?php if ($title != 'Beranda') { echo $title . ' -'; } ?> <?= SITE_NAME ?> | Unik, Murah, Modern</title>
    <meta name="theme-color" content="#7ed9fc">
    <meta name="msapplication-navbutton-color" content="#7ed9fc">
    <meta name="apple-mobile-web-app-status-bar-style" content="#7ed9fc">
    <link rel="shortcut icon" href="<?= base_url('assets/base/img/favicon.ico') ?>">
    <link rel="apple-touch-icon" href="<?= base_url('assets/base/img/favicon.ico') ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= base_url('assets/base/img/favicon.ico') ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= base_url('assets/base/img/favicon.ico') ?>">
    <meta name="robots" content="index, follow"/>
    <meta name="description" content="<?= SITE_NAME ?> adalah layanan undangan online. Yaitu undangan yang dikemas dalam bentuk web yang praktis dan mudah untuk digunakan maupun dibagikan. Selain itu kami juga menerima jasa pembuatan undangan cetak maupun Video.">
    <meta name="keywords" content="undangan digital,undangan online,undangan pernikahan,undangan murah, undangan praktis,undangan nikah,undangan website,creative digital,digital marketing lampung, undangan cetak, udangan kartu,undangan lampung murah,undangan online lampung">
    <meta name="author" content="Undangan Online | Unik, Murah, Modern">
    <meta http-equiv="Copyright" content="Undangan Online | Unik, Murah, Modern">
    <meta name="copyright" content="Undangan Online | Unik, Murah, Modern">
    <meta property="og:type" content="article"/>
    <meta property="profile:first_name" content="Undangan Online | Unik, Murah, Modern"/>
    <meta property="profile:last_name" content="Undangan Online | Unik, Murah, Modern"/> 
    <meta property="profile:username" content="Undangan Online | Unik, Murah, Modern"/>
    <meta property="og:title" content="Undangan Online | Unik, Murah, Modern"/>
    <meta property="og:type" content="blog">
    <meta property="og:description" content="<?= SITE_NAME ?> adalah layanan undangan online. Yaitu undangan yang dikemas dalam bentuk web yang praktis dan mudah untuk digunakan maupun dibagikan. Selain itu kami juga menerima jasa pembuatan undangan cetak maupun Video."/>
    <meta property="og:image" content="<?= base_url('assets/base/img/favicon.ico') ?>"/>
    <meta property="og:url" content="<?= base_url() ?>"/>
    <meta property="og:site_name" content="Undangan Online | Unik, Murah, Modern"/>
    <meta itemprop="name" content="Undangan Online | Unik, Murah, Modern"/>
    <meta itemprop="description" content="<?= SITE_NAME ?> adalah layanan undangan online. Yaitu undangan yang dikemas dalam bentuk web yang praktis dan mudah untuk digunakan maupun dibagikan. Selain itu kami juga menerima jasa pembuatan undangan cetak maupun Video."/>
    <link rel="stylesheet" href="<?= base_url('assets/beranda/themes/assets/css/sw-main.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/beranda/themes/assets/css/sw-responsive.css') ?>">
  </head>
  <body oncontextmenu="return false">
    <?= view('base/beranda/components/public_header', ['title' => $title ?? 'Beranda', 'setting' => $setting ?? null]) ?>

    <?php echo view($view); ?>

    <?= view('base/beranda/components/public_footer', ['setting' => $setting ?? null]) ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="<?= base_url('assets/beranda/themes/assets/js/sw-plugins.js') ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="<?= base_url('assets/beranda/themes/assets/js/sw-main.js') ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/scrollReveal.js/2.0.0/scrollReveal.js"></script>
    <script src="<?= base_url('assets/beranda/themes/assets/js/particles.js') ?>"></script>
    <script src="<?= base_url('assets/beranda/themes/assets/js/sw-particles.js') ?>"></script>
    <script type="text/javascript">
      $('.sw-counter').each(function() {
        var $this = $(this),
            countTo = $this.attr('data-count');
        $({ countNum: $this.text() }).animate({ countNum: countTo }, {
          duration: 1000,
          easing: 'linear',
          step: function() {
            $this.text(Math.floor(this.countNum));
          },
          complete: function() {
            $this.text(this.countNum);
          }
        });
      });

      $(document).ready(function () {
        $('.btn-demo').on('click', function () {
          const link_video = $(this).data('link');
          const nama_tema = $(this).data('nama');
          $('.demo-video').html(link_video);
          $('.nama_tema').html(nama_tema);
          $('#sw-demo').modal('show');
        });

        $('#sw-demo').on('hide.bs.modal', function () {
          $('.demo-video').html('');
        });
      });
    </script>
  </body>
</html>
