<div class="page-body">
    <div class="container-xl">
        <div class="page-header d-print-none mb-3">
            <div class="row align-items-center">
                <div class="col">
                    <div class="page-pretitle">Buku Tamu</div>
                    <h1 class="page-title"><?= esc($title); ?></h1>
                </div>
                <div class="col-auto">
                    <a href="<?= rtrim(SITE_BUKUTAMU, '/') ?>/<?= esc($order[0]->domain) ?>" target="_blank" class="btn btn-primary">
                        <i class="ti ti-external-link me-2"></i>Lihat Website
                    </a>
                </div>
            </div>
        </div>

        <?php
        clearstatcache();
        $kunci = $data[0]->kunci;
        $background = "/assets/users/".$kunci."/bg-tamu.png";
        ?>

        <div class="row row-cards">
            <div class="col-xl-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Slider Buku Tamu</h3>
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
                            <img id="loading" class="diulem-loading-img" src="<?= base_url() ?>/assets/base/img/loading.svg" alt="Memuat">
                        </div>

                        <div id="previewss">
                            <?php for ($a = 1; $a <= 10; $a++) {
                                $pathName = 'assets/users/'.$kunci.'/slider'.$a.'.png';
                                if (! file_exists($pathName)) {
                                    continue;
                                }
                            ?>
                            <div class="preview-uploads" id="preview<?= $a ?>">
                                <div class="preview-slider-img">
                                    <span class="preview">
                                        <img id="img<?= $a ?>" src="<?= base_url() ?>/assets/users/<?= $kunci ?>/slider<?= $a ?>.png" alt="slider<?= $a ?>">
                                    </span>
                                </div>
                                <div class="preview-uploads-name">
                                    <p class="name fw-bold">slider<?= $a; ?></p>
                                    <strong class="error text-danger" data-dz-errormessage></strong>
                                    <p class="size text-secondary">-</p>
                                </div>
                                <div class="preview-uploads-delete">
                                    <button id="<?= $a ?>" data-dz-remove class="btn btn-danger delete btnhehe">Hapus</button>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Background Buku Tamu</h3>
                    </div>
                    <div class="card-body">
                        <?= form_open_multipart(base_url('user/update_background_bukutamu')); ?>
                        <div class="upload-area-bg diulem-upload-center">
                            <div class="row align-items-center">
                                <div class="col-12 col-md-8 d-flex align-items-center justify-content-center">
                                    <div class="upload-area diulem-bukutamu-bg-upload">
                                        <img class="diulem-bukutamu-bg" <?php if (! empty($background)) { ?> src="<?= base_url() ?><?= $background ?>" <?php } ?> id="img-bukutamu" name="img-bukutamu" alt="Background buku tamu">
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 d-flex align-items-center justify-content-center mt-3 mt-md-0">
                                    <div class="btn btn-primary">
                                        <input type="file" class="file-upload" id="bg-bukutamu" name="bg-bukutamu" accept="image/*" onchange="preview_image(event)"> Upload Foto
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <button class="btn btn-primary w-100" type="submit">Simpan</button>
                                </div>
                            </div>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url() ?>/assets/base/js/dropzone.js"></script>
<script>
function preview_image(event) {
    var file = event.target.files[0];
    if (!file) {
        return;
    }

    var reader = new FileReader();
    reader.onload = function() {
        document.getElementById('img-bukutamu').src = reader.result;
    };
    reader.readAsDataURL(file);
}

var myDropzone = new Dropzone(document.body, {
  url: "<?= base_url('user/update_slider_bukutamu'); ?>",
  paramName: "file",
  acceptedFiles: 'image/*',
  autoQueue: true,
  maxFilesize: 2,
  clickable: ".do-add-btn"
});

myDropzone.on("success", function(file, response) {
    $('.dz-preview').remove();

    if (response == "") {
      DiulemDashboard.notify('warning', 'Batas Upload', 'Maksimal 10 foto slider buku tamu.');
    } else {
      var aql = JSON.parse(response);
      $("#previewss").prepend('<div id="preview'+aql.no+'" class="file-row preview-uploads"><div class="preview-slider-img"><span class="preview"><img id="img3" src="<?= base_url() ?>/assets/users/'+aql.kunci+'/slider'+aql.no+'.png" alt="slider'+aql.no+'" /></span></div><div class="preview-uploads-name"><p class="name fw-bold" data-dz-name>slider'+aql.no+'</p><strong class="error text-danger"></strong><p class="size text-secondary">-</p></div><div class="preview-uploads-delete"><button id="'+aql.no+'" class="btn btn-danger delete btnhehe">Hapus</button></div></div>');
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

$(document).on('click', '.btnhehe', function() {
  var button_id = $(this).attr("id");
  var kunci = "<?= $kunci ?>";

  $.ajax({
     type: 'POST',
     url: '<?= base_url('user/del_slider_bukutamu') ?>',
     data: {id: button_id, kunci: kunci},
     success: function() {
        $('#preview'+button_id).remove();
     },
     error: function() {
        DiulemDashboard.notify('error', 'Gagal', 'Slider gagal dihapus.');
     }
  });
});
</script>
