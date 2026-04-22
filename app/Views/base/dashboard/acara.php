<div class="page-body">
    <div class="container-xl">
        <div class="page-header d-print-none mb-3">
            <div class="row align-items-center">
                <div class="col">
                    <div class="page-pretitle">Konten Undangan</div>
                    <h1 class="page-title"><?= esc($title); ?></h1>
                </div>
            </div>
        </div>
    <div class="row row-cards">
    <div class="col-xl-6 col-lg-6">
              <form method="post" enctype="multipart/form-data" action="<?php echo base_url('user/set_countdown'); ?>">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Pengaturan Acara</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                    <label>Sebagai Countdown Acara</label>
                    <select class="form-control" id="id_acara" name="id_acara" required>
                            <option value=''>--Pilih Nama Acara--</option>
                            <?php foreach ($acara as $row) : ?>
                                <?php if ($row->set_countdown == 'Y') { ?>
                                    <option value="<?= $row->id_acara ?>" selected><?= $row->nama_acara ?></option>
                                <?php } else { ?>
                                    <option value="<?= $row->id_acara ?>"><?= $row->nama_acara ?></option>
                            <?php
                                }
                            endforeach; ?>
                        </select>
                    </div>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
              </div>
              </form>
        </div>
    <div class="col-xl-6 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Acara</h3>
            </div>
            <div class="card-body">
            <form method="post" action="<?php echo base_url('user/update_acara'); ?>">
                <div id="konten-acara" >
                                    
                <?php 
                 $jml_acara = count($acara);
                for($i=0;$i < $jml_acara;$i++){ 
                ?>
                    <div id="acara<?php echo $i+1 ?>" class="diulem-repeat-item acara-item">
                        <div class="row align-items-center mt-3">
                            <div class="col-auto">
                                <span class="diulem-repeat-number">#<?php echo $i+1 ?></span>
                            </div>
                            <div class="col-auto">
                                <button type="button" id="<?php echo $i+1 ?>" class="btn btn-sm btn_remove">Hapus</button>
                            </div>
                            
                        </div>
                    <!-- CONTENT DISINI -->
                        <div class="col mt-2">
                            <label>Nama Acara</label>
                            <input name="nama_acara[]" type="text" class="form-control" placeholder="Contoh : Akad Nikah" value="<?= $acara[$i]->nama_acara ?>" required>
                            <input name="set_countdown[]" type="hidden" class="form-control" value="<?= $acara[$i]->set_countdown ?>">
                        </div>
                        <div class="col mt-2">
                            <label>Tanggal </label>
                            <input type="text" class="form-control diulem-datepicker-input" id="datepicker<?= $i+1?>" placeholder="Tanggal" readonly="readonly" value="Jumat, 17 Januari 2020" required>
                            <input type="hidden" name="tgl_acara[]" id="tgl_acara<?= $i +1 ?>" value="<?= $acara[$i]->tgl_acara ?>">
                        </div>
        
                        <div class="col mt-2">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label>Waktu / Jam </label>
                                    <input name="waktu_mulai[]" type="time" class="form-control" placeholder="Contoh : 10.00 Pagi" value="<?= $acara[$i]->waktu_mulai ?>" required>
                                </div>
                                <div class="col-md-6">
                                  <label>Waktu / Jam </label>
                                  <input name="waktu_akhir[]" type="time" class="form-control" placeholder="Contoh : 10.00 Pagi" value="<?= $acara[$i]->waktu_akhir ?>" required>
                                </div>
                            </div>
                        </div>
                            
                        <div class="col mt-2">
                            <label>Tempat / Lokasi</label>
                            <input name="tempat_acara[]" type="text" class="form-control" placeholder="Contoh : Kediaman Mempelai Wanita " value="<?= $acara[$i]->tempat_acara ?>" required>
                        </div>
        
                        <div class="col mt-2">
                            <label>Alamat</label>
                            <textarea name="alamat_acara[]" type="text" class="form-control" placeholder="Contoh : JL. Ahmad Yani No.1"><?= $acara[$i]->alamat_acara ?></textarea>
                        </div>
                        <div class="col mt-2">
                            <label>Google Maps Link</label>
                            <textarea id="maps" name="maps[]" type="text" class="form-control"><?= $acara[$i]->maps ?></textarea>
                            <div class="mt-1">
                            <label class="form-check-label ">
                            <a class="diulem-help-link" href="<?php echo base_url('maps'); ?>"><i class="lni-question-circle"></i>&nbsp Cara Menambahkan Maps</a>
                            </label>
                                
                        </div>
                        </div>
                    </div>
                    <?php 
                }
            ?>
                </div>
           <div class="row mt-2" >
                        <div class="col text-center">
                            <a id="addAcara" class="btn btn-primary w-100"><i class="ti ti-plus me-2"></i>Tambah Acara</a>
                        </div>
                    </div>

                    <div class="col mt-3">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                    </form>        
                </div>
            </div>
        </div>
    </div>
