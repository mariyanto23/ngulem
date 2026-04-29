<div class="konten order-page">
    <section class="fdb-block">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-md-8 col-lg-8 col-xl-6 order-panel">
            <div class="order-hero">
              <div class="order-step-badge">Langkah 3 dari 6</div>
              <h1>Detail Acara</h1>
              <p>Susun acara utama dulu. Kamu bisa tambahkan beberapa agenda jika diperlukan.</p>
            </div>
            
            <div class="progress">
              <div class="progress-bar" role="progressbar" style="width: 32%;" aria-valuenow="32" aria-valuemin="0" aria-valuemax="100">32%</div>
            </div>

        <form method="post" action="<?php echo base_url('order/4'); ?>">
         <div id="konten-acara" >
            <div id="acara1" class="order-item-card">
                <div class="order-item-header"><div class="order-item-index">#1</div></div>
                <div class="row align-items-center">
                  <div class="col">
                    <label>Judul Acara</label>
                    <input name="nama_acara[]" type="text" class="form-control" placeholder="Contoh : Akad Nikah" value="<?php if(isset($_SESSION['nama_acara0'])) echo $_SESSION['nama_acara0'] ?>" required>
                  </div>
                </div>
                <div class="row align-items-center mt-3">
                   <div class="col">
                    <label>Tanggal</label>
                    <input name="datepicker1" type="text" class="form-control" placeholder="Tanggal" id="datepicker1" readonly="readonly" style="cursor:pointer; background-color: #FFFFFF" value="<?php if(isset($_SESSION['tgl_acara0'])) echo $_SESSION['tgl_acara0']; ?>" required>
                    <input type="hidden" id="tgl_acara1" name="tgl_acara[]" value="<?php if(isset($_SESSION['tgl_acara0'])){ echo $_SESSION['tgl_acara0']; }else{ echo date("Y/m/d"); }
                    ?>">
                  </div>
                </div>
                <div class="row align-items-center mt-3">
                  <div class="col mt-2">
                    <div class="form-row">
                        <div class="col-md-6">
                            <label>Waktu / Jam </label>
                            <input name="waktu_mulai[]" type="time" class="form-control" placeholder="Contoh : 10.00 Pagi" value="<?php if(isset($_SESSION['waktu_mulai0'])) echo $_SESSION['waktu_mulai0'] ?>" required>
                        </div>
                        <div class="col-md-6">
                          <label>Waktu / Jam </label>
                          <input name="waktu_akhir[]" type="time" class="form-control" placeholder="Contoh : 10.00 Pagi" value="<?php if(isset($_SESSION['waktu_akhir0'])) echo $_SESSION['waktu_akhir0'] ?>" required>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="row align-items-center mt-3">
                  <div class="col">
                    <label>Tempat Acara</label>
                    <input name="tempat_acara[]" type="text" class="form-control" placeholder="Contoh : Kediaman Mempelai Wanita" value="<?php if(isset($_SESSION['tempat_acara0'])) echo $_SESSION['tempat_acara0'] ?>" required>
                  </div>
                </div>
                <div class="row align-items-center mt-3">
                  <div class="col">
                    <label>Alamat Acara</label>
                    <textarea name="alamat_acara[]" type="text" class="form-control" required><?php if(isset($_SESSION['alamat_acara0'])) echo $_SESSION['alamat_acara0'] ?></textarea>
                  </div>
                </div>
                <div class="row align-items-center mt-3">
                  <div class="col">
                    <label>Google Maps</label>
                    <textarea name="maps[]" type="text" class="form-control"><?php if(isset($_SESSION['maps0'])) echo $_SESSION['maps0'] ?></textarea>
                    <div class="mt-1">
                            <a href="<?php echo base_url('maps'); ?>" class="order-helper-link"><i class="lni-question-circle"></i><span>Cara menambahkan Google Maps</span></a>
                                
                            </div>
                  </div>
                </div>
                
              </div>

              <div id="acara2" class="order-item-card">
                <div class="order-item-header">
                  <div class="order-item-index">#2</div>
                  <a id="2" class="btn btn-sm btn-danger btn_remove">Hapus</a>
                </div>
                <div class="row align-items-center">
                  <div class="col">
                    <label>Judul Acara</label>
                    <input name="nama_acara[]" type="text" class="form-control" placeholder="Contoh : Resepsi Pernikahan" value="<?php if(isset($_SESSION['nama_acara1'])) echo $_SESSION['nama_acara1'] ?>" required>
                  </div>
                </div>
                <div class="row align-items-center mt-3">
                   <div class="col">
                    <label>Tanggal</label>
                    <input name="datepicker2" type="text" class="form-control" placeholder="Tanggal" id="datepicker2" readonly="readonly" style="cursor:pointer; background-color: #FFFFFF" value="<?php if(isset($_SESSION['tgl_acara1'])) echo $_SESSION['tgl_acara1']; ?>" required>
                    <input type="hidden" id="tgl_acara2" name="tgl_acara[]" value="<?php if(isset($_SESSION['tgl_acara1'])) { echo $_SESSION['tgl_acara1']; }else{ echo date("Y/m/d"); } ?>">
                  </div>
                </div>
                <div class="row align-items-center mt-3">
                  <div class="col mt-2">
                    <div class="form-row">
                        <div class="col-md-6">
                            <label>Waktu / Jam </label>
                            <input name="waktu_mulai[]" type="time" class="form-control" placeholder="Contoh : 10.00 Pagi" value="<?php if(isset($_SESSION['waktu_mulai1'])) echo $_SESSION['waktu_mulai1'] ?>" required>
                        </div>
                        <div class="col-md-6">
                          <label>Waktu / Jam </label>
                          <input name="waktu_akhir[]" type="time" class="form-control" placeholder="Contoh : 10.00 Pagi" value="<?php if(isset($_SESSION['waktu_akhir1'])) echo $_SESSION['waktu_akhir1'] ?>" required>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="row align-items-center mt-3">
                  <div class="col">
                    <label>Tempat Acara</label>
                    <input name="tempat_acara[]" type="text" class="form-control" placeholder="Contoh : Kediaman Mempelai Wanita" value="<?php if(isset($_SESSION['tempat_acara1'])) echo $_SESSION['tempat_acara1'] ?>" required>
                  </div>
                </div>
                <div class="row align-items-center mt-3">
                  <div class="col">
                    <label>Alamat Acara</label>
                    <textarea name="alamat_acara[]" type="text" class="form-control" required><?php if(isset($_SESSION['alamat_acara1'])) echo $_SESSION['alamat_acara1'] ?></textarea>
                  </div>
                </div>
                <div class="row align-items-center mt-3">
                  <div class="col">
                    <label>Google Maps</label>
                    <textarea name="maps[]" type="text" class="form-control" ><?php if(isset($_SESSION['maps1'])) echo $_SESSION['maps1'] ?></textarea>
                    <div class="mt-1">
                            <a href="<?php echo base_url('maps'); ?>" class="order-helper-link"><i class="lni-question-circle"></i><span>Cara menambahkan Google Maps</span></a>
                                
                            </div>
                  </div>
                </div>
                
              </div>

              <?php 
              if(isset($_SESSION['jml_acara'])) {
                if($_SESSION['jml_acara'] > 2) {
                  for($i=2;$i < $_SESSION['jml_acara'];$i++){ 
              
              ?>
                <div id="acara<?php echo $i+1 ?>" class="order-item-card">
                <div class="order-item-header">
                  <div class="order-item-index">#<?php echo $i+1 ?></div>
                  <a id="<?php echo $i+1 ?>" class="btn btn-sm btn-danger btn_remove">Hapus</a>
                </div>
                
                <div class="row align-items-center">
                  <div class="col">
                    <label>Judul Acara</label>
                    <input name="nama_acara[]" type="text" class="form-control" placeholder="Contoh : Pertama Bertemu" value="<?php if(isset($_SESSION['nama_acara'.$i])) echo $_SESSION['nama_acara'.$i] ?>" required>
                  </div>
                </div>
                <div class="row align-items-center mt-3">
                   <div class="col">
                    <label>Tanggal</label>
                    <input name="datepicker<?php echo $i+1 ?>" type="text" class="form-control" placeholder="Tanggal" id="datepicker<?php echo $i+1 ?>" readonly="readonly" style="cursor:pointer; background-color: #FFFFFF" value="<?php if(isset($_SESSION['tgl_acara'.$i])) echo $_SESSION['tgl_acara'.$i] ?>" required>
                    <input type="hidden" id="tgl_acara<?php echo $i+1 ?>" name="tgl_acara[]" value="<?php if(isset($_SESSION['tgl_acara'.$i])) echo $_SESSION['tgl_acara'.$i] ?>">
                  </div>
                </div>
                <div class="row align-items-center mt-3">
                  <div class="col mt-2">
                    <div class="form-row">
                        <div class="col-md-6">
                            <label>Waktu / Jam </label>
                            <input name="waktu_mulai[]" type="time" class="form-control" placeholder="Contoh : 10.00 Pagi" value="<?php if(isset($_SESSION['waktu_mulai'.$i])) echo $_SESSION['waktu_mulai'.$i] ?>" required>
                        </div>
                        <div class="col-md-6">
                          <label>Waktu / Jam </label>
                          <input name="waktu_akhir[]" type="time" class="form-control" placeholder="Contoh : 10.00 Pagi" value="<?php if(isset($_SESSION['waktu_akhir'.$i])) echo $_SESSION['waktu_akhir'.$i] ?>" required>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="row align-items-center mt-3">
                  <div class="col">
                    <label>Tempat Acara</label>
                    <input name="tempat_acara[]" type="text" class="form-control" placeholder="Contoh : Kediaman Mempelai Wanita" value="<?php if(isset($_SESSION['tempat_acara'.$i])) echo $_SESSION['tempat_acara'.$i] ?>" required>
                  </div>
                </div>
                <div class="row align-items-center mt-3">
                  <div class="col">
                    <label>Alamat Acara</label>
                    <textarea name="alamat_acara[]" type="text" class="form-control" required><?php if(isset($_SESSION['alamat_acara'.$i])) echo $_SESSION['alamat_acara'.$i] ?></textarea>
                  </div>
                </div>
                <div class="row align-items-center mt-3">
                  <div class="col">
                    <label>Google Maps</label>
                    <textarea name="maps[]" type="text" class="form-control"><?php if(isset($_SESSION['maps'.$i])) echo $_SESSION['maps'.$i] ?></textarea>
                    <div class="mt-1">
                            <a href="<?php echo base_url('maps'); ?>" class="order-helper-link"><i class="lni-question-circle"></i><span>Cara menambahkan Google Maps</span></a>
                                
                            </div>
                  </div>
                </div>
                
              </div>

              <?php } 
                  }
                }
              ?>

            </div>

            <div class="row order-add-button" >
              <div class="col text-center">
                <a id="addAcara" class="btn btn-primary btn-order btn-block">Tambah Acara</a>
              </div>
            </div>

            <div class="row justify-content-start mt-3 order-actions" >
              <div class="col">
                <div class="row">
                  
                  <div class="col-auto">
                    <a href="<?php echo base_url('order/2'); ?>" class="btn btn-secondary btn-order">Kembali</a>
                  </div>
                  <div class="col">
                    <input name="submit" type="submit" class="btn btn-primary btn-order btn-block" style="background-color: #3498db;" value="Lanjut">
                  </div>
                </div>   
              </div>
            </div>

            </form>

          </div>
        </div>
      </div>
    </section>
</div>
