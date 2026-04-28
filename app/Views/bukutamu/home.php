<!DOCTYPE html>
<html lang="en">

<head>
    <?php foreach ($mempelai->getResult() as $row) {
        $nama_panggilan_pria = $row->nama_panggilan_pria;
        $nama_lengkap_pria = $row->nama_pria;
        $nama_ayah_pria = $row->nama_ayah_pria;
        $nama_ibu_pria = $row->nama_ibu_pria;
        $nama_panggilan_wanita = $row->nama_panggilan_wanita;
        $nama_lengkap_wanita = $row->nama_wanita;
        $nama_ayah_wanita = $row->nama_ayah_wanita;
        $nama_ibu_wanita = $row->nama_ibu_wanita;
        $posisi_mempelai = $row->posisi_mempelai;
    }
    ?>
    <?php foreach ($data->getResult() as $row) {
        $kunci = $row->kunci;
    }
    ?>
    <title><?php if ($posisi_mempelai == 0) echo $nama_panggilan_pria . " & " . $nama_panggilan_wanita;
            else echo $nama_panggilan_wanita . " & " . $nama_panggilan_pria; ?></title>
    <!-- REQUIRED META AREA	 -->
    <meta charset="UTF-8">
    <meta name=viewport content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta property="og:title" content="<?php if ($posisi_mempelai == 0) echo $nama_panggilan_pria . " & " . $nama_panggilan_wanita;
                                        else echo $nama_panggilan_wanita . " & " . $nama_panggilan_pria; ?>">
    <meta name=keywords content="ngulemind,undangan,pernikahan,online,website,wedding,invitation,digital,video">
    <meta property="og:url" content="<?php echo base_url() ?>">
    <meta property="og:image" content="<?= base_url() ?>/assets/users/<?= $kunci; ?>/kita.png">
    <meta property="og:image:alt" content="<?php if ($posisi_mempelai == 0) echo $nama_panggilan_pria . " & " . $nama_panggilan_wanita;
                                            else echo $nama_panggilan_wanita . " & " . $nama_panggilan_pria; ?>">
    <meta property="og:image:width" content="300">
    <meta property="og:image:height" content="300">
    <meta property="og:type" content="website" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link rel="icon" href="<?= base_url() ?>/assets/users/<?= $kunci; ?>/kita.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/bukutamu/css/style.css">
    <script src="<?= base_url('assets/dashboard'); ?>/vendor/jquery/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">
    <style>
        body {
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            position: relative;
            min-height: 100vh;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background: linear-gradient(180deg, rgba(15, 23, 42, 0.42), rgba(15, 23, 42, 0.72));
            z-index: -1;
        }

        .bukutamu-shell {
            background: rgba(255, 255, 255, 0.94);
            border-radius: 24px;
            box-shadow: 0 24px 80px rgba(15, 23, 42, 0.18);
            padding: 24px;
            backdrop-filter: blur(10px);
        }

        .bukutamu-hero {
            margin-bottom: 18px;
        }

        .bukutamu-hero-card,
        .bukutamu-stat-card,
        .bukutamu-section-card {
            background: #fff;
            border: 1px solid rgba(226, 232, 240, 0.9);
            border-radius: 18px;
            box-shadow: 0 16px 40px rgba(15, 23, 42, 0.08);
        }

        .bukutamu-hero-card {
            padding: 22px 24px;
            background: linear-gradient(135deg, rgba(250, 204, 21, 0.18), rgba(255, 255, 255, 0.96));
        }

        .bukutamu-hero-title {
            margin: 0 0 6px;
            font-size: 28px;
            font-weight: 700;
            color: #0f172a;
        }

        .bukutamu-hero-subtitle {
            margin: 0;
            color: #475569;
            font-size: 14px;
        }

        .bukutamu-date-card {
            padding: 18px 20px;
            text-align: center;
        }

        .bukutamu-date-card .utama-detail {
            margin: 0;
            color: #0f172a;
        }

        .bukutamu-stat-card {
            padding: 18px 16px;
            text-align: center;
            margin-bottom: 16px;
        }

        .bukutamu-stat-label {
            color: #64748b;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .04em;
        }

        .bukutamu-stat-value {
            margin: 8px 0 4px;
            font-size: 30px;
            line-height: 1;
            font-weight: 800;
            color: #0f172a;
        }

        .bukutamu-stat-meta {
            color: #475569;
            font-size: 12px;
        }

        .bukutamu-slider-card {
            overflow: hidden;
        }

        #myCarousel {
            border: 0 !important;
            border-radius: 18px;
            overflow: hidden;
        }

        #myCarousel .item img {
            width: 100%;
            max-height: 420px;
            object-fit: cover;
        }

        .bukutamu-checkin-grid {
            margin-top: 18px;
        }

        .bukutamu-section-card {
            padding: 18px;
            min-height: 100%;
        }

        .bukutamu-step {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            border-radius: 999px;
            background: #0f766e;
            color: #fff;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .bukutamu-section-title {
            margin: 0 0 6px;
            font-size: 18px;
            font-weight: 700;
            color: #0f172a;
        }

        .bukutamu-section-subtitle {
            margin: 0 0 14px;
            color: #64748b;
            font-size: 13px;
        }

        .bukutamu-action-area,
        .bukutamu-form-area,
        .bukutamu-list-area {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 16px;
        }

        .bukutamu-action-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            min-height: 56px;
            text-decoration: none;
            background: #fff7d6;
            border: 1px dashed #f59e0b;
            border-radius: 14px;
            transition: .2s ease;
            padding: 18px 12px;
        }

        .bukutamu-action-button:hover {
            text-decoration: none;
            transform: translateY(-1px);
            box-shadow: 0 12px 24px rgba(245, 158, 11, 0.12);
        }

        .bukutamu-action-button img {
            width: 88px;
            max-width: 42%;
            height: auto;
            object-fit: contain;
        }

        @media (max-width: 300px) {
            #camera video {
                max-width: 80%;
                max-height: 80%;
            }


        }

        .bukutamu-action-button.is-disabled {
            opacity: .45;
            pointer-events: none;
        }

        .bukutamu-helper {
            margin-top: 12px;
            font-size: 12px;
            color: #6b7280;
            text-align: center;
        }

        .bukutamu-scan-canvas {
            width: 100%;
            max-width: 240px;
            margin: 12px auto 0;
            border-radius: 14px;
            background: #0f172a;
        }

        .bukutamu-selfie-actions .btn,
        #btn-do-capture {
            border-radius: 10px;
        }

        #hadir-list .list-group-item {
            border: 0;
            border-bottom: 1px solid #e2e8f0;
            padding: 14px 16px;
            background: transparent;
        }

        #hadir-list .list-group-item:last-child {
            border-bottom: 0;
        }

        .bukutamu-selfie-thumb {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            object-fit: cover;
            border: 2px solid #facc15;
            cursor: pointer;
        }

        .bukutamu-selfie-slider {
            margin-top: 18px;
        }

        .bukutamu-selfie-slide {
            min-height: 360px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px;
        }

        .bukutamu-selfie-card {
            width: 100%;
            max-width: 420px;
            background: #ffffff;
            border-radius: 18px;
            padding: 16px;
            box-shadow: 0 16px 32px rgba(15, 23, 42, 0.12);
        }

        .bukutamu-selfie-card img {
            width: 100%;
            height: 240px;
            object-fit: cover;
            border-radius: 14px;
            border: 2px solid #facc15;
        }

        .bukutamu-selfie-meta {
            margin-top: 14px;
            text-align: center;
        }

        .bukutamu-selfie-meta strong {
            display: block;
            font-size: 18px;
            color: #0f172a;
        }

        .bukutamu-selfie-meta small {
            display: block;
            color: #64748b;
            margin-top: 4px;
        }

        #selfieCarousel .carousel-indicators {
            bottom: -6px;
        }

        #selfieCarousel .carousel-indicators li {
            width: 10px;
            height: 10px;
            border: 0;
            background: #cbd5e1;
            margin: 0 4px;
        }

        #selfieCarousel .carousel-indicators .active {
            background: #0f766e;
        }

        #selfieCarousel .left.carousel-control,
        #selfieCarousel .right.carousel-control {
            background-image: none;
            width: 52px;
            opacity: 1;
        }

        #selfieCarousel .glyphicon {
            width: 40px;
            height: 40px;
            line-height: 40px;
            border-radius: 999px;
            background: rgba(15, 23, 42, 0.7);
        }

        @media (max-width: 767px) {
            .bukutamu-shell {
                padding: 16px;
                border-radius: 18px;
            }

            .bukutamu-hero-title {
                font-size: 22px;
            }

            .bukutamu-section-card {
                margin-bottom: 16px;
            }

            .bukutamu-action-button img {
                width: 72px;
                max-width: 36%;
            }

            .bukutamu-selfie-slide {
                min-height: 300px;
                padding: 0;
            }

            .bukutamu-selfie-card img {
                height: 200px;
            }
        }
  </style>
