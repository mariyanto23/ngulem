<div class="konten" style="display: flex;flex-grow: 1;overflow-x: hidden;flex-direction: row;margin-top: 60px;margin-bottom: 40px;">
<?php
$isFreePackage = isset($harga) && (int) $harga <= 0;
$isActive = (int) $status === 2;
$heading = 'Sukses!';
$subheading = 'Hai kak! selamat undangan kamu sudah berhasil dibuat';
$statusLabel = $isActive ? 'Aktif' : 'Belum Lunas';
$statusClass = $isActive ? 'btn-success' : 'btn-warning';
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
    <section class="fdb-block" style="padding-top: 20px;flex:1; ">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-md-8 col-lg-8 col-xl-6">
            <div class="row">
              <div class="col text-center">
                <h1 style="color: #3498db;margin-bottom:0px;"><?= $heading ?></h1>
                <p tyle="font-size: 15px;font-weight:500; "><?= $subheading ?></p>
              </div>
            </div>

            <div class="row align-items-center">
              <div class="col mt-5">
                <label>Kode Pesanan</label>
                <div class="upload-area-bg" style="margin-top: 5px;text-align: center;">
                  
                  <div class="col">
                  <div class="row">
                    <div class="col">
                      <a style="font-size: 14px;text-transform: uppercase;color: #2c3e50;" >#<?= $kode ?></a>
                    </div>
                    <div class="col-auto">
                       <a href="#" class="<?= $statusClass ?> btn-sm" ><?= $statusLabel ?></a>
                    </div>
                  </div>   
                </div>
                </div>
              </div>
            </div>

            <div class="row justify-content-start mt-3" >
                <div class="col">
                  <div class="row">
                    <div class="col">
                      <a href="<?= SITE_UNDANGAN?>/<?= $domain ?>" target="_blank" class="btn btn-primary btn-order btn-block" >Lihat Undangan</a>
                    </div>
                    <div class="col">
				<a href="<?= base_url('user/logout') ?>" target="_blank" class="btn btn-success btn-order btn-block" >Login Dashboard</a>
                    </div>
                  </div>   
                </div>
            </div>

            <div class="form-check mt-4" style="text-align: center;" >
              <?php if ($isActive) { ?>
                <h3 class="form-check-label">
                    <?= $dashboardHint ?>
                </h3>
              <?php } else { ?>
                <h3 class="form-check-label">
                    Untuk melakukan aktifasi silahkan login dengan email dan password yang anda buat atau bisa menghubungi admin via <a href="https://api.whatsapp.com/send?phone=<?= $setting[0]->no_wa; ?>&text=<?php echo urlencode($format) ?>" >Whatsapp</a> dengan menyertakan <strong>kode :<h2 style="color:red; size:30px; text:bold;">#<?= $kode ?></h2></strong>
                </h3>
              <?php } ?>
            </div>

            <?php if ($isQuickSetup) { ?>
            <div class="row mt-4">
              <div class="col">
                <div class="upload-area-bg" style="padding: 18px 20px;">
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
              </div>
            </div>
            <?php } ?>

          </div>
        </div>
      </div>
    </section>
</div>
