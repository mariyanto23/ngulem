<?php
use App\Models\base\BerandaModel;

$publicTitle = $title ?? 'Beranda';
$publicSetting = $setting ?? null;
if (empty($publicSetting)) {
    $publicSetting = (new BerandaModel())->get_setting();
}
?>
<style>
  .diulem-public-header .navbar {
    display: block !important;
    min-height: 60px;
  }

  .diulem-public-header .navbar-me.navbar-default {
    background: #fff !important;
    border: none !important;
    border-radius: 0 !important;
    margin-bottom: 0 !important;
    box-shadow: none !important;
  }

  .diulem-public-header .navbar-me > .container {
    display: block !important;
  }

  .diulem-public-header .navbar-brand {
    float: left !important;
    display: block !important;
    height: auto !important;
    margin: 0 !important;
    padding: 5px 0 !important;
  }

  .diulem-public-header .navbar-brand img {
    display: block;
    height: 50px;
    width: auto;
  }

  .diulem-public-header .nav-right {
    float: right !important;
  }

  .diulem-public-header .navbar-nav {
    float: left !important;
    display: block;
    margin: 8px 0 !important;
  }

  .diulem-public-header .navbar-nav > li {
    float: left;
  }

  .diulem-public-header .navbar-nav > li > a {
    display: block !important;
    color: #333333 !important;
    background: transparent !important;
  }

  .diulem-public-header .navbar-nav > li > a:hover,
  .diulem-public-header .navbar-nav > li > a:focus,
  .diulem-public-header .navbar-nav > .active > a,
  .diulem-public-header .navbar-nav > .active > a:hover,
  .diulem-public-header .navbar-nav > .active > a:focus {
    color: #4bb9e3 !important;
    background: transparent !important;
  }

  .diulem-public-header .navbar-nav a.btn-publish {
    color: #ffffff !important;
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
    .diulem-public-header .navbar-brand {
      float: left !important;
    }

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

    .diulem-public-header .navbar-nav > li > a {
      color: #333333 !important;
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
