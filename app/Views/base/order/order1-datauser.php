<div class="konten" style="display: flex;flex-grow: 1;overflow-x: hidden;flex-direction: row;margin-top: 60px;margin-bottom: 40px;">
    <section class="fdb-block" style="padding-top: 20px;flex:1; ">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-md-8 col-lg-8 col-xl-6">
            <div class="row">
              <div class="col text-center">
                <h1 style="color: #3498db;margin-bottom:0px;">Hallo!</h1>
                <p tyle="font-size: 15px;font-weight:500; ">Hai kak! di isi dulu ya datanya </p>
              </div>
            </div>

            <form action="<?php echo base_url('order/2') ?>" method="post">
            <div class="row align-items-center mt-3"> 
              <div class="col">
                <label>Paket Undangan</label>
                <select class="form-control" id="id_paket" name="id_paket" required>
                    <option value=''>--Pilihan Paket Undangan--</option>
                    <?php foreach ($paket as $row) : ?>
                <?php $hargaPaket = (int) $row->harga_paket; ?>
                    <?php if ($row->id_paket == $id_paket) { ?>
                    <option value="<?= $row->id_paket ?>" selected><?= $hargaPaket <= 0 ? '[GRATIS] ' : '' ?>Paket <?= $row->nama_paket ?> - Harga <?= $hargaPaket <= 0 ? 'Gratis' : 'Rp ' . number_format($hargaPaket) ?></option>
                        <?php } else { ?>
                    <option value="<?= $row->id_paket ?>"><?= $hargaPaket <= 0 ? '[GRATIS] ' : '' ?>Paket <?= $row->nama_paket ?> - Harga <?= $hargaPaket <= 0 ? 'Gratis' : 'Rp ' . number_format($hargaPaket) ?></option>
                        <?php
                            }
                    endforeach; ?>
                </select>
                <small class="form-text text-muted">Paket gratis akan langsung aktif tanpa pembayaran.</small>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col mt-4">
                <label>Nama Domain / URL Undangan</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3"><?= DOMAIN_UNDANGAN ?>/</span>
                  </div>
                  <input name="domain" type="text" class="form-control" placeholder="akudandia"  value="<?php echo $domain; ?>"  onkeyup="nospaces(this)" required>
                </div>
                
              </div>
            </div>
            <div class="row align-items-center mt-3"> 
              <div class="col">
                <label>Email</label>
                <input name="email" type="email" class="form-control" placeholder="Email" value="<?php echo $email; ?>" required>
              </div>
            </div>
            <div class="row align-items-center mt-3">
              <div class="col">
                <label>Password</label>
                <input name="password" type="text" class="form-control" placeholder="Password" value="<?php echo $password; ?>" required>
              </div>
            </div>
            <div class="row align-items-center mt-3">
              <div class="col">
                <label>Nomer HP / WhatsApp</label>
                <input name="hp" type="text" class="form-control" placeholder="contoh : 628123456789" value="<?php echo $hp; ?>" required>
              </div>
            </div>
            <div class="row justify-content-start mt-4" >
              <div class="col">
                <div class="row">
                  <div class="col">
                    <!-- <a class="btn btn-primary btn-order btn-block" style="background-color: #3498db;">Lanjut</a> -->
                    <input class="btn btn-primary btn-order btn-block" type="submit" name="submit" value="Lanjut">
                  </div>
                </div>

                <div class="form-check mt-4" style="text-align: center;">
                  <label class="form-check-label">
                      I Read and Accept <a href="<?= base_url() ?>">Terms and Conditions</a>
                  </label>
                </div>
                
              </div>
            </div>
            </form>

          </div>
        </div>
      </div>
    </section>
</div>
