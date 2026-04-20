<div class="page-body">
<div class="container-xl">
    <div class="page-header d-print-none mb-3">
        <div class="row align-items-center">
            <div class="col">
                <div class="page-pretitle">Transaksi</div>
                <h1 class="page-title"><?= esc($title); ?></h1>
            </div>
            <div class="col-auto">
                <a href="<?= rtrim(SITE_UNDANGAN, '/') ?>/<?= esc($order[0]->domain) ?>" target="_blank" class="btn btn-primary">
                    <i class="ti ti-external-link me-2"></i>Lihat Website
                </a>
            </div>
        </div>
    </div>

    <div class="row row-cards">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <?php 
                    $metode_bayar = $setting_bayar[0]->metode_bayar;
                    $masa_aktif = $order[0]->masa_aktif;
                    $trial = $setting[0]->trial;
                    $durasi = '+'.$trial.' days';
                    $tglDaftar = $order[0]->created_at;
                    $tglExp = strtotime($durasi, strtotime($tglDaftar));
                    $tglExpFormated = date("d-m-Y H:i A",$tglExp);
                    $today = strtotime('now');
                    $tglBayar =  $pembayaran[0]->tglBayar;
                    $expiry = strtotime($pembayaran[0]->transaction_expired);
                    $expiry_date = date("d-m-Y H:i A",$expiry);
                    $aktif = '+'.$masa_aktif.' days';
                    $tglNonaktif = strtotime($aktif, strtotime( $tglBayar));
                    $tglNonaktifFormated = date("d-m-Y H:i A", $tglNonaktif );
                    $instruction = json_decode($pembayaran[0]->instruction);
                    if($pembayaran[0]->status == 0){ ?>
                    <div class="alert alert-danger mb-0">Invoice: masa trial anda akan berakhir pada tanggal <?= esc($tglExpFormated) ?>. Segera lakukan pembayaran.</div>
                    <?php }else if($pembayaran[0]->status == 1){ 
                    if($metode_bayar == 'manual') {?>
                    <div class="alert alert-warning mb-0">Invoice: pembayaran anda menunggu konfirmasi.</div>
                    <?php }else{ ?>
                    <div class="alert alert-warning mb-0">Invoice: selesaikan pembayaran anda sebelum <?= esc($expiry_date) ?>.</div>
                    <?php }
                    } else if($pembayaran[0]->status == 2 && $today >= $tglNonaktif ){ 
                    ?>
                    <div class="alert alert-danger mb-0">Masa aktif undangan sudah habis pada tanggal <?= esc($tglNonaktifFormated) ?>. Silahkan lakukan pembayaran lagi untuk memperpanjang masa aktif undangan.</div>
                    <?php }else{ ?>
                    <div class="alert alert-success mb-0">Undangan anda aktif sampai tanggal <?= esc($tglNonaktifFormated) ?>.</div>
                    <?php } ?>
               </div>
            </div>
        </div>
    

        <div class="col-xl-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Tagihan Pembayaran</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Kode Pesanan</label>
                        <div class="upload-area-bg" style="margin-top: 5px;text-align: center;background: #f1f2f6 !important;">                       
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                    <a style="font-size: 16px;text-transform: uppercase;color: #2c3e50;font-weight:600;" >#<?= $pembayaran[0]->invoice ?></a>
                                    </div>
                                    <div class="col-auto">
                                    <?php if($pembayaran[0]->status == 2){ 
                                    if($pembayaran[0]->status == 2 && $today >= $tglNonaktif ){ ?>
                                        <button id="re_order" class="btn-danger btn-sm btn" title="refresh perpanjangan"><i class="fas fa-sync-alt" aria-hidden="true"></i></button>
                                        <button  class="btn-alert btn-sm btn" >Tidak Aktif</button>
                                    <?php } else { ?>
                                        <button  class="btn-success btn-sm btn" >Lunas</button>
                                    <?php }
                                    }else if($pembayaran[0]->status == 1){ ?>
                                        <button id="refresh" class="btn-danger btn-sm btn" title="refresh pembayaran"><i class="fas fa-sync-alt" aria-hidden="true"></i></button>
                                        <?php if($metode_bayar == 'manual'){?>
                                        <button class="btn-warning btn-sm btn" >Menunggu Konfirmasi</button>
                                        <?php }else { if ($pembayaran[0]->status == 1 && $today >= $expiry ) { ?>
                                        <button class="btn-danger btn-sm btn" >Silahkan Refresh Invoice</button>
                                        <?php }else{ 
                                        ?>
                                        <button class="btn-warning btn-sm btn" >Menunggu Pembayaran</button>
                                    <?php }
                                        }
                                    }else if($pembayaran[0]->status == 0){ ?>
                                        <button id="refresh" class="btn-danger btn-sm btn" title="refresh pembayaran"><i class="fas fa-sync-alt" aria-hidden="true"></i></button>
                                        <button class="btn-warning btn-sm btn" >Belum Lunas</button>
                                    <?php } ?>
                                    <button id="paket" class="btn-primary btn-sm btn" title="ubah paket"  data-toggle="modal" data-target="#modalPaket"><i class="fas fa-pen-square"></i></button>
                                    </div>
                                </div>   
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Total Tagihan</label>
                        <div class="upload-area-bg" style="margin-top: 5px;text-align: center;background: #f1f2f6;">
                            <a style="font-size: 18px;color: #2c3e50;font-weight:bolder" ><?= rupiah($pembayaran[0]->harga) ?></a>
                        </div>
                    </div>
                    <form id="payment-form" method="post" action="<?= base_url('user/finish') ?>">
                        <input type="hidden" name="result_type" id="result-type" value="">
                        <input type="hidden" name="result_data" id="result-data" value="">
                    </form>
                    <?php if($pembayaran[0]->status == 2 && $today >= $tglNonaktif ){ ?>
                    <button class="btn btn-primary btn-block" id="pay-button">Perpanjangan</button>
                    <?php }else if($pembayaran[0]->status == 2){ ?>
                        <button class="btn btn-primary btn-block" id="pay-button" disabled>Lunas</button>
                    <?php }else if($pembayaran[0]->status == 1){ 
                            if($metode_bayar == 'manual') {?> 
                        <button class="btn btn-primary btn-block" disabled>Menunggu Konfirmasi</button>
                        <?php }else{ ?>
                        <button class="btn btn-primary btn-block" id="pay-button" disabled>Menunggu Pembayaran</button>
                    <?php }
                    }else if($pembayaran[0]->status == 0){ 
                            if($metode_bayar == 'manual') {?>
                        <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalKonfirmasi">Konfirmasi</button>
                        <?php }else if ($metode_bayar == 'midtrans'){ ?>
                        <button class="btn btn-primary btn-block" id="pay-button">Pembayaran</button>
                    <?php } else{ ?>
                        <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalTripay">Pembayaran Tagihan</button>
                    <?php }
                    }?>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6" style="<?php if($metode_bayar == 'manual') { echo 'display:block'; } else { if($pembayaran[0]->status != 0){ echo 'display:block'; } else{ echo 'display:none'; } }?>">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Rekening Pembayaran</h3>
                </div>
                <div class="card-body">
                    <?php if($metode_bayar == 'manual') { ?>
                    <div class="form-group">
                        <label>Nama Bank</label>
                        <div class="upload-area-bg d-flex justify-content-between" style="margin-top: 5px;text-align: center;background: #f1f2f6;">
                            <img src="<?= base_url() ?>/assets/base/img/bank.png" height="40px" width="80px">      
                            <a style="font-size: 16px;text-transform: uppercase;color: #2c3e50;" ><?= $setting_bayar[0]->bank_manual ?></a>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Nomor Rekening</label>
                        <div class="upload-area-bg d-flex justify-content-between" style="margin-top: 5px;text-align: center;background: #f1f2f6;">
                            <a style="font-size: 18px;text-transform: uppercase;color: #2c3e50;" ><span id="norek"><?= $setting_bayar[0]->norek_manual ?></span></a>   
                            <button class="btn btn-sm btn-secondary" onclick="copyToClipboard('#norek')">Salin</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Atas Nama</label>
                        <div class="upload-area-bg" style="margin-top: 5px;text-align: center;background: #f1f2f6;">
                            <a style="font-size: 18px;text-transform: uppercase;color: #2c3e50;" ><?= strtoupper($setting_bayar[0]->nama_manual) ?></a>   
                        </div>
                    </div>
                    <?php } else {?>
                    <div class="form-group">
                        <label>Nama Bank</label>
                        <div class="upload-area-bg d-flex justify-content-between" style="margin-top: 5px;text-align: center;background: #f1f2f6;">
                            <a style="font-size: 16px;text-transform: uppercase;color: #2c3e50;" ><?= $pembayaran[0]->nama_bank ?></a>
                        </div>
                    </div>
                    <?php if($pembayaran[0]->payment_type=='echannel') {?>
                    <div class="form-group">
                        <label>Biller Code</label>
                        <div class="upload-area-bg d-flex justify-content-between" style="margin-top: 5px;text-align: center;background: #f1f2f6;">
                            <a style="font-size: 18px;text-transform: uppercase;color: #2c3e50;" ><span id="biller_code"><?= $pembayaran[0]->biller_code ?></span></a>   
                            <button class="btn btn-sm btn-secondary" onclick="copyToClipboard('#biller_code')">Salin</button>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="form-group">
                        <label>Nomor Rekening</label>
                        <div class="upload-area-bg d-flex justify-content-between" style="margin-top: 5px;text-align: center;background: #f1f2f6;">
                            <a style="font-size: 18px;text-transform: uppercase;color: #2c3e50;" ><span id="norek"><?= $pembayaran[0]->va_number ?></span></a>   
                            <button class="btn btn-sm btn-secondary" onclick="copyToClipboard('#norek')">Salin</button>
                        </div>
                    </div>
                    <?php } if($metode_bayar == 'tripay' && !empty($instruction)){ ?>
                    <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalPembayaran">Cara Pembayaran</button>
                    <?php } ?>
                </div>
               
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalMenunggu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       Pembayaran anda sudah kami terima.<br>Mohon tunggu tim kami sedang melakukan verifikasi..
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modalKonfirmasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> 
      <form method="POST" enctype="multipart/form-data"  action="<?php echo base_url('user/konfirmasi'); ?>">
      <div class="modal-body">
        <div class="col mt-2">
            <label>Nama Lengkap</label>
            <input name="nama_lengkap" type="text" class="form-control" placeholder="Contoh : Dinda Rahma" value="" required>
        </div>
        <div class="col mt-2">
            <label>Nama Bank</label>
            <input name="nama_bank" type="text" class="form-control" placeholder="Contoh : BRI " value="" required>
        </div>        
        <div class="col mt-2 mb-2">
            <label>Bukti Transfer (max 2MB)</label>
            <input type="file"  id="bukti" name="bukti">
        </div>
        <input type="hidden"  value="<?= $pembayaran[0]->invoice ?>" name="invoice">
        </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-primary" id="simpanKonfimasi">Konfirmasi</button>
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
      </div>
      
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="modalTripay" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pilih Metode Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> 
      <form method="POST" enctype="multipart/form-data"  action="<?php echo base_url('user/pembayaran_tripay'); ?>">
      <div class="modal-body">
        <div class="col mt-2">
            <select class="form-control" id="metode_bayar" name="metode_bayar" required>
                <option value=''>--METODE PEMBAYARAN--</option>
                <option value='PERMATAVA'>Permata Virtual Account</option>
                <option value='BNIVA'>BNI Virtual Account</option>
                <option value='BRIVA'>BRI Virtual Account</option>
                <option value='MANDIRIVA'>Mandiri Virtual Account</option>
                <option value='BCAVA'>BCA Virtual Account</option>
                <option value='CIMBVA'>CIMB Virtual Account</option>
                <option value='BSIVA'>BSI Virtual Account</option>
                <option value='DANAMONVA'>Danamon Virtual Account</option>
            </select>
        </div>
        </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-primary">Pembayaran</button>
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
      </div>
 
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="modalPembayaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cara Pembayaran <?= $pembayaran[0]->nama_bank ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> 
      <div class="modal-body">
      <!-- Accordion -->
      <div id="accordionExample" class="accordion shadow">
        <?php $data = json_decode($pembayaran[0]->instruction); 
            if(!empty($data)){
            $i = 0;
            foreach($data as $detail) {?>
        <!-- Accordion item 1 -->
        <div class="card">
            
          <div id="heading<?= $i+1; ?>" class="card-header bg-white shadow-sm border-0">
            <h6 class="mb-0 font-weight-bold"><a href="#" data-toggle="collapse" data-target="#collapse<?= $i+1; ?>" aria-expanded="false" aria-controls="collapse<?= $i+1; ?>" class="d-block position-relative text-dark text-uppercase collapsible-link py-2"><?= $detail->title ?></a></h6>
          </div>
          <div id="collapse<?= $i+1; ?>" aria-labelledby="headingOne" data-parent="#accordionExample" class="collapse">
            <div class="card-body">
                <ul>
                    <li><?= implode("</li><li>", $detail->steps) ?></li>
                </ul>
            </div>
          </div>
        </div>
        
        <?php $i++; } }?>


      </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modalPaket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Paket Undangan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> 
      <form method="POST" enctype="multipart/form-data"  action="<?php echo base_url('user/update_paket'); ?>">
      <div class="modal-body">
        <div class="col mt-2">
            <label>Paket Undangan</label>
                <select class="form-control" id="id_paket" name="id_paket" required>
                    <option value=''>--Pilihan Paket Undangan--</option>
                    <?php foreach ($paket as $row) : ?>
                    <option value="<?= $row->id_paket ?>" >Paket <?= $row->nama_paket ?> - Harga Rp <?= number_format($row->harga_paket) ?></option>
                    <?php endforeach; ?>
                </select>
        </div>
        </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-primary">Pilih Paket</button>
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
      </div>
 
      </form>
    </div>
  </div>
</div>
<script type="text/javascript" src="<?= $urlMidtrans ?>" data-client-key="<?= $clientKey ?>"></script>
<script type="text/javascript">
    $('#pay-button').click(function(event) {
        event.preventDefault();
        $(this).attr("disabled", "disabled");
        $.ajax({
            url: '<?= base_url('user/token') ?>',
           cache: false,

            success: function(data) {
                //location = data;

                console.log('token = ' + data);

                var resultType = document.getElementById('result-type');
                var resultData = document.getElementById('result-data');

                function changeResult(type, data) {
                    $("#result-type").val(type);
                    $("#result-data").val(JSON.stringify(data));
                    //resultType.innerHTML = type;
                    //resultData.innerHTML = JSON.stringify(data);
                }

                snap.pay(data, {
                    onSuccess: function(result) {
                        changeResult('success', result);
                        console.log(result.status_message);
                        console.log(result);
                        $("#payment-form").submit();
                    },
                    onPending: function(result) {
                        changeResult('pending', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();
                    },
                    onError: function(result) {
                        changeResult('error', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();
                    }
                });
            }
        });
    });
    $('#refresh').on('click', function(event) {
        $.ajax({
            url : "<?= base_url('user/refresh_invoice') ?>",
            method : "POST",
            async : true,
            dataType : 'html',
            success: function($hasil){
               if($hasil == 'sukses'){
                location.reload();
               }
            }
        });
    });
    $('#re_order').on('click', function(event) {
        $.ajax({
            url : "<?= base_url('user/re_order') ?>",
            method : "POST",
            async : true,
            dataType : 'html',
            success: function($hasil){
               if($hasil == 'sukses'){
                location.reload();
               }
            }
        });
    });
</script>
