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
                    <h3 class="card-title">Data Gallery</h3>
                </div>
                <div class="card-body">

                    <div class="upload-area-bg">
                        <div class="upload-area do-add-btn">
                            <div class="upload-area-inner">
                                <div class="upload-area-icon-main">
                                    <i class="lni-cloud-download"></i>
                                </div>
                                <h3 class="upload-area-caption">
                                    <span>Upload Foto Gallery</span>
                                </h3>
                                <p>Drag file ke sini atau pilih dari perangkat. Maksimal 10 foto, 2MB per foto.</p>
                                <button class="upload-area-button btn btn-primary diulem-upload-button" type="button">
                                    <i class="ti ti-upload me-2"></i><span>Pilih Foto</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="diulem-loading-wrap">
                        <img id="loading" class="diulem-loading-img" src="<?= base_url() ?>/assets/base/img/loading.svg" alt="Memuat" />
                    </div>
                    <div id="previewss">
                        <?php 
                            $kunci = $data[0]->kunci;
                            for($a=1;$a<=10;$a++){
                                $pathName = 'assets/users/'.$kunci.'/album'.$a.'.png';
                                if(!file_exists($pathName))continue;
                        ?>

                        <div class="preview-uploads" id="preview<?= $a ?>">
                            <div class="preview-uploads-img">
                                <span class="preview">
                                <img id="img<?= $a ?>" src="<?= base_url() ?>/assets/users/<?= $kunci ?>/album<?= $a ?>.png" alt="album<?= $a ?>" />
                                </span>
                            </div>
                            <div class="preview-uploads-name">
                            <p class="name fw-bold">album<?= $a; ?></p>
                            <strong class="error text-danger" data-dz-errormessage></strong>
                            <p class="size text-secondary">-</p>     
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
            </div>
        </div>

        <div class="col-xl-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Video</h3>
                </div>
                <div class="card-body">
                    <label>Youtube Link</label>
                    <textarea id="video" type="text" class="form-control" placeholder="Contoh : https://youtu.be/zlKzyYnhu-s" required><?= $data[0]->video ?></textarea>
                    <div class="mt-1">
                    <label class="form-check-label ">
                      <a class="diulem-help-link" href="<?php echo base_url('youtube'); ?>"><i class="lni-question-circle"></i>&nbsp Cara Menambahkan Video</a>
                    </label>
                    </div>
                    <div class="col mt-3">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalVideo">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
</div>
</div>

<?= view('base/dashboard/components/confirm_modal', [
    'modalId' => 'modalVideo',
    'message' => 'Apakah kamu yakin ingin menyimpan video undangan?',
    'confirmId' => 'simpanVideo',
    'confirmText' => 'Ya, Simpan',
    'confirmClass' => 'btn-primary',
]) ?>

<script src="<?php echo base_url() ?>/assets/base/js/dropzone.js"></script>
<script>

var myDropzone = new Dropzone(document.body, { 
  url: "<?php echo base_url('user/update_gallery'); ?>", 
  paramName: "file",
  acceptedFiles: 'image/*',
  autoQueue: true,
  maxFilesize: 2,  //ukuran maksimal foto 
  clickable: ".do-add-btn" 
});

myDropzone.on("success", function(file,response){
    $('.dz-preview').remove();

    if(response == ""){
      DiulemDashboard.notify('warning', 'Batas Upload', 'Maksimal 10 foto gallery.');

    }else{
      var aql = JSON.parse(response);
      $("#previewss").prepend('<div id="preview'+aql.no+'" class="file-row preview-uploads"><div class="preview-uploads-img"><span class="preview"><img id="img3" src="<?= base_url() ?>/assets/users/'+aql.kunci+'/album'+aql.no+'.png" alt="album'+aql.no+'" /></span></div><div class="preview-uploads-name"><p class="name fw-bold" data-dz-name>album'+aql.no+'</p><strong class="error text-danger"></strong><p class="size text-secondary">-</p></div><div class="preview-uploads-delete"><button id="'+aql.no+'" class="btn btn-danger delete btnhehe">Hapus</button></div></div>');
    }
    $('#loading').hide();
});

myDropzone.on("sending", function(file, xhr, formData) {
  $('.dz-preview').remove();
  formData.append("kunci", "<?= $kunci ?>");
  $('#loading').show();
});


myDropzone.on("error", function(file, response) {
  $('.dz-preview').remove();
  $('#loading').hide();
  var message = typeof response === 'string' ? response : 'Maksimal file 2MB dan harus berupa gambar.';
  DiulemDashboard.notify('error', 'Upload Gagal', message);
});

$(document).on('click', '.btnhehe', function(){  

  var button_id = $(this).attr("id");
  var kunci = "<?= $kunci ?>";
  DiulemDashboard.post('<?= base_url('user/del_gallery') ?>', {
     id: button_id,
     kunci: kunci
  }, {
     button: $(this),
     reload: false,
     errorMessage: 'Foto gagal dihapus.',
     onSuccess: function() {
        $('#preview'+button_id).remove();
     }
  });
   
});

$('#simpanVideo').on('click', function(event) {
    var $button = $(this);
    var video = $('#video').val();
    DiulemDashboard.post("<?= base_url('user/update_video') ?>", {
        video: video
    }, {
        button: $button,
        successMessage: 'Video berhasil disimpan.',
        errorMessage: 'Video gagal disimpan.'
    });

});



</script>