</head>

<body style="background-image: url('<?= base_url() ?>/assets/users/<?= $kunci; ?>/bg-tamu.png');">
    <?php
    $satu_hari        = mktime(0, 0, 0, date("n"), date("j"), date("Y"));
    function tglIndonesia($str)
    {
        $tr   = trim($str);
        $str    = str_replace(array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'), array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'), $tr);
        return $str;
    }
    $tanggal_sekarang = date('Y/m/d');
    if (!empty($countdown->getResult())) {
        foreach ($countdown->getResult() as $row) {
            $tgl_acara = $row->tgl_acara;
            $clock = $row->tgl_acara . ' ' . $row->waktu_mulai;
            $tempat = $row->tempat_acara;
            $alamat = $row->alamat_acara;
        }
    } else {
        $tgl_acara = $acara[0]->tgl_acara;
        $clock = $acara[0]->tgl_acara . ' ' . $acara[0]->waktu_mulai;
        $tempat = $acara[0]->tempat_acara;
        $alamat = $acara[0]->alamat_acara;
    }
    $totalTamu = (int) ($total_tamu ?? 0);
    $totalHadir = (int) ($total_hadir ?? 0);
    $totalHadirToday = (int) ($total_hadir_today ?? 0);
    $totalBelumHadir = max(0, $totalTamu - $totalHadir);
    $attendanceRate = $totalTamu > 0 ? round(($totalHadir / $totalTamu) * 100) : 0;
    ?>

    <div class="container" style="padding-top:18px;padding-bottom:28px;">
        <div class="bukutamu-shell">
            <div class="row bukutamu-hero">
                <div class="col-sm-8">
                    <div class="bukutamu-hero-card">
                        <h1 class="bukutamu-hero-title"><?php if ($posisi_mempelai == 0) echo $nama_panggilan_pria . " & " . $nama_panggilan_wanita;
                                                        else echo $nama_panggilan_wanita . " & " . $nama_panggilan_pria; ?></h1>
                        <p class="bukutamu-hero-subtitle">Panel check-in tamu undangan. Scan QR, ambil selfie, lalu simpan kehadiran tanpa pindah halaman.</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="bukutamu-hero-card bukutamu-date-card">
                        <div class="bukutamu-stat-label">Waktu Saat Ini</div>
                        <h3 class="utama-detail" id="tanggal-sekarang-acara"><?php echo $tanggal_sekarang; ?></h3>
                        <h2 class="utama-detail" id="jam"></h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3">
                    <div class="bukutamu-stat-card">
                        <div class="bukutamu-stat-label">Total Tamu</div>
                        <div class="bukutamu-stat-value" id="stat-total-tamu"><?= $totalTamu ?></div>
                        <div class="bukutamu-stat-meta">Semua undangan terdaftar</div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="bukutamu-stat-card">
                        <div class="bukutamu-stat-label">Sudah Hadir</div>
                        <div class="bukutamu-stat-value" id="stat-total-hadir"><?= $totalHadir ?></div>
                        <div class="bukutamu-stat-meta">Check-in berhasil tersimpan</div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="bukutamu-stat-card">
                        <div class="bukutamu-stat-label">Hadir Hari Ini</div>
                        <div class="bukutamu-stat-value" id="stat-total-hadir-today"><?= $totalHadirToday ?></div>
                        <div class="bukutamu-stat-meta">Update real-time</div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="bukutamu-stat-card">
                        <div class="bukutamu-stat-label">Progress Kehadiran</div>
                        <div class="bukutamu-stat-value" id="stat-attendance-rate"><?= $attendanceRate ?>%</div>
                        <div class="bukutamu-stat-meta" id="stat-total-belum-hadir"><?= $totalBelumHadir ?> tamu belum hadir</div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-bottom:16px;">
                <div class="col-sm-12">
                    <div class="bukutamu-section-card">
                        <div class="bukutamu-step">A</div>
                        <h3 class="bukutamu-section-title">Petunjuk Singkat</h3>
                        <p class="bukutamu-section-subtitle">1. Scan QR tamu, 2. Ambil selfie, 3. Simpan kehadiran. Jika QR bermasalah, isi manual lalu fokus ke input QR agar data tamu tetap terbaca.</p>
                    </div>
                </div>
            </div>

            <div class="container-fluid" style="padding:0;margin-top:10px;">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="bukutamu-section-card bukutamu-slider-card">
                            <div style="padding:0 0 14px;">
                                <div class="bukutamu-step">B</div>
                                <h3 class="bukutamu-section-title">Suasana Acara</h3>
                                <p class="bukutamu-section-subtitle">Slider visual buku tamu dan informasi singkat acara.</p>
                            </div>
                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                    <?php

                                    foreach ($slider as $key => $data) {
                                        $active = ($key == 0) ? 'active' : '';
                                        echo '<li data-target="#carousel-berita" data-slide-to="' . $key . '" class="' . $active . '"></li>';
                                    }
                                    ?>
                                </ol>

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" role="listbox">
                                    <?php
                                    foreach ($slider as $key => $data) {
                                        $active = ($key == 0) ? 'active' : '';
                                        echo '<div class="item ' . $active . '">' ?>
                                        <img src="<?php echo base_url() ?>/assets/users/<?php echo $kunci . '/' . $data['nama_slider']; ?>.png" alt="img-fluid">
                                </div>
                            <?php }
                            ?>

                            </div>

                            <!-- Left and right controls -->
                            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="bukutamu-section-card" style="background:linear-gradient(135deg,#0f172a,#334155);color:#fff;">
                        <p class="utama-mempelai"><u><?php if ($posisi_mempelai == 0) echo $nama_panggilan_pria . " & " . $nama_panggilan_wanita;
                                                        else echo $nama_panggilan_wanita . " & " . $nama_panggilan_pria; ?></u></p>
                        <b>
                            <p class="utama-detail" id="tanggal-acara-resepsi"></p>
                        </b>
                        <p class="utama-detail"><?php echo $tempat; ?></p>
                        <span class="utama-detail"><?php echo $alamat; ?></span>

                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid text-center bukutamu-checkin-grid" id="scan-hadir-tamu">
            <div class="row">
                <div class="col col-sm-3">
                    <div class="bukutamu-section-card">
                        <div class="bukutamu-step">1</div>
                        <h4 class="bukutamu-section-title">Scan QR Code</h4>
                        <p class="bukutamu-section-subtitle">Arahkan kamera ke QR buku tamu untuk mengisi data tamu otomatis.</p>
                        <div class="bukutamu-action-area">
                            <a id="btn-scan-qr" class="bukutamu-action-button" href="#" role="button" aria-label="Mulai scan QR code" onclick="return startQrScan(event);">
                                <img src="<?php echo base_url() ?>/assets/dashboard/img/qrscan.png" alt="Image" class="img-fluid">
                            </a>
                            <canvas hidden="" id="qr-canvas" class="bukutamu-scan-canvas"></canvas>
                            <div id="scan-helper" class="bukutamu-helper">Klik tombol scan untuk membuka kamera belakang.</div>
                        </div>
                    </div>
                </div>
                <div class="col col-sm-3">
                    <div class="bukutamu-section-card" id="canvas-camera">
                        <div class="bukutamu-step">2</div>
                        <h4 class="bukutamu-section-title">Capture Foto Selfie</h4>
                        <p class="bukutamu-section-subtitle">Ambil foto tamu setelah data undangan ditemukan.</p>
                        <div class="bukutamu-action-area">
                            <a id="btn-open-camera" class="bukutamu-action-button is-disabled" href="#" onClick="configure(); return false;">
                                <img src="<?php echo base_url() ?>/assets/bukutamu/img/photo-capture.png" alt="Image" class="img-fluid"></a>
                            <div id="camera" hidden="" style="display:none;"></div>
                            <div id="webcam" hidden="" style="display:none;">
                                <input type="button" class="btn btn-sm btn-danger" value="Capture" id="btn-do-capture" onClick="preview()">
                            </div>
                            <div id="simpan" hidden="" style="display:none">
                                <button type="button" class="btn btn-sm btn-danger" id="reset" onClick="batal()">Remove</button>
                                <button type="button" class="btn btn-sm btn-primary" name="save" id="save">Simpan</button>
                                <input type="hidden" name="image" class="image-tag">
                            </div>
                            <div id="selfie-helper" class="bukutamu-helper">Scan QR tamu terlebih dahulu untuk membuka kamera selfie.</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="bukutamu-section-card">
                        <div class="bukutamu-step">3</div>
                        <h4 class="bukutamu-section-title">Identitas Tamu</h4>
                        <p class="bukutamu-section-subtitle">Data ini akan terisi otomatis setelah QR berhasil dibaca.</p>
                        <div class="bukutamu-form-area">

                            <div class="col mt-2" id="qr-result">
                                <label>QR Code Tamu</label>
                                <input id="outputData" type="text" class="form-control" onfocus="autofill(this.value)" placeholder="QR Code Tamu Undangan" required>
                            </div>

                            <div class="col mt-2">
                                <label>Nama Tamu</label>
                                <input id="nama_tamu" type="text" class="form-control" placeholder="Contoh : Jack Dawson S.Kom" value="" disabled required>
                            </div>

                            <div class="col mt-2">
                                <label>Alamat Tamu</label>
                                <input id="alamat_tamu" type="text" class="form-control" placeholder="Contoh : Jack" value="" disabled required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="bukutamu-section-card">
                        <div class="bukutamu-step">4</div>
                        <h4 class="bukutamu-section-title">Kehadiran Terbaru</h4>
                        <p class="bukutamu-section-subtitle">Update terbaru muncul otomatis tanpa reload halaman.</p>
                        <div class="bukutamu-list-area">
                            <ul class="list-group" id="hadir-list">
                                <?php if (empty($hadir)) { ?>
                                    <li class="list-group-item" id="hadir-empty-state"><strong>Belum Ada Data Tamu Hadir</strong></li>
                                <?php } else { ?>
                                    <?php foreach ($hadir as $row) {
                                    ?>
                                        <?php $selfieUrl = base_url() . '/assets/users/' . $kunci . '/' . $row->qrcode . '.png'; ?>
                                        <li class="list-group-item">
                                            <div class="media" style="display:flex;align-items:center;gap:12px;">
                                                <div>
                                                    <img src="<?= esc($selfieUrl) ?>" alt="Selfie <?= esc($row->nama_tamu) ?>" class="hadir-selfie-thumb" data-image="<?= esc($selfieUrl) ?>" data-name="<?= esc($row->nama_tamu) ?>">
                                                </div>
                                                <div style="text-align:left;">
                                                    <strong><?= $row->nama_tamu ?></strong><br>
                                                    <small><?= $row->alamat_tamu ?></small><br>
                                                    <small class="text-muted"><?= $row->waktu_hadir ?></small>
                                                </div>
                                            </div>
                                        </li>
                                <?php }
                                } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bukutamu-selfie-slider">
            <div class="bukutamu-section-card">
                <div class="bukutamu-step">5</div>
                <h4 class="bukutamu-section-title">Slider Selfie Tamu Terbaru</h4>
                <p class="bukutamu-section-subtitle">Galeri check-in terbaru yang bergerak otomatis selama acara berlangsung.</p>
                <?php if (!empty($hadir)) { ?>
                    <div id="selfieCarousel" class="carousel slide" data-ride="carousel" data-interval="4000">
                        <ol class="carousel-indicators" id="selfie-carousel-indicators">
                            <?php foreach ($hadir as $index => $row) { ?>
                                <li data-target="#selfieCarousel" data-slide-to="<?= $index ?>" class="<?= $index === 0 ? 'active' : '' ?>"></li>
                            <?php } ?>
                        </ol>
                        <div class="carousel-inner" role="listbox" id="selfie-carousel-inner">
                            <?php foreach ($hadir as $index => $row) { ?>
                                <?php $selfieUrl = base_url() . '/assets/users/' . $kunci . '/' . $row->qrcode . '.png'; ?>
                                <div class="item <?= $index === 0 ? 'active' : '' ?> bukutamu-selfie-slide">
                                    <div class="bukutamu-selfie-card">
                                        <img src="<?= esc($selfieUrl) ?>" alt="Selfie <?= esc($row->nama_tamu) ?>" class="hadir-selfie-thumb" data-image="<?= esc($selfieUrl) ?>" data-name="<?= esc($row->nama_tamu) ?>">
                                        <div class="bukutamu-selfie-meta">
                                            <strong><?= esc($row->nama_tamu) ?></strong>
                                            <small><?= esc($row->alamat_tamu) ?></small>
                                            <small><?= esc($row->waktu_hadir) ?></small>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <a class="left carousel-control" href="#selfieCarousel" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#selfieCarousel" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <div id="selfie-slider-empty" hidden></div>
                <?php } else { ?>
                    <div id="selfie-slider-empty" class="bukutamu-form-area text-center">
                        <strong>Belum ada selfie tamu</strong>
                        <p class="bukutamu-section-subtitle" style="margin-top:8px;">Slider akan otomatis aktif setelah tamu pertama berhasil check-in.</p>
                    </div>
                    <div id="selfieCarousel" class="carousel slide" hidden></div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalSelfiePreview" tabindex="-1" role="dialog" aria-labelledby="modalSelfiePreviewLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSelfiePreviewLabel">Selfie Tamu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img src="" alt="Preview selfie" id="selfie-preview-image" style="width:100%;border-radius:12px;object-fit:cover;">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalGagal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Mohon Maaf, Tamu Undangan Sudah Mengisi Form Kehadiran/ tidak ditemukan
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function hasValidGuestData() {
            var qrCodeValue = ($('#outputData').val() || '').trim();
            var namaTamu = ($('#nama_tamu').val() || '').trim();
            return qrCodeValue !== '' && namaTamu !== '' && namaTamu !== '-';
        }

        function updateAttendanceUiState() {
            var canOpenCamera = hasValidGuestData();
            var hasImage = (($('.image-tag').val() || '').trim() !== '');
            var openCameraButton = document.getElementById('btn-open-camera');
            var helper = document.getElementById('selfie-helper');
            var webcamVisible = document.getElementById('webcam').hidden === false;

            if (openCameraButton) {
                openCameraButton.classList.toggle('is-disabled', !canOpenCamera);
            }

            if (helper) {
                if (hasImage) {
                    helper.textContent = 'Foto selfie sudah siap. Klik Simpan untuk menyelesaikan kehadiran.';
                } else if (webcamVisible) {
                    helper.textContent = 'Posisikan wajah tamu dengan jelas, lalu klik Capture.';
                } else if (canOpenCamera) {
                    helper.textContent = 'Data tamu sudah ditemukan. Klik ikon kamera untuk ambil foto selfie.';
                } else {
                    helper.textContent = 'Scan QR tamu terlebih dahulu untuk membuka kamera selfie.';
                }
            }
        }

        function updateScanUiState(isScanning, message) {
            var scanButton = document.getElementById('btn-scan-qr');
            var scanHelper = document.getElementById('scan-helper');
            var canvasElement = document.getElementById('qr-canvas');

            if (scanButton) {
                scanButton.classList.toggle('is-disabled', !!isScanning);
                scanButton.setAttribute('aria-busy', isScanning ? 'true' : 'false');
            }

            if (canvasElement) {
                canvasElement.hidden = !isScanning;
            }

            if (scanHelper) {
                if (message) {
                    scanHelper.textContent = message;
                } else {
                    scanHelper.textContent = isScanning ?
                        'Kamera aktif. Arahkan QR ke dalam frame.' :
                        'Klik tombol scan untuk membuka kamera belakang.';
                }
            }
        }

        function escapeHtml(value) {
            return $('<div>').text(value || '').html();
        }

        function prependSelfieSlide(item) {
            var $carousel = $('#selfieCarousel');
            var $indicators = $('#selfie-carousel-indicators');
            var $inner = $('#selfie-carousel-inner');
            var isEmpty = !$inner.length || $inner.children('.item').length === 0;

            $('#selfie-slider-empty').prop('hidden', true).hide();

            if (!$inner.length) {
                $carousel.html(
                    '<ol class="carousel-indicators" id="selfie-carousel-indicators"></ol>' +
                    '<div class="carousel-inner" role="listbox" id="selfie-carousel-inner"></div>' +
                    '<a class="left carousel-control" href="#selfieCarousel" role="button" data-slide="prev">' +
                        '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>' +
                        '<span class="sr-only">Previous</span>' +
                    '</a>' +
                    '<a class="right carousel-control" href="#selfieCarousel" role="button" data-slide="next">' +
                        '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>' +
                        '<span class="sr-only">Next</span>' +
                    '</a>'
                );
                $carousel.removeAttr('hidden');
                $indicators = $('#selfie-carousel-indicators');
                $inner = $('#selfie-carousel-inner');
                isEmpty = true;
            }

            $inner.find('.item').removeClass('active');
            $indicators.find('li').removeClass('active');

            $inner.prepend(
                '<div class="item active bukutamu-selfie-slide">' +
                    '<div class="bukutamu-selfie-card">' +
                        '<img src="' + escapeHtml(item.selfie_url || '') + '" alt="Selfie ' + escapeHtml(item.nama_tamu || '') + '" class="hadir-selfie-thumb" data-image="' + escapeHtml(item.selfie_url || '') + '" data-name="' + escapeHtml(item.nama_tamu || '') + '">' +
                        '<div class="bukutamu-selfie-meta">' +
                            '<strong>' + escapeHtml(item.nama_tamu || '') + '</strong>' +
                            '<small>' + escapeHtml(item.alamat_tamu || '') + '</small>' +
                            '<small>' + escapeHtml(item.waktu_hadir || '') + '</small>' +
                        '</div>' +
                    '</div>' +
                '</div>'
            );

            var totalSlides = $inner.children('.item').length;
            $indicators.empty();
            for (var i = 0; i < totalSlides; i++) {
                $indicators.append('<li data-target="#selfieCarousel" data-slide-to="' + i + '" class="' + (i === 0 ? 'active' : '') + '"></li>');
            }

            $carousel.removeAttr('hidden');
            if (!isEmpty) {
                $carousel.carousel(0);
            }
        }

        function updateAttendanceStats() {
            var totalTamu = parseInt($('#stat-total-tamu').text(), 10) || 0;
            var totalHadir = $('#hadir-list .list-group-item').not('#hadir-empty-state').length;
            var totalHadirToday = parseInt($('#stat-total-hadir-today').text(), 10) || 0;
            var totalBelumHadir = Math.max(0, totalTamu - totalHadir);
            var attendanceRate = totalTamu > 0 ? Math.round((totalHadir / totalTamu) * 100) : 0;

            $('#stat-total-hadir').text(totalHadir);
            $('#stat-total-hadir-today').text(totalHadirToday);
            $('#stat-attendance-rate').text(attendanceRate + '%');
            $('#stat-total-belum-hadir').text(totalBelumHadir + ' tamu belum hadir');
        }

        $(document).ready(function() {
            $('#save').on('click', function(event) {
                event.preventDefault();
                var image = $('.image-tag').val();
                var qrcode2 = $('#outputData').val();
                var nama = $('#nama_tamu').val();
                var alamat = $('#alamat_tamu').val();
                var $saveButton = $('#save');

                if (!qrcode2 || !nama || nama === '-' || !image) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Data belum lengkap',
                        text: 'Scan QR dan ambil foto selfie terlebih dahulu sebelum menyimpan.'
                    });
                    return;
                }

                $.ajax({
                    url: base_url + '/add_hadir',
                    method: "POST",
                    data: {
                        qrcode: qrcode2,
                        image: image,
                        nama: nama,
                        alamat: alamat
                    },
                    async: true,
                    dataType: 'json',
                    beforeSend: function() {
                        $saveButton.prop('disabled', true).text('Menyimpan...');
                    },
                    success: function($hasil) {
                        if ($hasil && $hasil.status === 'sukses') {
                            $('#hadir-empty-state').remove();
                            $('#hadir-list').prepend(
                                '<li class="list-group-item">' +
                                '<div class="media" style="display:flex;align-items:center;gap:12px;">' +
                                '<div><img src="' + escapeHtml($hasil.selfie_url || '') + '" alt="Selfie ' + escapeHtml($hasil.nama_tamu || nama) + '" style="width:48px;height:48px;border-radius:10px;object-fit:cover;border:2px solid #facc15;cursor:pointer;" class="hadir-selfie-thumb" data-image="' + escapeHtml($hasil.selfie_url || '') + '" data-name="' + escapeHtml($hasil.nama_tamu || nama) + '"></div>' +
                                '<div style="text-align:left;">' +
                                '<strong>' + escapeHtml($hasil.nama_tamu || nama) + '</strong><br>' +
                                '<small>' + escapeHtml($hasil.alamat_tamu || alamat) + '</small><br>' +
                                '<small class="text-muted">' + escapeHtml($hasil.waktu_hadir || '') + '</small>' +
                                '</div>' +
                                '</div>' +
                                '</li>'
                            );
                            $('#outputData').val('');
                            $('#nama_tamu').val('');
                            $('#alamat_tamu').val('');
                            $('.image-tag').val('');
                            $('#simpan').prop('hidden', true).hide();
                            $('#webcam').prop('hidden', true).hide();
                            $('#camera').prop('hidden', true).hide();
                            $('#btn-open-camera').prop('hidden', false);
                            Webcam.reset();
                            var currentToday = parseInt($('#stat-total-hadir-today').text(), 10) || 0;
                            $('#stat-total-hadir-today').text(currentToday + 1);
                            prependSelfieSlide($hasil);
                            updateAttendanceStats();
                            updateAttendanceUiState();
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Data hadir berhasil disimpan.'
                            });
                        } else {
                            $('#modalGagal').modal('show');
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal menyimpan',
                            text: 'Terjadi kendala saat menyimpan data hadir.'
                        });
                    },
                    complete: function() {
                        $saveButton.prop('disabled', false).text('Simpan');
                    }
                });
            });
        });
    </script>
    <script language="JavaScript">
        function preview() {
            const x = document.getElementById('camera');
            // untuk preview gambar sebelum di upload
            Webcam.snap(function(data_uri) {
                $(".image-tag").val(data_uri);
                Webcam.freeze();
                // ganti display webcam menjadi none dan simpan menjadi terlihat
                document.getElementById('webcam').hidden = true;
                document.getElementById('webcam').style.display = 'none';
                document.getElementById('simpan').hidden = false;
                //document.getElementById('webcam').style.display = 'none';
                document.getElementById('simpan').style.display = '';
                x.getElementsByTagName("video")[0].hidden = true;
                updateAttendanceUiState();
            });
        }

        function batal() {
            // batal preview
            Webcam.unfreeze();
            const x = document.getElementById('camera');
            // ganti display webcam dan simpan seperti semula
            document.getElementById('webcam').hidden = false;
            document.getElementById('simpan').hidden = true;
            document.getElementById('webcam').style.display = '';
            document.getElementById('simpan').style.display = 'none';
            $('.image-tag').val('');
            x.getElementsByTagName("video")[0].hidden = false;
            //document.getElementById('simpan').style.display = 'none';
            updateAttendanceUiState();
        }
    </script>
    <script>
        function configure() {
            if (!hasValidGuestData()) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Scan QR dulu',
                    text: 'Silakan scan QR Code tamu terlebih dahulu sebelum ambil foto selfie.'
                });
                return false;
            }

            initializeSelfieCamera();
            return false;
        }

        function initializeSelfieCamera() {
            Webcam.reset();
            Webcam.set({
                width: 187,
                height: 140,
                dest_width: 187,
                dest_height: 140,
                crop_width: 187,
                crop_height: 140,
                image_format: 'jpg',
                jpeg_quality: 100
            });

            Webcam.attach('#camera');
            document.getElementById('btn-open-camera').hidden = true;
            document.getElementById('webcam').style.display = '';
            document.getElementById('webcam').hidden = false;
            document.getElementById('camera').style.display = '';
            document.getElementById('camera').hidden = false;
            document.getElementById('simpan').hidden = true;
            document.getElementById('simpan').style.display = 'none';
            $('.image-tag').val('');
            updateAttendanceUiState();
        }

        $(document).ready(function() {
            const qrcode = window.qrcode || null;
            const jsQRScanner = window.jsQR || null;
            let barcodeDetector = null;
            if ('BarcodeDetector' in window) {
                try {
                    barcodeDetector = new BarcodeDetector({
                        formats: ['qr_code']
                    });
                } catch (error) {
                    barcodeDetector = null;
                }
            }
            const video = document.createElement("video");
            const canvasElement = document.getElementById("qr-canvas");
            const canvas = canvasElement.getContext("2d");
            const qrResult = document.getElementById("qr-result");
            const outputData = document.getElementById("outputData");
            const btnScanQR = document.getElementById("btn-scan-qr");
            let scanning = false;
            let scanStream = null;

            function stopScanStream() {
                scanning = false;

                if (scanStream) {
                    scanStream.getTracks().forEach(function(track) {
                        track.stop();
                    });
                    scanStream = null;
                }

                if (video.srcObject) {
                    video.srcObject = null;
                }

                updateScanUiState(false);
            }

            if (qrcode) {
                qrcode.callback = res => {
                    if (res && !String(res).toLowerCase().includes('error')) {
                        handleScanResult(res);
                    }
                };
            }

            btnScanQR.onclick = function(event) {
                event.preventDefault();

                if (scanning) {
                    return false;
                }

                if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Kamera tidak tersedia',
                        text: 'Browser ini belum mendukung akses kamera untuk scan QR.'
                    });
                    return false;
                }

                navigator.mediaDevices
                    .getUserMedia({
                        video: {
                            facingMode: "environment"
                        }
                    })
                    .then(function(stream) {
                        scanning = true;
                        scanStream = stream;
                        qrResult.hidden = false;
                        updateScanUiState(true);
                        Webcam.unfreeze();
                        document.getElementById('simpan').style.display = 'none';
                        document.getElementById('btn-open-camera').hidden = false;
                        document.getElementById('camera').style.display = 'none';
                        document.getElementById('webcam').hidden = true;
                        document.getElementById('webcam').style.display = 'none';
                        document.getElementById('camera').hidden = true;
                        document.getElementById('btn-do-capture').hidden = false;
                        updateAttendanceUiState();

                        video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
                        video.srcObject = stream;
                        video.onloadedmetadata = function() {
                            video.play();
                            tick();
                            scan();
                        };
                    })
                    .catch(function() {
                        stopScanStream();
                        Swal.fire({
                            icon: 'error',
                            title: 'Izin kamera ditolak',
                            text: 'Izinkan akses kamera agar QR Code bisa dipindai.'
                        });
                    });

                return false;
            };

            window.__diulemStartQrScan = function() {
                return btnScanQR.onclick({
                    preventDefault: function() {}
                });
            };

            $('#btn-scan-qr').on('click', function(event) {
                event.preventDefault();
                if (typeof btnScanQR.onclick === 'function') {
                    return btnScanQR.onclick(event);
                }
                return false;
            });

            function tick() {
                if (!scanning) {
                    return;
                }

                if (!video.videoWidth || !video.videoHeight) {
                    requestAnimationFrame(tick);
                    return;
                }

                canvasElement.height = video.videoHeight;
                canvasElement.width = video.videoWidth;
                canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);

                scanning && requestAnimationFrame(tick);
            }

            function handleScanResult(rawValue) {
                if (!rawValue) {
                    return;
                }

                var normalized = normalizeQrValue(rawValue);
                $("#outputData").val(normalized);
                autofill();
                stopScanStream();

                qrResult.hidden = false;
                document.getElementById('outputData').focus();
                initializeSelfieCamera();
                updateScanUiState(false, 'QR berhasil dibaca. Data tamu sedang diisi otomatis.');
            }

            async function detectWithBarcodeDetector() {
                if (!scanning || !barcodeDetector) {
                    return;
                }

                try {
                    var barcodes = await barcodeDetector.detect(canvasElement);
                    if (barcodes && barcodes.length > 0) {
                        handleScanResult(barcodes[0].rawValue || '');
                        return;
                    }
                } catch (error) {
                    // fallback to legacy decoder below
                }

                if (scanning) {
                    setTimeout(detectWithBarcodeDetector, 180);
                }
            }

            function scan() {
                if (!scanning) {
                    return;
                }

            if (barcodeDetector) {
                detectWithBarcodeDetector();
                return;
            }

            if (jsQRScanner && canvasElement.width && canvasElement.height) {
                try {
                    var imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
                    var qrCodeResult = jsQRScanner(imageData.data, imageData.width, imageData.height);
                    if (qrCodeResult && qrCodeResult.data) {
                        handleScanResult(qrCodeResult.data);
                        return;
                    }
                } catch (error) {
                    // fallback to legacy decoder below
                }
            }

            if (qrcode) {
                try {
                    qrcode.decode();
                } catch (e) {
                    if (scanning) {
                        setTimeout(scan, 300);
                    }
                }
                return;
            }

            if (scanning) {
                setTimeout(scan, 300);
            }
        }
        });
    </script>

    <script>
        window.startQrScan = function(event) {
            if (event && typeof event.preventDefault === 'function') {
                event.preventDefault();
            }

            if (window.__diulemStartQrScan && typeof window.__diulemStartQrScan === 'function') {
                return window.__diulemStartQrScan();
            }

            return false;
        };

        function autofill() {
            var qrcode = $("#outputData").val();
            $.ajax({
                url: "<?= base_url('bukutamu/autofill') ?>",
                data: '&qrcode=' + qrcode,
                success: function(data) {
                    var hasil = JSON.parse(data);
                    $.each(hasil, function(key, val) {
                        document.getElementById('nama_tamu').value = val.nama_tamu;
                        document.getElementById('alamat_tamu').value = val.alamat_tamu;
                        updateAttendanceUiState();
                    });
                }
            });
        }

        function normalizeQrValue(value) {
            if (!value) {
                return '';
            }

            try {
                var url = new URL(value);
                var code = url.searchParams.get('qrcode');
                if (code) {
                    return code;
                }

                var segments = url.pathname.split('/').filter(Boolean);
                return segments.length ? segments[segments.length - 1] : value;
            } catch (error) {
                return value;
            }
        }

        $(document).ready(function() {
            var params = new URLSearchParams(window.location.search);
            var queryQrCode = params.get('qrcode');
            if (queryQrCode) {
                $('#outputData').val(queryQrCode);
                autofill();
            }
            $(document).on('click', '.hadir-selfie-thumb', function() {
                $('#modalSelfiePreviewLabel').text('Selfie - ' + ($(this).data('name') || 'Tamu'));
                $('#selfie-preview-image').attr('src', $(this).data('image') || '');
                $('#modalSelfiePreview').modal('show');
            });
            updateAttendanceUiState();
            updateAttendanceStats();
        });
    </script>
    <script type="text/javascript">
        window.onload = function() {
            jam();
        }

        function jam() {
            var e = document.getElementById('jam'),
                d = new Date(),
                h, m, s;
            h = d.getHours();
            m = set(d.getMinutes());
            s = set(d.getSeconds());

            e.innerHTML = h + ':' + m + ':' + s;

            setTimeout('jam()', 1000);
        }

        function set(e) {
            e = e < 10 ? '0' + e : e;
            return e;
        }
    </script>
    <script>
        $(function() {
            <?php if (session()->has("success")) { ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Great!',
                    text: '<?= session("success") ?>'
                })
            <?php } ?>
            <?php if (session()->has("deleted")) { ?>
                Swal.fire({
                    icon: 'warning',
                    title: 'Great!',
                    text: '<?= session("deleted") ?>'
                })
            <?php } ?>
            <?php if (session()->has("updated")) { ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Great!',
                    text: '<?= session("updated") ?>'
                })
            <?php } ?>
            <?php if (session()->has("error")) { ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '<?= session("error") ?>'
                })
            <?php } ?>
        });
    </script>
</body>
<script>
    var base_url = '<?php echo base_url() ?>';
</script>
<script>
    var tanggal_resepsi = '<?php echo $tgl_acara; ?>';
</script>
<script>
    var tanggal_sekarang = '<?php echo $tanggal_sekarang; ?>';
</script>
<script src="<?php echo base_url() ?>/assets/bukutamu/js/moment-with-locales.js"></script>
<script src="<?php echo base_url() ?>/assets/bukutamu/js/script.js"></script>

</html>
