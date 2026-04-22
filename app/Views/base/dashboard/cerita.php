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
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Cerita</h3>
                </div>
                <div class="card-body">
                   
                    <form method="post" action="<?php echo base_url('user/update_cerita'); ?>">
                    <div id="konten-cerita" >
                    
                        <?php 
                            $jml_cerita = count($cerita);
                            for($i=0;$i < $jml_cerita;$i++){ 
                        ?>

                            <div id="cerita<?php echo $i+1 ?>" class="diulem-repeat-item cerita-item">
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
                                        <label>Tanggal</label>
                                        <input name="tanggal_cerita[]" type="text" class="form-control" placeholder="Contoh : 20 Februari 2020" value="<?= $cerita[$i]->tanggal_cerita ?>" required>
                                    </div>
                                </div>

                                <div class="row align-items-center mt-3">
                                    <div class="col">
                                        <label>Judul</label>
                                        <input name="judul_cerita[]" type="text" class="form-control" placeholder="Contoh : Ta'aruf" value="<?= $cerita[$i]->judul_cerita  ?>" required>
                                    </div>
                                </div>

                                <div class="row align-items-center mt-3">
                                    <div class="col">
                                        <label>Isi Cerita</label>
                                        <textarea name="isi_cerita[]" type="text" class="form-control" placeholder="Maximal 500 Karakter" maxlength="500" rows="4" required><?= $cerita[$i]->isi_cerita ?></textarea>
                                    </div>
                                </div>
                            </div>  

                        <?php 
                            }
                        ?>

                    </div>

                    <div class="row mt-2" >
                        <div class="col text-center">
                            <a id="addCerita" class="btn btn-primary w-100"><i class="ti ti-plus me-2"></i>Tambah Cerita</a>
                        </div>
                    </div>

                    <div class="col mt-3">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                    </form>        
                </div>
                


            </div>
        </div>
        <div class="col-xl-6 col-lg-6">
              <!-- Form Basic -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Quote Pernikahan</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                    <label>Quote Pernikahan</label>
                    <textarea id="quote" type="text" class="form-control" placeholder="Masukan Quote/Kutipan Pernikahan" required><?php if(!empty($quote)) echo $quote[0]->isi_quote ?></textarea>
                    </div>
                    <div class="form-group">
                    <label>Nama Sumber</label>
                    <input id="sumber_quote" type="text" class="form-control" placeholder="Masukan Nama Sumber Quote" value="<?php if(!empty($quote)) echo $quote[0]->sumber_quote ?>" required>
                    </div>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalQuote">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
</div>

<?= view('base/dashboard/components/confirm_modal', [
    'modalId' => 'modalQuote',
    'message' => 'Apakah kamu yakin ingin menyimpan quote pernikahan?',
    'confirmId' => 'simpanQuote',
    'confirmText' => 'Ya, Simpan',
    'confirmClass' => 'btn-primary',
]) ?>

<template id="ceritaTemplate">
    <div class="diulem-repeat-item cerita-item" id="cerita__INDEX__">
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
                <label>Tanggal</label>
                <input name="tanggal_cerita[]" type="text" class="form-control" placeholder="Contoh : 14 Januari 2020" required>
            </div>
        </div>
        <div class="row align-items-center mt-3">
            <div class="col">
                <label>Judul</label>
                <input name="judul_cerita[]" type="text" class="form-control" placeholder="Contoh : Pertama Bertemu" required>
            </div>
        </div>
        <div class="row align-items-center mt-3">
            <div class="col">
                <label>Isi Cerita</label>
                <textarea name="isi_cerita[]" type="text" class="form-control" placeholder="Maximal 500 Karakter" maxlength="500" rows="4" required></textarea>
            </div>
        </div>
    </div>
</template>

<script>

    var i = <?php echo $jml_cerita ?>;

    $(document).on('click', '.btn_remove', function(){  

       var button_id = $(this).attr("id");
       $('#cerita'+button_id+'').remove();  
       i--;

       if(i == 0){
        $("..form-control").prop('required',true);
       }

     });  

    $('#addCerita').click(function(){  

      i++;  

      $('#konten-cerita').append($('#ceritaTemplate').html().replace(/__INDEX__/g, i));  
        $(".form-control").prop('required',false);
    });
    
    $('#simpanQuote').on('click', function(event) {
      var $button = $(this);
      var quote = $('#quote').val();
      var sumber_quote = $('#sumber_quote').val();     
      DiulemDashboard.post("<?= base_url('user/act_quote') ?>", {
          quote: quote,
          sumber_quote: sumber_quote
      }, {
          button: $button,
          successMessage: 'Quote berhasil disimpan.',
          errorMessage: 'Quote gagal disimpan.'
      });

    });

</script>
