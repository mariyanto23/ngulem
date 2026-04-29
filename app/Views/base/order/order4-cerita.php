<div class="konten order-page">
    <section class="fdb-block">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-md-8 col-lg-8 col-xl-6 order-panel">
            <div class="order-hero">
              <div class="order-step-badge">Langkah 4 dari 6</div>
              <h1>Cerita Perjalanan</h1>
              <p>Kalau mau, tambahkan beberapa momen singkat supaya undangan terasa lebih personal.</p>
            </div>
            
            <div class="progress">
              <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
            </div>

        <form method="post" action="<?php echo base_url('order/5'); ?>">
         <div id="konten-cerita" >
            <div id="cerita1" class="order-item-card">
                <div class="order-item-header"><div class="order-item-index">#1</div></div>

                <div class="row align-items-center">
                   <div class="col">
                    <label>Tanggal</label>
                    <input name="tanggal_cerita[]" name="tanggal_cerita[]" type="text" class="form-control" placeholder="Contoh : 14 Januari 2020 " value="<?php if(isset($_SESSION['tanggal_cerita0'])) echo $_SESSION['tanggal_cerita0'] ?>" required>
                  </div>
                </div>

                <div class="row align-items-center mt-3">
                  <div class="col">
                    <label>Judul</label>
                    <input name="judul_cerita[]" type="text" class="form-control" placeholder="Contoh : Pertama Bertemu" value="<?php if(isset($_SESSION['judul_cerita0'])) echo $_SESSION['judul_cerita0'] ?>" required>
                  </div>
                </div>

                <div class="row align-items-center mt-3">
                  <div class="col">
                    <label>Isi Cerita</label>
                    <textarea name="isi_cerita[]" type="text" class="form-control" placeholder="Maximal 500 Karakter" maxlength="500" rows="4" required><?php if(isset($_SESSION['isi_cerita0'])) echo $_SESSION['isi_cerita0'] ?></textarea>
                  </div>
                </div>
              </div>

              <div id="cerita2" class="order-item-card">
                <div class="order-item-header">
                  <div class="order-item-index">#2</div>
                  <a id="2" class="btn btn-sm btn-danger btn_remove">Hapus</a>
                </div>

                <div class="row align-items-center">
                  <div class="col">
                    <label>Tanggal</label>
                    <input name="tanggal_cerita[]" type="text" class="form-control" placeholder="Contoh : 20 Februari 2020 " value="<?php if(isset($_SESSION['tanggal_cerita1'])) echo $_SESSION['tanggal_cerita1'] ?>" required>
                  </div>
                </div>

                <div class="row align-items-center mt-3">
                  <div class="col">
                    <label>Judul</label>
                    <input name="judul_cerita[]" type="text" class="form-control" placeholder="Contoh : Ta'aruf" value="<?php if(isset($_SESSION['judul_cerita1'])) echo $_SESSION['judul_cerita1'] ?>" required>
                  </div>
                </div>

                <div class="row align-items-center mt-3">
                  <div class="col">
                    <label>Isi Cerita</label>
                    <textarea name="isi_cerita[]" type="text" class="form-control" placeholder="Maximal 500 Karakter" maxlength="500" rows="4" required><?php if(isset($_SESSION['isi_cerita1'])) echo $_SESSION['isi_cerita1'] ?></textarea>
                  </div>
                </div>
              </div>  

              <?php 
              if(isset($_SESSION['jml_cerita'])) {
                if($_SESSION['jml_cerita'] > 2) {
                  for($i=2;$i < $_SESSION['jml_cerita'];$i++){ 
              
              ?>

              <div id="cerita<?php echo $i+1 ?>" class="order-item-card">
                <div class="order-item-header">
                  <div class="order-item-index">#<?php echo $i+1 ?></div>
                  <a id="<?php echo $i+1 ?>" class="btn btn-sm btn-danger btn_remove">Hapus</a>
                </div>

                <div class="row align-items-center">
                  <div class="col">
                    <label>Tanggal</label>
                    <input name="tanggal_cerita[]" type="text" class="form-control" placeholder="Contoh : 20 Februari 2020" value="<?php if(isset($_SESSION['tanggal_cerita'.$i])) echo $_SESSION['tanggal_cerita'.$i] ?>" required>
                  </div>
                </div>

                <div class="row align-items-center mt-3">
                  <div class="col">
                    <label>Judul</label>
                    <input name="judul_cerita[]" type="text" class="form-control" placeholder="Contoh : Ta'aruf" value="<?php if(isset($_SESSION['judul_cerita'.$i])) echo $_SESSION['judul_cerita'.$i] ?>" required>
                  </div>
                </div>

                <div class="row align-items-center mt-3">
                  <div class="col">
                    <label>Isi Cerita</label>
                    <textarea name="isi_cerita[]" type="text" class="form-control" placeholder="Maximal 500 Karakter" maxlength="500" rows="4" required><?php if(isset($_SESSION['isi_cerita'.$i])) echo $_SESSION['isi_cerita'.$i] ?></textarea>
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
                <a id="addCerita" class="btn btn-primary btn-order btn-block">Tambah Cerita</a>
              </div>
            </div>

            <label class="order-toggle">
              <input type="checkbox" class="form-check-input" id="skipCerita" name="skipCerita">
              <span class="order-toggle-copy">Lewati bagian cerita untuk sekarang. Kamu masih bisa mengaktifkan dan mengisinya nanti dari dashboard.</span>
            </label>

            <div class="row justify-content-start mt-3 order-actions" >
              <div class="col">
                <div class="row">
                  
                  <div class="col-auto">
                    <a href="<?php echo base_url('order/3'); ?>" class="btn btn-secondary btn-order">Kembali</a>
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
