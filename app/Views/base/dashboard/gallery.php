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
                                    <span>Drag and drop files here</span>
                                </h3>
                                <p>or</p>
                                <button class="upload-area-button btn diulem-upload-button">
                                    <span>Browse files</span>
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
    if(response == ""){
      $('.dz-preview').remove();
      alert('Batas Upload 10 Foto!');

    }else{
      var aql = JSON.parse(response);
      $('.dz-preview').remove();
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
  alert('Maximal File = 2MB!');
  $('#loading').hide();
});

$(document).on('click', '.btnhehe', function(){  

  var button_id = $(this).attr("id");
  var kunci = "<?= $kunci ?>";
  $.ajax({
     type: 'POST',
     url: '<?= base_url('user/del_gallery') ?>',
     data: {id: button_id,kunci: kunci},
     success: function(data){
        $('#preview'+button_id).remove();
     },
     error: function() {
        DiulemDashboard.notify('error', 'Gagal', 'Foto gagal dihapus.');
     }
  });
   
});

$('#simpanVideo').on('click', function(event) {
    var $button = $(this);
    var video = $('#video').val();
    DiulemDashboard.setButtonLoading($button, true, '<i class="ti ti-loader me-2"></i>Menyimpan...');
    $.ajax({
        url : "<?= base_url('user/update_video') ?>",
        method : "POST",
        data : {video: video},
        async : true,
        dataType : 'html',
        success: function($hasil){
            DiulemDashboard.reloadAfterSuccess($hasil, 'Video berhasil disimpan.', 'Video gagal disimpan.');
        },
        error: function() {
            DiulemDashboard.notify('error', 'Gagal', 'Video gagal disimpan.');
        },
        complete: function() {
            DiulemDashboard.setButtonLoading($button, false);
        }
    });

});



</script>
