<div class="konten order-page">
<?php
$isFreePackage = isset($harga) && (int) $harga <= 0;
$isActive = (int) $status === 2;
$heading = 'Sukses!';
$subheading = 'Hai kak! selamat undangan kamu sudah berhasil dibuat';
$statusLabel = $isActive ? 'Aktif' : 'Belum Lunas';
$statusClass = $isActive ? 'order-status-active' : 'order-status-pending';
$dashboardHint = 'Login ke dashboard untuk mulai melengkapi undangan kamu.';

if ($isFreePackage && $isQuickSetup) {
    $subheading = 'Paket gratis kamu sudah aktif. Selanjutnya tinggal lengkapi undangan dari dashboard.';
} elseif ($isFreePackage) {
    $subheading = 'Paket gratis kamu sudah aktif dan siap dilengkapi.';
} elseif ($isQuickSetup && ! $isActive) {
    $subheading = 'Akun dan undangan dasar sudah dibuat. Kamu bisa mulai melengkapi detail sambil menyelesaikan aktivasi.';
} elseif ($isQuickSetup && $isActive) {
    $subheading = 'Undangan kamu sudah aktif. Kamu bisa lanjut melengkapi detail dari dashboard.';
}

$format =
"Hallo kak,
saya mau aktivasi Undangan *".$kode."*. 
mohon infonya ";
?>
    <section class="fdb-block">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-md-8 col-lg-8 col-xl-6 order-panel">
            <div class="order-hero">
              <div class="order-step-badge">Undangan Siap</div>
              <h1><?= $heading ?></h1>
              <p><?= $subheading ?></p>
            </div>

            <div class="order-code-card">
              <div class="row align-items-center">
                <div class="col">
                  <div class="order-code-label">Kode Pesanan</div>
                  <div class="order-code-value">#<?= $kode ?></div>
                </div>
                <div class="col-auto">
                  <span class="order-status-badge <?= $statusClass ?>"><?= $statusLabel ?></span>
                </div>
              </div>
            </div>

            <div class="row justify-content-start mt-3 order-actions" >
                <div class="col">
                  <div class="row">
                    <div class="col">
                      <a href="<?= SITE_UNDANGAN?>/<?= $domain ?>" target="_blank" class="btn btn-primary btn-order btn-block" >Lihat Undangan</a>
                    </div>
                    <div class="col">
				<a href="<?= base_url('user/logout') ?>" target="_blank" class="btn btn-success btn-order btn-block" >Masuk Dashboard</a>
                    </div>
                  </div>   
                </div>
            </div>

            <div class="order-inline-note mt-4 text-center" >
              <?php if ($isActive) { ?>
                <div class="font-weight-bold">
                    <?= $dashboardHint ?>
                </div>
              <?php } else { ?>
                <div>
                    Untuk melakukan aktifasi silahkan login dengan email dan password yang anda buat atau bisa menghubungi admin via <a href="https://api.whatsapp.com/send?phone=<?= $setting[0]->no_wa; ?>&text=<?php echo urlencode($format) ?>" >Whatsapp</a> dengan menyertakan kode <strong style="color:#b91c1c;">#<?= $kode ?></strong>.
                </div>
              <?php } ?>
            </div>

            <?php if ($isQuickSetup) { ?>
            <div class="order-next-steps">
              <div style="text-align: left;">
                <h4 style="margin-bottom: 10px;color:#2c3e50;">Langkah berikutnya</h4>
                <ul style="margin-bottom: 0;padding-left: 18px;color:#6c757d;">
                  <li>Lengkapi data mempelai</li>
                  <li>Atur tanggal dan lokasi acara</li>
                  <li>Pilih tema undangan</li>
                  <li>Tambahkan cerita atau gallery jika diperlukan</li>
                </ul>
              </div>
            </div>
            <?php } ?>

          </div>
        </div>
      </div>
    </section>
</div>
