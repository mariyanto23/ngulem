
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
        .slider-1,
        .slider-1 .carousel-inner,
        .slider-1 .item {
          min-height: 520px;
        }

        .slider-1 .item > img {
          min-height: 520px;
          object-fit: cover;
          width: 100%;
        }

        .slider-1 .content-slider {
          top: 12% !important;
          margin-left: 0 !important;
          padding-top: 0;
          padding-bottom: 28px;
        }

        .slider-1 .content-slider .col-xs-8 {
          width: 100%;
        }

        .diulem-hero-badge {
          min-height: 28px;
          padding: 0 10px;
          font-size: 10px;
          margin-bottom: 8px;
        }

        .slider-1 .content-slider h3 {
          font-size: 24px !important;
          line-height: 1.18 !important;
          margin-bottom: 8px !important;
          letter-spacing: 0 !important;
          max-width: 92%;
        }

        .slider-1 .content-slider p {
          display: block !important;
          font-size: 13px;
          line-height: 1.5;
          margin-bottom: 0;
          max-width: 94%;
        }

        .diulem-hero-stats {
          gap: 8px;
          margin-top: 14px;
          max-width: 94%;
        }

        .diulem-hero-stat {
          min-width: calc(50% - 4px);
          padding: 8px 9px;
          border-radius: 10px;
        }

        .diulem-hero-stat strong {
          font-size: 13px;
          margin-bottom: 2px;
        }

        .diulem-hero-stat span {
          font-size: 10px;
          line-height: 1.35;
        }

        .diulem-hero-stat:nth-child(3) {
          display: none;
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

      @media (max-width: 380px) {
        .slider-1,
        .slider-1 .carousel-inner,
        .slider-1 .item,
        .slider-1 .item > img {
          min-height: 500px;
        }

        .slider-1 .content-slider {
          top: 10% !important;
        }

        .slider-1 .content-slider h3 {
          font-size: 21px !important;
          max-width: 96%;
        }

        .slider-1 .content-slider p {
          font-size: 12px;
          line-height: 1.45;
          max-width: 96%;
        }

        .diulem-hero-stats {
          display: none;
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
                    <div class="diulem-hero-badge">Undangan Website Praktis</div>
                    <h3>Berbagi undangan menjadi lebih mudah
                    </h3>
                    <p>Buat dan bagikan undangan pernikahan kamu dengan berbagai pilihan tampilan undangan yang elegan dan menarik, buat pernikahan kamu berkesan.
                    </p>
                    <a href="<?= base_url() ?>/tema" class="btn sw-button btn-slider">Pilih Tema Gratis
                    </a>
                    <div class="diulem-hero-stats">
                      <div class="diulem-hero-stat">
                        <strong>Gratis</strong>
                        <span>Mulai tanpa bayar dulu</span>
                      </div>
                      <div class="diulem-hero-stat">
                        <strong>Siap Cepat</strong>
                        <span>Undangan dasar langsung aktif</span>
                      </div>
                      <div class="diulem-hero-stat">
                        <strong>Fleksibel</strong>
                        <span>Edit kapan saja dari dashboard</span>
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
                    <div class="diulem-hero-badge">Tema Elegan & Modern</div>
                    <h3><?= strtoupper(DOMAIN_UTAMA) ?> - Digital Invitation Indonesia
                    </h3>
                    <p>Solusi pernikahan lebih hemat, praktis, dan kekinian dengan e-invitation yang disebar otomatis untuk memberikan kesan terbaik
                    </p>
                    <a href="<?= base_url() ?>/tema" class="btn sw-button btn-slider">Pilih Tema Sekarang
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
            <h2>Mengapa
              <span>Undangan
              </span> Digital?
            </h2>
            <div class="title_border">
            </div>
            <p>Apa saja keuntungan menggunakan undangan digital berbasis website
            </p>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="services-box-2">
              <div class="icon">
                <img src="<?php echo base_url() ?>/assets/beranda/themes/img/dollar.png" class="img-responsive">
              </div>
              <div class="services-title">
                <h4>Mudah, Cepat & Murah
                </h4>
              </div>
              <p>Gak perlu nunggu lama membuat undangan, dan kamu juga sudah bisa bikin undangan online dengan harga termurah.
              </p>
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="services-box-2">
              <div class="icon">
                <img src="<?php echo base_url() ?>/assets/beranda/themes/img/domain.png" class="img-responsive">
              </div>
              <div class="services-title">
                <h4>Mudah Menentukan Domain
                </h4>
              </div>
              <p>Mudah membuat URL unik untuk website undangan kamu, dengan menggunakan kata-kata sesuai dengan keinginan kamu
              </p>
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="services-box-2">
              <div class="icon">
                <img src="<?php echo base_url() ?>/assets/beranda/themes/img/social-media.png" class="img-responsive">
              </div>
              <div class="services-title">
                <h4>Sebarkan Undangan kamu
                </h4>
              </div>
              <p>Jangkau tamu undangan lebih banyak, kamu dapat membagikan di mana dan kapan saja dengan mudahnya kamu share di social media
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
            <h2>Apa Yang
              <span>Kamu
              </span> Dapat?
            </h2>
            <div class="title_border">
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <div class="services-box">
              <div class="services-title">
                <i class="flaticon-web-design">
                </i>
                <h4>Tema yang Menarik & Eksklusif
                </h4>
              </div>
              <p>Kau dapat menyeseuaikan tema pernikahan kamu dengan pilihan tema yang unik dan exlusif yang kami sediakan
              </p>             
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <div class="services-box">
              <div class="services-title">
                <i class="flaticon-book">
                </i>
                <h4>Story
                </h4>
              </div>
              <p>Kamu bisa cerita bagaimana cerita kalian bisa bertemu hingga melanjutkan ke jenjang pernikahan
              </p>             
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <div class="services-box">
              <div class="services-title">
                <i class="flaticon-rings">
                </i>
                <h4>Waktu Akad dan Resepsi
                </h4>
              </div>
              <p>Kamu dapat memberikan Informasi yang pastinya penting dalam pesta pernikahan, yaitu waktu dan lokasi resepsi
              </p>             
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <div class="services-box">
              <div class="services-title">
                <i class="flaticon-clothes">
                </i>
                <h4>Informasi Kedua Pasangan
                </h4>
              </div>
              <p>Kamu dapat menginformasikan tentang diri kamu dan pasangan yang kamu cintai disertai dengan foto kamu dan pasangan kamu.
              </p>             
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <div class="services-box">
              <div class="services-title">
                <i class="flaticon-camera">
                </i>
                <h4>Gallery Pra Wedding
                </h4>
              </div>
              <p>Dengan fitur gallery tentunya pra wedding kalian bisa diupload foto-foto kenangan kalian dan ditampilkan di website undangan kalian.
              </p>             
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <div class="services-box">
              <div class="services-title">
                <i class="flaticon-notebook">
                </i>
                <h4>Buku Tamu
                </h4>
              </div>
              <p>Di fitur ini bisa kamu gunakan sebagai pengganti buku untuk mencatat kehadiran tamu serta foto selfie tamu yang hadir
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
                <h2>Harga<span>Undangan</span> Online?</h2>
                <div class="title_border"></div>
                <p>Pilih paket yang paling pas untuk kebutuhan acara kamu. Semua paket bisa dikelola dari dashboard yang sama, dan paket gratis bisa langsung dicoba tanpa pembayaran.</p>
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
            <h2>Pilihan Tema Undangan
            </h2>
            <div class="title_border"></div>
            <p>Kamu penasaran bagaimana jadinya? Pilih salah satu untuk melihat demonya
              <br>selain itu <?= SITE_NAME ?> banyak pilihan tema undangan digital yang menarik dan eksklusif
            </p>
            <p class="diulem-theme-note">Mulai dari demo dulu, lalu pilih paket yang paling sesuai. Semua tema tetap bisa dilanjutkan ke proses order yang sama.</p>
          </div>
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
                    <h2>Undangan <span>Video</span></h2>
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
          <h2>Bagaimana <span>Cara</span> Mendaftar?</h2>
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
                <h2 class="process-step">Pilih Tema</h2>
            </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
            <div class="single-process wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1s">
                <div class="icon bg-silver-tree">
                    <span class="fa fa-address-card-o"></span>
                    <h3 class="process-no">2</h3>
                </div>
                <h2 class="process-step">Mendaftar</h2>
            </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
            <div class="single-process wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1s">
                <div class="icon bg-medium-purple">
                    <span class="fa fa-credit-card"></span>
                    <h3 class="process-no">3</h3>
                </div>
                <h2 class="process-step">Aktivasi</h2>
            </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
            <div class="single-process wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1s">
                <div class="icon bg-curious-blue">
                    <span class="fa fa-paper-plane-o"></span>
                    <h3 class="process-no">4</h3>
                </div>
                <h2 class="process-step">Undangan Aktif</h2>
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
                  <h3>Pilih Tema</h3>
                  <p>Kamu bebas memilih tema yang sesuai dengan tema pernikahan kamu</p>
              </div>
          </li>
          <li class="setps-content-inner step1">
              <div class="step-content-number">
                  <span>2</span>
              </div>
              <div class="step-content-text">
                  <h3>Mendaftar</h3>
                  <p>Daftar dengan email, isi data pernikahan kamu, lalu masuk ke dashboard untuk mengedit dan menyelesaikan pembayaran.</p>
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
                  <h3>Aktivasi Undangan kamu</h3>
                  <p>Pilih menu tagihan atau invoice, lalu lakukan aktivasi paket untuk mengaktifkan fitur undangan kamu.</p>
              </div>
          </li>

          <li class="setps-content-inner step1">
              <div class="step-content-number">
                  <span>4</span>
              </div>
              <div class="step-content-text">
                  <h3>Undangan Aktif</h3>
                  <p>Kamu sudah bisa mengubah, melengkapi, lalu menyebarkan undangan pernikahanmu kapan saja.</p>
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
          <h2>Apa
            <span>Kata
            </span> Mereka?
          </h2>
          <div class="title_border">
          </div>
          <p>Telah membantu pengantin untuk menjadikan undangan pernikahan mereka menjadi lebih berkesan
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
          <h2>Media  Partner
          </h2>
          <p class="diulem-partner-note">Mendukung proses pembayaran dan operasional undangan digital agar tetap praktis, aman, dan mudah dipakai.</p>
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
        <h2>Siap Mulai Buat Undangan?</h2>
        <p>Mulai dari paket gratis dulu, pilih tema yang paling cocok, lalu lengkapi detailnya dari dashboard kapan saja.</p>
        <a href="<?= base_url() ?>/tema" class="btn sw-button btn-slider">Pilih Tema Sekarang</a>
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
