<?php
use App\Models\base\BerandaModel;

$publicTitle = $title ?? 'Beranda';
$publicSetting = $setting ?? null;
if (empty($publicSetting)) {
    $publicSetting = (new BerandaModel())->get_setting();
}
$publicLogoFile = 'assets/base/img/logo.png';
$publicLogoUrl = base_url($publicLogoFile) . '?v=' . (@filemtime(FCPATH . $publicLogoFile) ?: time());
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

  .diulem-public-header .navbar-nav > li > a.btn-publish,
  .diulem-public-header .navbar-nav > li > a.btn-login {
    color: #ffffff !important;
    background: #4bb9e3 !important;
    background-image: linear-gradient(45deg, #599fe6 0%, #52ecf0 70%) !important;
    border: 0 !important;
    border-radius: 30px !important;
    padding: 8px 20px !important;
    margin-top: 8px !important;
  }

  .diulem-public-header .navbar-nav > li > a.btn-publish:hover,
  .diulem-public-header .navbar-nav > li > a.btn-publish:focus,
  .diulem-public-header .navbar-nav > li > a.btn-login:hover,
  .diulem-public-header .navbar-nav > li > a.btn-login:focus {
    color: #ffffff !important;
    background: #4bb9e3 !important;
    background-image: linear-gradient(45deg, #9ae7ff 0%, #a5caf2 99%, #c4dafa 100%) !important;
  }

  .diulem-public-header .navbar-collapse.collapse {
    display: block !important;
    height: auto !important;
    padding-bottom: 0;
    overflow: visible !important;
  }

  .diulem-public-header .navbar-toggle {
    display: none;
    border: 0;
    border-radius: 10px;
    margin: 13px 12px 0 0;
    padding: 9px 8px;
    background: rgba(75, 185, 227, 0.10);
    transition: background .2s ease, box-shadow .2s ease;
  }

  .diulem-public-header .navbar-toggle:hover,
  .diulem-public-header .navbar-toggle:focus {
    background: rgba(75, 185, 227, 0.16);
    box-shadow: none;
  }

  .diulem-public-header .diulem-burger-line {
    display: block;
    width: 22px;
    height: 2px;
    margin: 4px 0;
    border-radius: 999px;
    background: #0f766e;
    transform-origin: center;
    transition: transform .24s ease, opacity .18s ease, background .2s ease;
  }

  .diulem-public-header .navbar-toggle:not(.collapsed) .diulem-burger-line:nth-child(2) {
    transform: translateY(6px) rotate(45deg);
  }

  .diulem-public-header .navbar-toggle:not(.collapsed) .diulem-burger-line:nth-child(3) {
    opacity: 0;
  }

  .diulem-public-header .navbar-toggle:not(.collapsed) .diulem-burger-line:nth-child(4) {
    transform: translateY(-6px) rotate(-45deg);
  }

  @media (max-width: 767px) {
    .diulem-public-header .navbar-me > .container {
      padding-left: 15px;
      padding-right: 15px;
    }

    .diulem-public-header .navbar-brand {
      float: left !important;
    }

    .diulem-public-header .navbar-toggle {
      display: block;
      float: left !important;
    }

    .diulem-public-header .navbar-collapse.collapse {
      display: none !important;
      clear: both;
      width: 100%;
      margin: 0;
      padding-left: 0;
      padding-right: 0;
    }

    .diulem-public-header .navbar-collapse.collapse.in {
      display: block !important;
    }

    .diulem-public-header .navbar-nav {
      float: none !important;
      text-align: left;
      margin: 10px 0 14px !important;
    }

    .diulem-public-header .navbar-nav > li {
      float: none;
    }

    .diulem-public-header .nav-right {
      float: none !important;
    }

    .diulem-public-header .navbar-nav > li > a {
      color: #333333 !important;
      text-align: left;
    }
  }
</style>
<header class="header diulem-public-header">
  <nav class="navbar-me navbar navbar-default" id="mainNav">
    <div class="container">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#diulemPublicNav" aria-controls="diulemPublicNav" aria-expanded="false">
        <span class="sr-only">Toggle Navigation</span>
        <span class="diulem-burger-line"></span>
        <span class="diulem-burger-line"></span>
        <span class="diulem-burger-line"></span>
      </button>
      <a class="navbar-brand pull-left" href="<?= base_url() ?>" title="<?= SITE_NAME ?>">
        <img class="img-responsive" src="<?= $publicLogoUrl ?>" alt="<?= SITE_NAME ?>">
      </a>
      <div class="collapse navbar-collapse navbar-ex1-collapse nav-right" id="diulemPublicNav">
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
<script>
  document.addEventListener('click', function (event) {
    var toggle = event.target.closest('.diulem-public-header .navbar-toggle');
    if (!toggle) {
      return;
    }

    var target = document.querySelector(toggle.getAttribute('data-target'));
    if (!target) {
      return;
    }

    event.preventDefault();
    event.stopPropagation();

    var isOpen = target.classList.toggle('in');
    toggle.classList.toggle('collapsed', !isOpen);
    toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
  }, true);
</script>