</div>

<template id="acaraTemplate">
    <div class="diulem-repeat-item acara-item" id="acara__INDEX__">
        <div class="row align-items-center mt-3">
            <div class="col-auto">
                <span class="diulem-repeat-number">#__INDEX__</span>
            </div>
            <div class="col">
                <button type="button" id="__INDEX__" class="btn btn-sm btn_remove">Hapus</button>
            </div>
        </div>
        <div class="col mt-2">
            <label>Nama Acara</label>
            <input name="nama_acara[]" type="text" class="form-control" placeholder="Contoh : Akad Nikah" required>
            <input name="set_countdown[]" type="hidden" class="form-control" value="N">
        </div>
        <div class="col mt-2">
            <label>Tanggal</label>
            <input type="text" class="form-control diulem-datepicker-input" id="datepicker__INDEX__" placeholder="Tanggal" readonly="readonly" required>
            <input type="hidden" name="tgl_acara[]" id="tgl_acara__INDEX__" value="__DATE__">
        </div>
        <div class="col mt-2">
            <div class="form-row">
                <div class="col-md-6">
                    <label>Waktu Mulai</label>
                    <input name="waktu_mulai[]" type="time" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label>Waktu Selesai</label>
                    <input name="waktu_akhir[]" type="time" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="col mt-2">
            <label>Tempat / Lokasi</label>
            <input name="tempat_acara[]" type="text" class="form-control" placeholder="Contoh : Kediaman Mempelai Wanita" required>
        </div>
        <div class="col mt-2">
            <label>Alamat</label>
            <textarea name="alamat_acara[]" type="text" class="form-control" placeholder="Contoh : JL. Ahmad Yani No.1"></textarea>
        </div>
        <div class="col mt-2">
            <label>Google Maps Link</label>
            <textarea id="maps" name="maps[]" type="text" class="form-control" required></textarea>
            <div class="mt-1">
                <label class="form-check-label">
                    <a class="diulem-help-link" href="<?= base_url('maps'); ?>"><i class="lni-question-circle"></i>&nbsp Cara Menambahkan Maps</a>
                </label>
            </div>
        </div>
    </div>
</template>

<script src="<?php echo base_url() ?>/assets/base/js/pikaday.js"></script>
<script>
    
    $(document).ready(function () {
    var i = <?php echo $jml_acara ?>;
    let picker = [];
    function initAcaraDatepicker(index) {
        moment.locale('id');
        var tgl = $('#tgl_acara'+index+'').val();
        $('#datepicker'+index+'').val(moment(tgl).format('dddd, Do MMMM YYYY'));
        picker[index] = new Pikaday({ 
          format: 'dddd, Do MMMM YYYY',
          field: $('#datepicker'+index+'')[0],
          onSelect: function() {
            $('#tgl_acara'+index+'').val(this.getMoment().format('YYYY/MM/DD'));
          }
        });
    }

    for(let a = 1; a < i+1; a++){
        initAcaraDatepicker(a);
    }
   
    $(document).on('click', '.btn_remove', function(){  

       var button_id = $(this).attr("id");
       $('#acara'+button_id+'').remove();  
       i--;

       if(i == 0){
        $(".form-control").prop('required',true);
       }

     });  

    $('#addAcara').click(function(){  

      i++;  
        var d = new Date();
        var strDate = d.getFullYear() + "/" + (d.getMonth()+1) + "/" + d.getDate();
      $('#konten-acara').append($('#acaraTemplate').html().replace(/__INDEX__/g, i).replace(/__DATE__/g, strDate));
      initAcaraDatepicker(i);
        $(".form-control").prop('required',false);
    });
});
</script>
