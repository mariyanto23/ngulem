
    <style>
      .diulem-hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        min-height: 34px;
        padding: 0 14px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.14);
        border: 1px solid rgba(255, 255, 255, 0.26);
        color: #fff;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: .04em;
        text-transform: uppercase;
        margin-bottom: 14px;
      }

      .diulem-hero-stats {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 22px;
      }

      .diulem-hero-stat {
        min-width: 128px;
        padding: 12px 14px;
        border-radius: 14px;
        background: rgba(10, 16, 27, 0.34);
        border: 1px solid rgba(255, 255, 255, 0.14);
        color: #fff;
      }

      .diulem-hero-stat strong {
        display: block;
        font-size: 18px;
        line-height: 1.2;
        margin-bottom: 4px;
      }

      .diulem-hero-stat span {
        display: block;
        font-size: 12px;
        line-height: 1.5;
        opacity: .82;
      }

      .pricing .area-title p {
        max-width: 680px;
        margin: 12px auto 0;
        color: #6b7a85;
        line-height: 1.8;
      }

      .pricing-panel {
        border-radius: 18px;
        border: 1px solid #e9efee;
        box-shadow: 0 18px 44px rgba(15, 23, 42, 0.08);
        overflow: hidden;
        background: #fff;
        transition: transform .25s ease, box-shadow .25s ease;
      }

      .pricing-panel:hover {
        transform: translateY(-4px);
        box-shadow: 0 22px 54px rgba(15, 23, 42, 0.12);
      }

      .pricing-panel.diulem-pricing-featured {
        border-color: rgba(15, 118, 110, 0.24);
        box-shadow: 0 24px 60px rgba(15, 118, 110, 0.14);
      }

      .diulem-pricing-ribbon {
        display: inline-flex;
        align-items: center;
        min-height: 28px;
        padding: 0 12px;
        border-radius: 999px;
        background: rgba(15, 118, 110, 0.1);
        color: #0f766e;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .04em;
        text-transform: uppercase;
        margin-bottom: 12px;
      }

      .pricing-head {
        padding: 28px 28px 18px;
      }

      .pricing-name {
        font-size: 24px;
        letter-spacing: 0;
      }

      .pricing-type .price {
        font-size: 34px;
        line-height: 1.2;
      }

      .pricing-type .per {
        margin-top: 6px;
        color: #6b7a85;
      }

      .diulem-pricing-note {
        margin-top: 10px;
        color: #6b7a85;
        font-size: 14px;
        line-height: 1.7;
      }

      .pricing-body {
        padding: 0 28px 28px;
      }

      .pricing-list > li {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 0;
        border-top: 1px solid #f0f4f3;
        color: #22343b;
      }

      .pricing-list > li:before {
        content: "";
        width: 9px;
        height: 9px;
        border-radius: 999px;
        background: #14b8a6;
        flex: 0 0 auto;
      }

      .pricing-list > li.diulem-feature-off {
        color: #94a3b8;
        text-decoration: line-through;
        text-decoration-thickness: 2px;
      }

      .pricing-list > li.diulem-feature-off:before {
        background: #cbd5e1;
      }

      .pricing-body .btn {
        margin-top: 18px;
      }

      .diulem-pricing-cta-note {
        margin-top: 12px;
        color: #6b7a85;
        font-size: 13px;
        line-height: 1.6;
      }

      .diulem-theme-note {
        max-width: 720px;
        margin: 14px auto 0;
        color: #6b7a85;
        line-height: 1.8;
      }

      .diulem-testimonial-card {
        padding: 18px 18px 10px;
        border-radius: 18px;
        background: rgba(255, 255, 255, 0.96);
        box-shadow: 0 18px 42px rgba(15, 23, 42, 0.08);
      }

      .diulem-testimonial-avatar {
        width: 84px !important;
        height: 84px !important;
        object-fit: cover;
        margin: 0 auto 16px;
        border: 4px solid rgba(15, 118, 110, 0.12);
      }

      .diulem-testimonial-card h3 {
        margin-bottom: 10px;
      }

      .diulem-testimonial-quote {
        color: #435560;
        line-height: 1.8;
        min-height: 96px;
      }

      .diulem-testimonial-location {
        color: #6b7a85;
        font-size: 13px;
        font-weight: 600;
      }

      .diulem-partner-shell {
        margin-top: 12px;
        padding: 26px 22px;
        border-radius: 20px;
        background: #fff;
        box-shadow: 0 18px 44px rgba(15, 23, 42, 0.08);
      }

      .diulem-partner-shell h2 {
        margin-bottom: 8px;
      }

      .diulem-partner-note {
        max-width: 640px;
        margin: 0 auto 18px;
        color: #6b7a85;
        line-height: 1.8;
      }

      .media-partner-img {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 110px;
        padding: 16px;
        border-radius: 16px;
        background: #f8fbfd;
        border: 1px solid #edf2f2;
      }

      .media-partner-img img {
        max-width: 160px;
        max-height: 52px;
        width: auto !important;
      }

      .diulem-public-cta {
        padding: 0 0 56px;
      }

      .diulem-public-cta-card {
        padding: 28px 26px;
        border-radius: 24px;
        background: linear-gradient(135deg, #0f766e, #14b8a6);
        box-shadow: 0 24px 56px rgba(15, 118, 110, 0.22);
        color: #fff;
        text-align: center;
      }

      .diulem-public-cta-card h2 {
        color: #fff;
        margin-bottom: 10px;
      }

      .diulem-public-cta-card p {
        max-width: 620px;
        margin: 0 auto 18px;
        line-height: 1.8;
        opacity: .92;
      }

      .diulem-public-cta-card .btn {
        min-width: 180px;
      }

      @media (max-width: 767px) {
        .slider-1 .content-slider {
          padding-top: 78px;
          padding-bottom: 70px;
        }

        .slider-1 .content-slider .col-xs-8 {
          width: 100%;
        }

        .slider-1 .content-slider h3 {
          font-size: 30px;
          line-height: 1.2;
        }

        .slider-1 .content-slider p {
          font-size: 15px;
          line-height: 1.7;
        }

        .diulem-hero-stats {
          gap: 10px;
        }

        .diulem-hero-stat {
          min-width: calc(50% - 5px);
        }

        .pricing-head,
        .pricing-body {
          padding-left: 22px;
          padding-right: 22px;
        }

        .pricing .col-12.col-lg-4 {
          margin-bottom: 20px;
        }

        .diulem-testimonial-card {
          padding: 16px 16px 8px;
        }

        .diulem-testimonial-quote {
          min-height: 0;
          font-size: 14px;
        }

        .diulem-partner-shell {
          padding: 22px 18px;
        }

        .media-partner-img {
          min-height: 92px;
        }

        .diulem-public-cta {
          padding-bottom: 40px;
        }

        .diulem-public-cta-card {
          padding: 24px 18px;
          border-radius: 20px;
        }

        .diulem-public-cta-card .btn {
          width: 100%;
        }
      }
    </style>

    <section class="slider-1">
      <div id="carousel-id-slider" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carousel-id" class="active" data-slide-to="0" class="">
          </li>
          <li data-target="#carousel-id" data-slide-to="1" class="">
          </li>
        </ol>
        <div class="carousel-inner">
          <div class="item active">
            <img src="<?php echo base_url() ?>/assets/beranda/themes/slider/sw-kalaujodoh-slider-1.jpg" alt="Undangan Online | Unik, Murah, Modern">
            <div class="container">
              <div class="content-slider">
                <div class="row">
                  <div class="col-xs-8 col-sm-8 col-md-6 col-lg-6">
                    <div class="diulem-hero-badge"><?= esc($homeText('hero', 'slide1_badge')) ?></div>
                    <h3><?= esc($homeText('hero', 'slide1_title')) ?>
                    </h3>
                    <p><?= esc($homeText('hero', 'slide1_description')) ?>
                    </p>
                    <a href="<?= base_url() ?>/tema" class="btn sw-button btn-slider"><?= esc($homeText('hero', 'slide1_button')) ?>
                    </a>
                    <div class="diulem-hero-stats">
                      <div class="diulem-hero-stat">
                        <strong><?= esc($homeText('hero', 'stat1_title')) ?></strong>
                        <span><?= esc($homeText('hero', 'stat1_description')) ?></span>
                      </div>
                      <div class="diulem-hero-stat">
                        <strong><?= esc($homeText('hero', 'stat2_title')) ?></strong>
                        <span><?= esc($homeText('hero', 'stat2_description')) ?></span>
                      </div>
                      <div class="diulem-hero-stat">
                        <strong><?= esc($homeText('hero', 'stat3_title')) ?></strong>
                        <span><?= esc($homeText('hero', 'stat3_description')) ?></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="item">
            <img src="<?php echo base_url() ?>/assets/beranda/themes/slider/sw-kalaujodoh-slider-2.jpg" alt="Undangan Online | Unik, Murah, Modern">
            <div class="container">
              <div class="content-slider">
                <div class="row">
                  <div class="col-xs-8 col-sm-8 col-md-6 col-lg-6">
                    <div class="diulem-hero-badge"><?= esc($homeText('hero', 'slide2_badge')) ?></div>
                    <h3><?= esc($homeText('hero', 'slide2_title')) ?>
                    </h3>
                    <p><?= esc($homeText('hero', 'slide2_description')) ?>
                    </p>
                    <a href="<?= base_url() ?>/tema" class="btn sw-button btn-slider"><?= esc($homeText('hero', 'slide2_button')) ?>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <a class="left carousel-control" href="#carousel-id-slider" data-slide="prev">
          <span class="icon-prev">
          </span>
        </a>
        <a class="right carousel-control" href="#carousel-id-slider" data-slide="next">
          <span class="icon-next">
          </span>
        </a>
      </div>
    </section>
    <!-- SERVICE -->
    <section class="sw-container sw-img-1">
      <div class="container">
        <div class="row">
          <div class="area-title text-center">
            <h2><?= esc($homeText('benefits', 'title_prefix')) ?>
              <span><?= esc($homeText('benefits', 'title_highlight')) ?>
              </span> <?= esc($homeText('benefits', 'title_suffix')) ?>
            </h2>
            <div class="title_border">
            </div>
            <p><?= esc($homeText('benefits', 'description')) ?>
            </p>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="services-box-2">
              <div class="icon">
                <img src="<?php echo base_url() ?>/assets/beranda/themes/img/dollar.png" class="img-responsive">
              </div>
              <div class="services-title">
                <h4><?= esc($homeText('benefits', 'item1_title')) ?>
                </h4>
              </div>
              <p><?= esc($homeText('benefits', 'item1_description')) ?>
              </p>
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="services-box-2">
              <div class="icon">
                <img src="<?php echo base_url() ?>/assets/beranda/themes/img/domain.png" class="img-responsive">
              </div>
              <div class="services-title">
                <h4><?= esc($homeText('benefits', 'item2_title')) ?>
                </h4>
              </div>
              <p><?= esc($homeText('benefits', 'item2_description')) ?>
              </p>
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="services-box-2">
              <div class="icon">
                <img src="<?php echo base_url() ?>/assets/beranda/themes/img/social-media.png" class="img-responsive">
              </div>
              <div class="services-title">
                <h4><?= esc($homeText('benefits', 'item3_title')) ?>
                </h4>
              </div>
              <p><?= esc($homeText('benefits', 'item3_description')) ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- SERVICE -->
    <section class="sw-container" id="fitur">
      <div id="particle-container">
      </div>
      <div class="container">
        <div class="row ">
          <div class="area-title text-center">
            <h2><?= esc($homeText('features', 'title_prefix')) ?>
              <span><?= esc($homeText('features', 'title_highlight')) ?>
              </span> <?= esc($homeText('features', 'title_suffix')) ?>
            </h2>
            <div class="title_border">
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <div class="services-box">
              <div class="services-title">
                <i class="flaticon-web-design">
                </i>
                <h4><?= esc($homeText('features', 'item1_title')) ?>
                </h4>
              </div>
              <p><?= esc($homeText('features', 'item1_description')) ?>
              </p>             
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <div class="services-box">
              <div class="services-title">
                <i class="flaticon-book">
                </i>
                <h4><?= esc($homeText('features', 'item2_title')) ?>
                </h4>
              </div>
              <p><?= esc($homeText('features', 'item2_description')) ?>
              </p>             
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <div class="services-box">
              <div class="services-title">
                <i class="flaticon-rings">
                </i>
                <h4><?= esc($homeText('features', 'item3_title')) ?>
                </h4>
              </div>
              <p><?= esc($homeText('features', 'item3_description')) ?>
              </p>             
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <div class="services-box">
              <div class="services-title">
                <i class="flaticon-clothes">
                </i>
                <h4><?= esc($homeText('features', 'item4_title')) ?>
                </h4>
              </div>
              <p><?= esc($homeText('features', 'item4_description')) ?>
              </p>             
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <div class="services-box">
              <div class="services-title">
                <i class="flaticon-camera">
                </i>
                <h4><?= esc($homeText('features', 'item5_title')) ?>
                </h4>
              </div>
              <p><?= esc($homeText('features', 'item5_description')) ?>
              </p>             
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <div class="services-box">
              <div class="services-title">
                <i class="flaticon-notebook">
                </i>
                <h4><?= esc($homeText('features', 'item6_title')) ?>
                </h4>
              </div>
              <p><?= esc($homeText('features', 'item6_description')) ?>
              </p>             
            </div>
          </div>
        </div>
      </div>
    </section> 
    <!-- 
      Pricing Table Section
      =============================================  
      -->
      <section class="pricing bg-clouds-red" id="pricing">
        <div class="container">
          <div class="row clearfix">
            <div class="area-title text-center">
                <h2><?= esc($homeText('sections', 'pricing_title_prefix')) ?><span><?= esc($homeText('sections', 'pricing_title_highlight')) ?></span> <?= esc($homeText('sections', 'pricing_title_suffix')) ?></h2>
                <div class="title_border"></div>
                <p><?= esc($homeText('sections', 'pricing_description')) ?></p>
            </div>
            <!-- End .col-lg-6  -->
          </div>
          <div class="pricing-container">
            <div class="row">
                <?php foreach($paket as $data){ ?>
              <!-- Start Pricing Packge #1 -->
              <div class="col-12 col-lg-4">
                <div class="pricing-panel <?= (int) $data->harga_paket <= 0 ? 'diulem-pricing-featured' : '' ?>">
                  <!--  Pricing heading   -->
                  <div class="pricing-head">
                    <?php if ((int) $data->harga_paket <= 0) { ?>
                      <div class="diulem-pricing-ribbon">Mulai Gratis</div>
                    <?php } ?>
                    <h6 class="pricing-name">
                      <?= strtoupper($data->nama_paket) ?>
                      <?php if ((int) $data->harga_paket <= 0) { ?>
                        <span class="label-coral" style="margin-left:8px;">GRATIS</span>
                      <?php } ?>
                    </h6>
                    <div class="pricing-type">
                      <p class="price"><?= (int) $data->harga_paket <= 0 ? 'Gratis' : 'Rp. ' . number_format($data->harga_paket) ?></p>
                      <p class="per">Aktif <?= $data->masa_aktif ?> Hari</p>
                    </div>
                    <p class="diulem-pricing-note">
                      <?= (int) $data->harga_paket <= 0 ? 'Cocok untuk mulai dulu, lalu upgrade saat sudah siap.' : 'Paket siap pakai untuk undangan yang lebih lengkap dan fleksibel.' ?>
                    </p>
                  </div>
                  <!--  Pricing body-->
                  <div class="pricing-body">
                    <ul class="pricing-list list-unstyled">
                      <?php if($data->tema_bebas == 0) { ?><li>Hanya 1 Tema</li> <?php } else { ?>
                      <li>Bebas Pilih Tema</li> <?php } ?>
                      <li>Edit Tanpa Batas</li>
                      <li class="<?= $data->kirim_whatsapp != 1 ? 'diulem-feature-off' : '' ?>">Kirim Undangan</li>
                      <li class="<?= $data->import_datatamu != 1 ? 'diulem-feature-off' : '' ?>">Import Data Tamu</li>
                      <li class="<?= $data->buku_tamu != 1 ? 'diulem-feature-off' : '' ?>">Buku Tamu</li>
                      <li class="<?= $data->kirim_hadiah != 1 ? 'diulem-feature-off' : '' ?>">Amplop Digital</li>
                      <li>Galeri Foto</li>
                      <li>Background Music</li>
                      
                    </ul><a class="btn btn--bordered btn--primary" href="<?= base_url() ?>/tema"><?= (int) $data->harga_paket <= 0 ? 'Pilih Tema Gratis' : 'Pilih Tema' ?></a>
                    <p class="diulem-pricing-cta-note"><?= (int) $data->harga_paket <= 0 ? 'Pilih tema dulu, lalu lanjut daftar tanpa pembayaran.' : 'Pilih tema dulu, lalu lanjut isi data order.' ?></p>
                  </div>
                </div>
              </div>
              <?php } ?>
              <!-- End .pricing-table  -->
             </div>
          </div>
          <!-- End .pricing-container-->
        </div>
        <!-- End .container-->
      </section>
    <!-- THEME -->
    <section class="sw-container" id="themes" style="background:#F8FBFD">
      <div class="container">
        <div class="row text-center">
          <div class="area-title text-center">
            <h2><?= esc($homeText('sections', 'theme_title')) ?>
            </h2>
            <div class="title_border"></div>
            <p><?= esc($homeText('sections', 'theme_description')) ?>
              <br><?= esc($homeText('sections', 'theme_description_second')) ?>
            </p>
            <p class="diulem-theme-note"><?= esc($homeText('sections', 'theme_note')) ?></p>
          </div>
<?php
$homeContentDefaults = [
  'hero' => [
    'slide1_badge' => 'Undangan Website Praktis',
    'slide1_title' => 'Berbagi undangan menjadi lebih mudah',
    'slide1_description' => 'Buat dan bagikan undangan pernikahan kamu dengan berbagai pilihan tampilan undangan yang elegan dan menarik, buat pernikahan kamu berkesan.',
    'slide1_button' => 'Pilih Tema Gratis',
    'stat1_title' => 'Gratis',
    'stat1_description' => 'Mulai tanpa bayar dulu',
    'stat2_title' => 'Siap Cepat',
    'stat2_description' => 'Undangan dasar langsung aktif',
    'stat3_title' => 'Fleksibel',
    'stat3_description' => 'Edit kapan saja dari dashboard',
    'slide2_badge' => 'Tema Elegan & Modern',
    'slide2_title' => strtoupper(DOMAIN_UTAMA) . ' - Digital Invitation Indonesia',
    'slide2_description' => 'Solusi pernikahan lebih hemat, praktis, dan kekinian dengan e-invitation yang disebar otomatis untuk memberikan kesan terbaik',
    'slide2_button' => 'Pilih Tema Sekarang',
  ],
  'benefits' => [
    'title_prefix' => 'Mengapa',
    'title_highlight' => 'Undangan',
    'title_suffix' => 'Digital?',
    'description' => 'Apa saja keuntungan menggunakan undangan digital berbasis website',
    'item1_title' => 'Mudah, Cepat & Murah',
    'item1_description' => 'Gak perlu nunggu lama membuat undangan, dan kamu juga sudah bisa bikin undangan online dengan harga termurah.',
    'item2_title' => 'Mudah Menentukan Domain',
    'item2_description' => 'Mudah membuat URL unik untuk website undangan kamu, dengan menggunakan kata-kata sesuai dengan keinginan kamu',
    'item3_title' => 'Sebarkan Undangan kamu',
    'item3_description' => 'Jangkau tamu undangan lebih banyak, kamu dapat membagikan di mana dan kapan saja dengan mudahnya kamu share di social media',
  ],
  'features' => [
    'title_prefix' => 'Apa Yang',
    'title_highlight' => 'Kamu',
    'title_suffix' => 'Dapat?',
    'item1_title' => 'Tema yang Menarik & Eksklusif',
    'item1_description' => 'Kau dapat menyeseuaikan tema pernikahan kamu dengan pilihan tema yang unik dan exlusif yang kami sediakan',
    'item2_title' => 'Story',
    'item2_description' => 'Kamu bisa cerita bagaimana cerita kalian bisa bertemu hingga melanjutkan ke jenjang pernikahan',
    'item3_title' => 'Waktu Akad dan Resepsi',
    'item3_description' => 'Kamu dapat memberikan Informasi yang pastinya penting dalam pesta pernikahan, yaitu waktu dan lokasi resepsi',
    'item4_title' => 'Informasi Kedua Pasangan',
    'item4_description' => 'Kamu dapat menginformasikan tentang diri kamu dan pasangan yang kamu cintai disertai dengan foto kamu dan pasangan kamu.',
    'item5_title' => 'Gallery Pra Wedding',
    'item5_description' => 'Dengan fitur gallery tentunya pra wedding kalian bisa diupload foto-foto kenangan kalian dan ditampilkan di website undangan kalian.',
    'item6_title' => 'Buku Tamu',
    'item6_description' => 'Di fitur ini bisa kamu gunakan sebagai pengganti buku untuk mencatat kehadiran tamu serta foto selfie tamu yang hadir',
  ],
  'sections' => [
    'pricing_title_prefix' => 'Harga',
    'pricing_title_highlight' => 'Undangan',
    'pricing_title_suffix' => 'Online?',
    'pricing_description' => 'Pilih paket yang paling pas untuk kebutuhan acara kamu. Semua paket bisa dikelola dari dashboard yang sama, dan paket gratis bisa langsung dicoba tanpa pembayaran.',
    'theme_title' => 'Pilihan Tema Undangan',
    'theme_description' => 'Kamu penasaran bagaimana jadinya? Pilih salah satu untuk melihat demonya',
    'theme_description_second' => 'selain itu ' . SITE_NAME . ' banyak pilihan tema undangan digital yang menarik dan eksklusif',
    'theme_note' => 'Mulai dari demo dulu, lalu pilih paket yang paling sesuai. Semua tema tetap bisa dilanjutkan ke proses order yang sama.',
    'video_title_prefix' => 'Undangan',
    'video_title_highlight' => 'Video',
    'process_title_prefix' => 'Bagaimana',
    'process_title_highlight' => 'Cara',
    'process_title_suffix' => 'Mendaftar?',
    'testimonial_title_prefix' => 'Apa',
    'testimonial_title_highlight' => 'Kata',
    'testimonial_title_suffix' => 'Mereka?',
    'testimonial_description' => 'Telah membantu pengantin untuk menjadikan undangan pernikahan mereka menjadi lebih berkesan',
    'partner_title' => 'Media Partner',
    'partner_note' => 'Mendukung proses pembayaran dan operasional undangan digital agar tetap praktis, aman, dan mudah dipakai.',
    'final_cta_title' => 'Siap Mulai Buat Undangan?',
    'final_cta_description' => 'Mulai dari paket gratis dulu, pilih tema yang paling cocok, lalu lengkapi detailnya dari dashboard kapan saja.',
    'final_cta_button' => 'Pilih Tema Sekarang',
  ],
  'process' => [
    'step1_title' => 'Pilih Tema',
    'step1_description' => 'Kamu bebas memilih tema yang sesuai dengan tema pernikahan kamu',
    'step2_title' => 'Mendaftar',
    'step2_description' => 'Daftar dengan email, isi data pernikahan kamu, lalu masuk ke dashboard untuk mengedit dan menyelesaikan pembayaran.',
    'step3_title' => 'Aktivasi',
    'step3_detail_title' => 'Aktivasi Undangan kamu',
    'step3_description' => 'Pilih menu tagihan atau invoice, lalu lakukan aktivasi paket untuk mengaktifkan fitur undangan kamu.',
    'step4_title' => 'Undangan Aktif',
    'step4_description' => 'Kamu sudah bisa mengubah, melengkapi, lalu menyebarkan undangan pernikahanmu kapan saja.',
  ],
];
$homeContentRaw = $setting[0]->home_content ?? '';
$homeContentDecoded = ! empty($homeContentRaw) ? json_decode((string) $homeContentRaw, true) : [];
$homeContent = is_array($homeContentDecoded) ? array_replace_recursive($homeContentDefaults, $homeContentDecoded) : $homeContentDefaults;
$homeText = static function (string $group, string $key) use ($homeContent): string {
  return (string) ($homeContent[$group][$key] ?? '');
};
?>
<?php
            $no = 1;
            foreach ($tema->getResult() as $row) { ?>
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <div class="sw-theme">
              <figure>
                <ul class="attribute-list"><li><span class="label-coral"><?= $row->name ?></span></li></ul>
                <img src="<?= base_url() ?>/assets/themes/<?= $row->nama_theme ?>/preview.png" alt="<?= htmlentities($row->nama_theme) ?>" />
              </figure>
              <div class="desc">
                <h3><?= htmlentities($row->nama_theme) ?></h3>
                <div class="readmore">
                  <a href="<?= base_url('demo/'.$row->nama_theme) ?>" target="_blank" class="btn sw-button btn-preview">Demo
                  </a>
                  <a href="<?= base_url('order/'.$row->kode_theme) ?>" class="btn sw-button btn-shop">Buat Undangan
                  </a>
                </div>
              </div>
            </div>  
          </div>
          <?php 
             if ($no++ == 6) break;
            }  ?>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
          <h3>Lihat Lebih Banyak Template Undangan Website
            <?= SITE_NAME ?>
          </h3>
          <a href="<?= base_url() ?>/tema" class="btn sw-button btn-register-lg">Lihat Lebih Banyak
          </a>
        </div>
        </div>
      </div>
    </section>
    <section class="sw-container" id="themes_video">
      <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
                 <div class="area-title text-center">
                    <h2><?= esc($homeText('sections', 'video_title_prefix')) ?> <span><?= esc($homeText('sections', 'video_title_highlight')) ?></span></h2>
                    <div class="title_border"></div>
                 </div>
                 <div class="owl-carousel slider-undangan owl-theme">
                      <?php
                      $i = 1;
                    foreach ($tema_video->getResult() as $row) { ?>
                    <article class="sw-theme">
                        <figure>
                        <ul class="attribute-list"><li><span class="label-coral"><?= $row->name ?></span></li></ul>
                        <img src="<?php echo base_url() ?>/assets/themes_video/<?= $row->preview ?>" alt="<?= $row->nama_tema ?>" class="img-responsive"/>
                        </figure>
                      <div class="desc">
                        <h3><?= $row->nama_tema ?></h3>
                        <span class="price"><ins><span class="amount">Rp. <?= number_format($row->harga) ?></span></ins>  
                        </span>
                        <div class="readmore text-center">
                          <a class="btn sw-button btn-preview btn-demo" data-link="<?= htmlentities($row->url_video); ?>" data-nama="<?= $row->nama_tema; ?>" title="Demo Video"><i class="fa fa-eye"></i></a>
                          <a target="_blank" href="https://api.whatsapp.com/send?phone=<?= $setting[0]->no_wa; ?>&text=Assalamualaikum, Kak saya mau pesan Undangan video <?= $row->nama_tema ?>%0ABagaimana cara pesannya kak?" class="btn sw-button btn-shop-2 btn-shop btn-details" title="Pesan Sekarang"><i class="fa fa-shopping-basket"></i></a>
                        </div>
                      </div>
                    </article>
                <?php if ($i++ == 8) break; } ?>
                  </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                  <a href="<?= base_url() ?>/tema_video" class="btn sw-button btn-register-lg">Lihat Lebih Banyak</a>
                </div>
            </div>
          </div>
      </div>
</section>
<section class="sw-container sw-bg-2">
  <div class="container">
    <div class="row">
      <div class="area-title text-center">
          <h2><?= esc($homeText('sections', 'process_title_prefix')) ?> <span><?= esc($homeText('sections', 'process_title_highlight')) ?></span> <?= esc($homeText('sections', 'process_title_suffix')) ?></h2>
          <div class="title_border"></div>
      </div>
      <div class="work-process-block proces-style-two">
      <div class="process-list">
      <div class="bg-line wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1s">
        <img src="<?php echo base_url() ?>/assets/beranda/themes/img/linearrow.png"></img>
      </div>
                    
        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
            <div class="single-process wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1s">
                <div class="icon bg-zinnwaldite">
                    <span class="fa fa-hand-pointer-o"></span>
                    <h3 class="process-no">1</h3>
                </div>
                <h2 class="process-step"><?= esc($homeText('process', 'step1_title')) ?></h2>
            </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
            <div class="single-process wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1s">
                <div class="icon bg-silver-tree">
                    <span class="fa fa-address-card-o"></span>
                    <h3 class="process-no">2</h3>
                </div>
                <h2 class="process-step"><?= esc($homeText('process', 'step2_title')) ?></h2>
            </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
            <div class="single-process wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1s">
                <div class="icon bg-medium-purple">
                    <span class="fa fa-credit-card"></span>
                    <h3 class="process-no">3</h3>
                </div>
                <h2 class="process-step"><?= esc($homeText('process', 'step3_title')) ?></h2>
            </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
            <div class="single-process wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1s">
                <div class="icon bg-curious-blue">
                    <span class="fa fa-paper-plane-o"></span>
                    <h3 class="process-no">4</h3>
                </div>
                <h2 class="process-step"><?= esc($homeText('process', 'step4_title')) ?></h2>
            </div>
        </div>

      </div>
  </div>
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
          <div class="setps-content">
            <li class="setps-content-inner step1">
              <div class="step-content-number">
                  <span>1</span>
              </div>
              <div class="step-content-text">
                  <h3><?= esc($homeText('process', 'step1_title')) ?></h3>
                  <p><?= esc($homeText('process', 'step1_description')) ?></p>
              </div>
          </li>
          <li class="setps-content-inner step1">
              <div class="step-content-number">
                  <span>2</span>
              </div>
              <div class="step-content-text">
                  <h3><?= esc($homeText('process', 'step2_title')) ?></h3>
                  <p><?= esc($homeText('process', 'step2_description')) ?></p>
              </div>
          </li>
          </div>
      </div>

      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <div class="setps-content">

          <li class="setps-content-inner step1">
              <div class="step-content-number">
                  <span>3</span>
              </div>
              <div class="step-content-text">
                  <h3><?= esc($homeText('process', 'step3_detail_title')) ?></h3>
                  <p><?= esc($homeText('process', 'step3_description')) ?></p>
              </div>
          </li>

          <li class="setps-content-inner step1">
              <div class="step-content-number">
                  <span>4</span>
              </div>
              <div class="step-content-text">
                  <h3><?= esc($homeText('process', 'step4_title')) ?></h3>
                  <p><?= esc($homeText('process', 'step4_description')) ?></p>
              </div>
          </li>

        </div>
      </div>
        
    </div>
  </div>
</section>
  <!-- COUNT -->
  <section class="sw-container sw-counter-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
          <div class="sw-counter-grid">
            <h3 class="sw-counter" data-count="<?= $total_users ?>">0
            </h3>
            <h4>Pelanggan
            </h4>
          </div>
        </div>
        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
          <div class="sw-counter-grid">
            <h3 class="sw-counter" data-count="<?= $total_users ?>">0
            </h3>
            <h4>Undangan Dibuat
            </h4>
          </div>
        </div>
        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
          <div class="sw-counter-grid">
            <h3 class="sw-counter" data-count="<?= $total_tema ?>">0
            </h3>
            <h4>Desain Undangan
            </h4>
          </div>
        </div>
        <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
          <div class="sw-counter-grid">
            <h3 class="sw-counter" data-count="<?= $total_testi ?>">0
            </h3>
            <h4>Ulasan
            </h4>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- TESTIMONI -->
  <section class="blog-container sw-bg-3">
    <div class="container">
      <div class="row text-center">
        <div class="area-title text-center">
          <h2><?= esc($homeText('sections', 'testimonial_title_prefix')) ?>
            <span><?= esc($homeText('sections', 'testimonial_title_highlight')) ?>
            </span> <?= esc($homeText('sections', 'testimonial_title_suffix')) ?>
          </h2>
          <div class="title_border">
          </div>
          <p><?= esc($homeText('sections', 'testimonial_description')) ?>
          </p>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-centered">
          <div class="testimonials-slider">
            <div class="owl-carousel testimonial-slider owl-theme">
                <?php
                        $i = 1;
                        foreach ($testimoni->getResult() as $row) { ?>
              <div class="item">  
                <div class="sw-content-desc diulem-testimonial-card">
                  <div class="sw-person text-center">
                    <img src="<?php echo base_url() ?>/assets/users/<?= $row->kunci ?>/kita.png" class="img-responsive img-circle diulem-testimonial-avatar"/>
                  </div>
                  <h3><?= htmlentities($row->nama_lengkap) ?>
                  </h3>
                  <p class="diulem-testimonial-quote"><?= htmlentities($row->ulasan) ?>
                  </p>
                  <p class="diulem-testimonial-location"><?= htmlentities($row->kota) ?>, <?= htmlentities($row->provinsi) ?>
                  </p>
                </div>
              </div>
              <?php
                        }
                        ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="sw-container">
    <div class="container">
      <div class="media-partner diulem-partner-shell text-center">
        <div class="row">
          <h2><?= esc($homeText('sections', 'partner_title')) ?>
          </h2>
          <p class="diulem-partner-note"><?= esc($homeText('sections', 'partner_note')) ?></p>
          <div class="powered-slider owl-carousel text-center">
            <div class="media-partner-img">
              <img src="<?php echo base_url() ?>/assets/beranda/themes/powered/nusagateway.png" alt="Nusagateway"/>
            </div>
            <div class="media-partner-img">
              <img src="<?php echo base_url() ?>/assets/beranda/themes/powered/midtrans-logo.png" alt="Midtrans Payment Gateway"/>
            </div>
            <div class="media-partner-img">
              <img src="<?php echo base_url() ?>/assets/beranda/themes/powered/tripay-logo.png" alt="Tripay Payment Gateway"/>
            </div>
            <div class="media-partner-img">
              <img src="<?php echo base_url() ?>/assets/beranda/themes/powered/umkm.png" alt="UMKM Indonesia"/>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="sw-container diulem-public-cta">
    <div class="container">
      <div class="diulem-public-cta-card">
        <h2><?= esc($homeText('sections', 'final_cta_title')) ?></h2>
        <p><?= esc($homeText('sections', 'final_cta_description')) ?></p>
        <a href="<?= base_url() ?>/tema" class="btn sw-button btn-slider"><?= esc($homeText('sections', 'final_cta_button')) ?></a>
      </div>
    </div>
  </section>
  <div class="modal fade" id="sw-demo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false"
	data-backdrop="static">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title"> Preview Video <span class="nama_tema" id="nama_tema"></span></h4>
			</div>
			<div class="modal-body">
				<div class="demo text-center">
					<span class="demo-video" id="demo-video"></span>
				</div>
			</div>
		</div>
	</div>
</div>
