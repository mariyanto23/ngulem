<?php
use App\Models\base\BerandaModel;

$publicTitle = $title ?? 'Beranda';
$publicSetting = $setting ?? null;
if (empty($publicSetting)) {
    $publicSetting = (new BerandaModel())->get_setting();
}
?>
<style>
  .diulem-public-header .navbar-nav {
    display: block;
  }

  .diulem-public-header .navbar-nav > li {
    float: left;
  }

  .diulem-public-header .navbar-collapse.collapse {
    display: block !important;
    height: auto !important;
    padding-bottom: 0;
    overflow: visible !important;
  }

  .diulem-public-header .navbar-toggle {
    display: none;
  }

  @media (max-width: 767px) {
    .diulem-public-header .navbar-toggle {
      display: block;
    }

    .diulem-public-header .navbar-collapse.collapse {
      display: none !important;
    }

    .diulem-public-header .navbar-collapse.collapse.in {
      display: block !important;
    }

    .diulem-public-header .navbar-nav {
      float: none;
    }

    .diulem-public-header .navbar-nav > li {
      float: none;
    }

    .diulem-public-header .nav-right {
      float: none !important;
    }
  }
</style>
<header class="header diulem-public-header">
  <nav class="navbar-me navbar navbar-default" id="mainNav">
    <div class="container">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Toggle Navigation</span>
        <i class="fa fa-bars"></i>
      </button>
      <a class="navbar-brand pull-left" href="<?= base_url() ?>" title="<?= SITE_NAME ?>">
        <img class="img-responsive" src="<?= base_url('assets/base/img/logo4.png') ?>" alt="<?= SITE_NAME ?>">
      </a>
      <div class="collapse navbar-collapse navbar-ex1-collapse nav-right">
        <ul class="nav navbar-nav main-navbar-nav">
          <li><a href="<?= base_url() ?>">Beranda</a></li>
          <li><a class="nav-link js-scroll-trigger" href="<?= base_url('/#fitur') ?>">Fitur</a></li>
          <li><a class="nav-link js-scroll-trigger" href="<?= base_url('/#themes') ?>">Undangan Website</a></li>
          <li><a class="nav-link js-scroll-trigger" href="<?= base_url('/#themes_video') ?>">Undangan Video</a></li>
          <li>
            <a class="btn sw-button btn-publish btn-login" href="<?= base_url('login') ?>">
              <i class="fa fa-user"></i> Login
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>
