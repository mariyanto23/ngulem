<?php
use App\Models\base\BerandaModel;

$publicSetting = $setting ?? null;
if (empty($publicSetting)) {
    $publicSetting = (new BerandaModel())->get_setting();
}
$publicSettingRow = is_array($publicSetting) && isset($publicSetting[0]) ? $publicSetting[0] : null;
$publicLogoFile = 'assets/base/img/logo.png';
$publicLogoUrl = base_url($publicLogoFile) . '?v=' . (@filemtime(FCPATH . $publicLogoFile) ?: time());
$publicSocialLinks = [];
if ($publicSettingRow) {
    $socialCandidates = [
        'Facebook' => ['url' => $publicSettingRow->social_facebook ?? '', 'icon' => 'fa-facebook'],
        'Instagram' => ['url' => $publicSettingRow->social_instagram ?? '', 'icon' => 'fa-instagram'],
        'YouTube' => ['url' => $publicSettingRow->social_youtube ?? '', 'icon' => 'fa-youtube-play'],
        'TikTok' => ['url' => $publicSettingRow->social_tiktok ?? '', 'icon' => 'fa-music'],
    ];

    foreach ($socialCandidates as $label => $item) {
        if (trim((string) $item['url']) !== '') {
            $publicSocialLinks[$label] = $item;
        }
    }
}
?>
<style>
  .diulem-public-footer .navbar-footer,
  .diulem-public-footer footer,
  .diulem-public-footer .copyright,
  .diulem-public-footer #show_chat_to_top {
    font-family: inherit;
  }

  .diulem-public-footer .navbar-footer ul {
    margin: 0;
    padding: 0;
    list-style: none;
  }

  .diulem-public-footer .navbar-footer li {
    list-style: none;
  }

  .diulem-public-footer .footer-widget,
  .diulem-public-footer .footer_content,
  .diulem-public-footer .about-us,
  .diulem-public-footer .footer-media,
  .diulem-public-footer .title_widget,
  .diulem-public-footer .category,
  .diulem-public-footer .address {
    float: none;
  }

  .diulem-public-footer .footer-media ul,
  .diulem-public-footer .category ul,
  .diulem-public-footer .address {
    margin: 0;
    padding: 0;
    list-style: none;
  }

  .diulem-public-footer .footer-media li,
  .diulem-public-footer .category li,
  .diulem-public-footer .address li {
    list-style: none;
  }

  .diulem-public-footer .address li span,
  .diulem-public-footer .category li a,
  .diulem-public-footer .footer-media li a {
    display: inline-block;
  }

  .diulem-public-footer .diulem-social-list {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 12px !important;
  }

  .diulem-public-footer .diulem-social-list li {
    margin: 0;
  }

  .diulem-public-footer .diulem-social-link {
    display: inline-flex !important;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.12);
    border: 1px solid rgba(255, 255, 255, 0.16);
    color: #ffffff !important;
    font-size: 16px;
    transition: transform .2s ease, background .2s ease, border-color .2s ease;
  }

  .diulem-public-footer .diulem-social-link:hover,
  .diulem-public-footer .diulem-social-link:focus {
    transform: translateY(-2px);
    background: #14b8a6;
    border-color: #14b8a6;
    color: #ffffff !important;
    text-decoration: none;
  }

  .diulem-public-footer .copyright p {
    display: block;
    width: 100%;
    margin-bottom: 0;
    text-align: center;
  }

  .diulem-public-footer .copyright .row {
    display: block;
    text-align: center;
  }
</style>
<div class="diulem-public-footer">
<div class="navbar-footer text-center">
  <ul>
    <li><a href="<?= base_url() ?>"><i class="fa fa-home"></i><p>Home</p></a></li>
    <li><a href="<?= base_url('tema') ?>"><i class="fa fa-globe"></i><p>Tema Web</p></a></li>
    <li><a href="<?= base_url('tema_video') ?>"><i class="fa fa-youtube-play"></i><p>Tema Video</p></a></li>
  </ul>
</div>

<footer>
  <div class="waves-effect top" style="background: url('<?= base_url('assets/beranda/themes/img/waves-top.png') ?>');"></div>
  <div class="waves-effect bottom" style="background: url('<?= base_url('assets/beranda/themes/img/waves-bottom.png') ?>');"></div>
  <div class="container">
    <div class="row">
      <div class="footer-widget">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 clearfix">
          <div class="footer-widget">
            <div class="footer_content">
              <div class="about-us">
                <img class="img-responsive" src="<?= $publicLogoUrl ?>" style="max-height:80px" alt="<?= SITE_NAME ?>">
                <p><?= SITE_NAME ?> adalah layanan undangan pernikahan online. Yaitu undangan yang dikemas dalam bentuk web yang praktis dan mudah untuk digunakan maupun dibagikan.</p>
              </div>
              <?php if (!empty($publicSocialLinks)) { ?>
              <div class="footer-media">
                <h3>Follow Us</h3>
                <ul class="diulem-social-list">
                  <?php foreach ($publicSocialLinks as $socialLabel => $socialItem) { ?>
                  <li>
                    <a class="diulem-social-link" href="<?= esc($socialItem['url']) ?>" target="_blank" rel="noopener noreferrer" aria-label="<?= esc($socialLabel) ?>" title="<?= esc($socialLabel) ?>">
                      <i class="fa <?= esc($socialItem['icon']) ?>" aria-hidden="true"></i>
                    </a>
                  </li>
                  <?php } ?>
                </ul>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 clearfix">
          <div class="footer-widget">
            <div class="title_widget"><h3>Our Pages</h3></div>
            <div class="footer_content">
              <div class="category">
                <ul>
                  <li><a href="<?= base_url('tema') ?>"><i class="fa fa-angle-right"></i> Pilih Tema</a></li>
                  <li><a href="<?= base_url('tema') ?>"><i class="fa fa-angle-right"></i> Undangan Website</a></li>
                  <li><a href="<?= base_url('tema_video') ?>"><i class="fa fa-angle-right"></i> Undangan Video</a></li>
                  <li><a href="<?= base_url('syarat-ketentuan') ?>"><i class="fa fa-angle-right"></i> Syarat & Ketentuan</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 clearfix">
          <div class="footer-widget">
            <div class="title_widget"><h3>Informasi</h3></div>
            <div class="footer_content">
              <ul class="address">
                <?php if ($publicSettingRow) { ?>
                <li>
                  <i class="fa fa-phone"></i>
                  <span>Phone: <?= esc($publicSettingRow->no_wa) ?></span>
                </li>
                <li>
                  <i class="fa fa-envelope-o"></i>
                  <span><a href="mailto:<?= esc($publicSettingRow->email) ?>">Email: <?= esc($publicSettingRow->email) ?></a></span>
                </li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="copyright">
    <div class="container">
      <div class="row text-center">
        <p>Copyright &#169; <?= date('Y') ?> <?= SITE_NAME ?>. All Rights Reserved</p>
      </div>
    </div>
  </div>
</footer>

<?php if ($publicSettingRow) { ?>
<div id="show_chat_to_top">
  <a href="https://api.whatsapp.com/send?phone=<?= esc($publicSettingRow->no_wa) ?>&text=<?= esc($publicSettingRow->pesan_wa) ?>" target="_blank" class="live_chat" data-toggle="tooltip" data-placement="top" title="Hubungi Kami"><i class="fa fa-comment-o fa-lg"></i></a>
  <a href="#" id="back-to-top" data-toggle="tooltip" data-placement="top" title="Back to top">↑</a>
</div>
<?php } ?>
</div>
