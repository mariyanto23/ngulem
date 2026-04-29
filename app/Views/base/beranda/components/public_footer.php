<?php
use App\Models\base\BerandaModel;

$publicSetting = $setting ?? null;
if (empty($publicSetting)) {
    $publicSetting = (new BerandaModel())->get_setting();
}
$publicSettingRow = is_array($publicSetting) && isset($publicSetting[0]) ? $publicSetting[0] : null;
?>
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
                <img class="img-responsive" src="<?= base_url('assets/base/img/logo4.png') ?>" style="max-height:80px" alt="<?= SITE_NAME ?>">
                <p><?= SITE_NAME ?> adalah layanan undangan pernikahan online. Yaitu undangan yang dikemas dalam bentuk web yang praktis dan mudah untuk digunakan maupun dibagikan.</p>
              </div>
              <div class="footer-media">
                <h3>Follow Us</h3>
                <ul>
                  <li><a href="https://fb.me/ngulemind.online" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                  <li><a href="https://www.instagram.com/ngulemind.online" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 clearfix">
          <div class="footer-widget">
            <div class="title_widget"><h3>Our Pages</h3></div>
            <div class="footer_content">
              <div class="category">
                <ul>
                  <li><a href="<?= base_url('order') ?>"><i class="fa fa-angle-right"></i> Mendaftar</a></li>
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
