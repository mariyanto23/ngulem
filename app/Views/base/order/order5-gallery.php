<div class="konten order-page">
    <section class="fdb-block">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-md-8 col-lg-8 col-xl-6 order-panel">
            <div class="order-hero">
              <div class="order-step-badge">Langkah 5 dari 6</div>
              <h1>Galeri Foto</h1>
              <p>Upload beberapa foto terbaik. Maksimal 10 foto, dan masing-masing sampai 2MB.</p>
            </div>
            
            <div class="progress">
              <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
            </div>

            <div id="konten-gallery">
              
              <!-- <form action="" method="post" enctype="multipart/form-data"> -->
                <div class="row align-items-center mt-4">
                   <label class="order-upload-label">Upload Foto Galeri</label>
                  <div class="upload-area-bg">
                    
                    <div class="upload-area do-add-btn">
                      <div class="upload-area-inner">
                        <div class="upload-area-icon-main">
                          <i class="lni-cloud-download"></i>
                        </div>
                        <h3 class="upload-area-caption">
                          <span>Drag and drop files here</span>
                        </h3>
                        <p>atau</p>
                        <button class="upload-area-button btn " style="z-index:9999;">
                          <span>Pilih Foto</span>
                        </button>
                        <p class="order-upload-caption">Tampilkan momen terbaik kalian di undangan.</p>
                      </div>
                    </div>

                  </div>

                </div>
              <!-- </form> -->
              <div style="text-align: center;">
                <img id="loading" src="<?= base_url() ?>/rev/suzuran/loading.svg"  style="height: 30px;width: 30px; display: none;" />
              </div>
              <div id="previewss">
                  <?php 
                    $generate = $_SESSION['dummy'];
                    for($a=1;$a<=10;$a++){
                      $pathName = 'assets/users/'.$generate.'/album'.$a.'.png';
                      if(!file_exists($pathName))continue;
                  ?>

                  <div class="preview-uploads" id="preview<?= $a ?>">
                    <div class="preview-uploads-img">
                        <span class="preview">
                          <img id="img<?= $a ?>" src="<?= base_url() ?>/assets/users/<?= $generate ?>/album<?= $a ?>.png"  style="height: 100%;object-position: center;object-fit: cover;width: 100%;"  />
                        </span>
                    </div>
                    <div class="preview-uploads-name">
                      <b><p class="name" style="line-height: revert;font-size: 12px;" >album<?= $a; ?></p></b>
                      <strong class="error text-danger" style="line-height: revert;font-size: 12px;"  data-dz-errormessage></strong>
                      <p class="size" style="line-height: revert;font-size: 12px;"  >-</p>     
                    </div>
                    <div  class="preview-uploads-delete">
                      <button id="<?= $a ?>" data-dz-remove class="btn btn-danger delete btnhehe">
                         Hapus
                      </button>
                    </div>
                  </div>

                  <?php
                    }
                  ?>
              </div>
          </div>

            <form method="post" action="<?= base_url('order/finish'); ?>">
              <label class="order-toggle">
                <input type="checkbox" class="form-check-input" id="skipGallery" name="skipGallery">
                <span class="order-toggle-copy">Lewati galeri untuk sekarang. Kamu bisa upload foto nanti setelah undangan aktif.</span>
              </label>

              <div class="row justify-content-start mt-3 order-actions" >
                <div class="col">
                  <div class="row">
                    <div class="col-auto">
                      <a href="<?= base_url('order/4') ?>" class="btn btn-secondary btn-order">Kembali</a>
                    </div>
                    <div class="col">
                      <input type="submit" name="submit" class="btn btn-primary btn-order btn-block" style="background-color: #3498db;" value="Lanjut">
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
