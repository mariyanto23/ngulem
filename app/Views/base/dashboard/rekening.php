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
    <?php 
    clearstatcache();
        $kunci = $data[0]->kunci;
    ?>
    <div class="row row-cards">

        <div class="col-xl-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Rekening</h3>
                </div>
                <div class="card-body">
                   <?= form_open_multipart(base_url('user/update_rekening')); ?>
                    <div id="konten-rekening" >
                    
                        <?php 
                            $jml_rekening = count($rekening);
                            for($i=0;$i < $jml_rekening;$i++){ 
                        ?>

                            <div id="rekening<?php echo $i+1 ?>" class="diulem-repeat-item rekening-item">
                                <div class="row align-items-center mt-3">
                                    <div class="col-auto">
                                        <span class="diulem-repeat-number">#<?php echo $i+1 ?></span>
                                    </div>
                                    <div class="col">
                                        <button type="button" id="<?php echo $i+1 ?>" class="btn btn-sm btn_remove">Hapus</button>
                                    </div>
                                </div>

                                <div class="row align-items-center">
                                    <div class="col">
                                        <label>Nama Bank</label>
                                        <input name="nama_bank[]" type="text" class="form-control" placeholder="Contoh : BANK NEGARA INDONESIA" value="<?= $rekening[$i]->nama_bank ?>" required>
                                    </div>
                                </div>

                                <div class="row align-items-center mt-3">
                                    <div class="col">
                                        <label>No Rekening</label>
                                        <input name="no_rekening[]" type="text" class="form-control" placeholder="Contoh : 0123456" value="<?= $rekening[$i]->no_rekening  ?>" required>
                                    </div>
                                </div>

                                <div class="row align-items-center mt-3">
                                    <div class="col">
                                        <label>Nama Pemilik</label>
                                        <input name="nama_pemilik[]" type="text" class="form-control" placeholder="Contoh : Admin" value="<?= $rekening[$i]->nama_pemilik  ?>" required>
                                    </div>
                                </div>
                                <div class="row align-items-center mt-3">
                                     <div class="col">
                                        <div class="row">
                                            <div class="col-12 col-md-6 col-lg-6 d-flex align-items-center justify-content-center">
                                                <div class="upload-area diulem-mempelai-upload">
                                           
                                                <img class="diulem-mempelai-photo" <?php if(!empty($rekening[$i]->qrcode_bank)) { ?> src="<?= base_url() ?>/assets/users/<?= $kunci ?>/rekening/<?= $rekening[$i]->qrcode_bank ?>" <?php } ?> id="img_qrcode<?= $i+1 ?>" alt="QR rekening"> 
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-6 d-flex align-items-center justify-content-center mt-3">
                                                <div class="btn btn-primary">
                                                    <input type="hidden" name="nama_qrcode[]" value="<?= $rekening[$i]->qrcode_bank ?>">
                                                    <input type="file" class="file-upload" id="qrcode<?= $i+1 ?>"  name="qrcode_picture[]" accept="image/*" onchange="preview_image(event)" > Upload Foto
                                                </div>
                                            </div>
                                        </div>   
                                    </div>
                                </div>
                            </div>  

                        <?php 
                            }
                        ?>

                    </div>

                    <div class="row mt-2" >
                        <div class="col text-center">
                            <a id="addRekening" class="btn btn-primary btn-order btn-order-secondary btn-block">Tambah Rekening</a>
                        </div>
                    </div>

                    <div class="col mt-3">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                    <?= form_close() ?>     
                </div>
                


            </div>
        </div>

    </div>
    </div>
</div>

<template id="rekeningTemplate">
    <div class="diulem-repeat-item rekening-item" id="rekening__INDEX__">
        <div class="row align-items-center mt-3">
            <div class="col-auto">
                <span class="diulem-repeat-number">#__INDEX__</span>
            </div>
            <div class="col">
                <button type="button" id="__INDEX__" class="btn btn-sm btn_remove">Hapus</button>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col">
                <label>Nama Bank</label>
                <input name="nama_bank[]" type="text" class="form-control" placeholder="Contoh : BANK NEGARA INDONESIA" required>
            </div>
        </div>
        <div class="row align-items-center mt-3">
            <div class="col">
                <label>No Rekening</label>
                <input name="no_rekening[]" type="text" class="form-control" placeholder="Contoh : 123456" required>
            </div>
        </div>
        <div class="row align-items-center mt-3">
            <div class="col">
                <label>Nama Pemilik</label>
                <input name="nama_pemilik[]" type="text" class="form-control" placeholder="Contoh : Admin" required>
            </div>
        </div>
        <div class="row align-items-center mt-3">
            <div class="col">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6 d-flex align-items-center justify-content-center">
                        <div class="upload-area diulem-mempelai-upload">
                            <img class="diulem-mempelai-photo" id="img_qrcode__INDEX__" alt="QR rekening">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 d-flex align-items-center justify-content-center mt-3">
                        <div class="btn btn-primary">
                            <input type="hidden" name="nama_qrcode[]">
                            <input type="file" class="file-upload" id="qrcode__INDEX__" name="qrcode_picture[]" accept="image/*" onchange="preview_image(event)"> Upload Foto
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    function preview_image(event) 
    {
    var id = event.target.id;
     var reader = new FileReader();
     reader.onload = function()
     {
      var output = document.getElementById('img_'+id);
      output.src = reader.result;
     }
     reader.readAsDataURL(event.target.files[0]);
    }
    var i = <?php echo $jml_rekening ?>;

    $(document).on('click', '.btn_remove', function(){  

       var button_id = $(this).attr("id");
       $('#rekening'+button_id+'').remove();  
       i--;

       if(i == 0){
        $("..form-control").prop('required',true);
       }

     });  

    $('#addRekening').click(function(){  

      i++;  

      $('#konten-rekening').append($('#rekeningTemplate').html().replace(/__INDEX__/g, i));  
        $(".form-control").prop('required',false);
    });

</script>
