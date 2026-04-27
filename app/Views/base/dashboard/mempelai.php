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
        $fotogroom = "/assets/users/".$kunci."/groom.png";
        $fotobride = "/assets/users/".$kunci."/bride.png";
        $fotosampul = "/assets/users/".$kunci."/kita.png";
        
    ?>

    <div class="row row-cards">
        <div class="col-xl-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Mempelai Pria</h3>
                </div>
                <div class="card-body">
                    <!-- CONTENT DISINI -->
                    <div class="upload-area-bg diulem-upload-center">
                        <div class="col">
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6 d-flex align-items-center justify-content-center">
                                    <div class="upload-area diulem-mempelai-upload">
                                    <img class="diulem-mempelai-photo" src="<?php echo base_url() ?><?= $fotogroom ?>" id="profile-pic-groom" alt="Foto mempelai pria">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6 d-flex align-items-center justify-content-center mt-3">
                                    <label class="btn btn-primary diulem-file-button">
                                        <i class="ti ti-upload me-2"></i>Upload Foto
                                        <input type="file" class="file-upload" id="groom" name="profile_picture" accept="image/*">
                                    </label>
                                </div>
                            </div>   
                        </div>
                    </div>
                    <hr>
                    <div class="col mt-2">
                        <label>Nama Lengkap</label>
                        <input id="nama_lengkap_pria" type="text" class="form-control" placeholder="Contoh : Jack Dawson S.Kom" value="<?= $mempelai[0]->nama_pria ?>" required>
                    </div>

                    <div class="col mt-2">
                        <label>Nama Panggilan</label>
                        <input id="nama_panggilan_pria" type="text" class="form-control" placeholder="Contoh : Jack" value="<?=  $mempelai[0]->nama_panggilan_pria ?>" required>
                    </div>

                    <div class="col mt-2">
                        <label>Nama Ayah</label>
                        <input id="nama_ayah_pria" type="text" class="form-control" placeholder="Nama Ayah" value="<?= $mempelai[0]->nama_ayah_pria ?>" required>
                    </div>

                    <div class="col mt-2">
                        <label>Nama Ibu</label>
                        <input id="nama_ibu_pria" type="text" class="form-control" placeholder="Nama Ibu" value="<?= $mempelai[0]->nama_ibu_pria ?>" required>
                    </div>
                    <div class="col mt-3">
                        <button class="btn btn-primary" id="simpanPria">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Mempelai Wanita</h3>
                </div>
                <div class="card-body">
                    <!-- CONTENT DISINI -->
                    <div class="upload-area-bg diulem-upload-center">
                        <div class="col">
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6 d-flex align-items-center justify-content-center">
                                    <div class="upload-area diulem-mempelai-upload">
                                    <img class="diulem-mempelai-photo" src="<?php echo base_url() ?><?= $fotobride ?>" id="profile-pic-bride" alt="Foto mempelai wanita">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6 d-flex align-items-center justify-content-center mt-3">
                                    <label class="btn btn-primary diulem-file-button">
                                        <i class="ti ti-upload me-2"></i>Upload Foto
                                        <input type="file" class="file-upload" id="bride" name="profile_picture" accept="image/*">
                                    </label>
                                </div>
                            </div>   
                        </div>
                    </div>
                    <hr>
                    <div class="col mt-2">
                        <label>Nama Lengkap</label>
                        <input id="nama_lengkap_wanita" type="text" class="form-control" placeholder="Contoh : Fatimah Az Zahra" value="<?= $mempelai[0]->nama_wanita ?>" required>
                    </div>

                    <div class="col mt-2">
                        <label>Nama Panggilan</label>
                        <input id="nama_panggilan_wanita" type="text" class="form-control" placeholder="Contoh : Fatimah" value="<?=  $mempelai[0]->nama_panggilan_wanita ?>" required>
                    </div>

                    <div class="col mt-2">
                        <label>Nama Ayah</label>
                        <input id="nama_ayah_wanita" type="text" class="form-control" placeholder="Nama Ayah" value="<?= $mempelai[0]->nama_ayah_wanita ?>" required>
                    </div>

                    <div class="col mt-2">
                        <label>Nama Ibu</label>
                        <input id="nama_ibu_wanita" type="text" class="form-control" placeholder="Nama Ibu" value="<?= $mempelai[0]->nama_ibu_wanita ?>" required>
                    </div>

                    <div class="col mt-3">
                        <button class="btn btn-primary" id="simpanWanita">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-xl-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Foto Sampul</h3>
                </div>
                <div class="card-body">
                    <!-- CONTENT DISINI -->
                    <div class="upload-area-bg diulem-upload-center">
                        <div class="col">
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6 d-flex align-items-center justify-content-center">
                                    <div class="upload-area diulem-mempelai-upload">
                                    <img class="diulem-mempelai-photo" src="<?= base_url() ?><?= $fotosampul ?>" id="profile-pic-sampul" alt="Foto sampul">
                                    </div>

                                </div>
                                <div class="col-12 col-md-6 col-lg-6 d-flex align-items-center justify-content-center mt-3">
                                    <label class="btn btn-primary diulem-file-button">
                                        <i class="ti ti-upload me-2"></i>Upload Foto
                                        <input type="file" class="file-upload" id="sampul" name="profile_picture" accept="image/*">
                                    </label>
                                </div>
                            </div>   
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Posisi Mempelai</h3>
                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data" action="<?php echo base_url('user/update_posisi_mempelai'); ?>">
                    <div class="col mt-2">
                        <label>Posisi Mempelai</label>
                        <select class="form-control" id="posisi_mempelai" name="posisi_mempelai" required>
                            <?php
							if ($mempelai[0]->posisi_mempelai == 0) echo "<option value='0' selected>Pria dan Wanita (Putra dan Putri)</option>";
							else echo "<option value='0'>Pria dan Wanita (Putra dan Putri)</option>";

							if ($mempelai[0]->posisi_mempelai == 1) echo "<option value='1' selected>Wanita dan Pria (Putri dan Putra)</option>";
							else echo "<option value='1'>Wanita dan Pria (Putri dan Putra)</option>";
							
							?>
                        </select>
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


<script src="<?php echo base_url() ?>/assets/base/js/croppie.min.js"></script>
<script>

$(document).ready(function () {
         /** croppie shareurcodes.com **/
        var croppie = null;
        var el = document.getElementById('resizer');

        $.base64ImageToBlob = function(str) {
            /** extract content type and base64 payload from original string **/
            var pos = str.indexOf(';base64,');
            var type = str.substring(5, pos);
            var b64 = str.substr(pos + 8);
        
            /* decode base64 */
            var imageContent = atob(b64);
        
            /* create an ArrayBuffer and a view (as unsigned 8-bit) */
            var buffer = new ArrayBuffer(imageContent.length);
            var view = new Uint8Array(buffer);
        
            /* fill the view, using the decoded base64 */
            for (var n = 0; n < imageContent.length; n++) {
            view[n] = imageContent.charCodeAt(n);
            }
        
            /* convert ArrayBuffer to Blob */
            var blob = new Blob([buffer], { type: type });
        
            return blob;
        }

        $.getImage = function(input, croppie) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {  
                    croppie.bind({
                        url: e.target.result,
                    });
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        var fotonyasiapa = '';
        var pendingImageSource = null;
        var cropInitTimeout = null;

        function initCroppieWithSource(imageSource) {
            if (!imageSource) {
                return;
            }

            if (croppie) {
                croppie.destroy();
            }

            croppie = new Croppie(el, {
                viewport: {
                    width: 300,
                    height: 300,
                    type: 'square'
                },
                boundary: {
                    width: 350,
                    height: 350
                },
                enableOrientation: true
            });

            croppie.bind({
                url: imageSource
            });
        }

        $(".file-upload").on("change", function(event) {
            var file = event.target.files[0];
            if (!file) {
                return;
            }

            if (!file.type.match(/^image\//)) {
                DiulemDashboard.notify('error', 'Upload Gagal', 'File harus berupa gambar.');
                $(this).val('');
                return;
            }

            if (file.size > 2 * 1024 * 1024) {
                DiulemDashboard.notify('error', 'Upload Gagal', 'Ukuran foto maksimal 2MB.');
                $(this).val('');
                return;
            }

            fotonyasiapa = $(this).attr("id");
            var reader = new FileReader();
            reader.onload = function(e) {
                pendingImageSource = e.target.result;
                $('#myModal').modal('show');
            };
            reader.readAsDataURL(file);
        });

        $('#myModal').on('shown.bs.modal', function () {
            if (!pendingImageSource) {
                return;
            }

            if (cropInitTimeout) {
                clearTimeout(cropInitTimeout);
            }

            cropInitTimeout = setTimeout(function() {
                initCroppieWithSource(pendingImageSource);
                pendingImageSource = null;
            }, 120);
        });

        $("#upload").on("click", function() {
            if (!croppie) {
                DiulemDashboard.notify('error', 'Upload Gagal', 'Foto belum siap diproses. Silakan pilih ulang gambar.');
                return;
            }

            var $button = $(this);
            DiulemDashboard.setButtonLoading($button, true, '<i class="ti ti-loader me-2"></i>Upload...');
            croppie.result({
                type: 'base64',
                size: 'viewport',
                format: 'png',
                quality: 1
            }).then(function(base64) {

                var url = "<?php echo base_url('user/update_foto_mempelai') ?>";
                var formData = new FormData();
                formData.append("foto_"+fotonyasiapa, $.base64ImageToBlob(base64), fotonyasiapa + '.png');
                formData.append("kunci", "<?= $kunci ?>");


                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        if (data == "uploadedbride") {
                            $("#profile-pic-bride").attr("src", base64);
                            $('#myModal').modal('hide');
                        } else if(data == "uploadedgroom"){
                            $("#profile-pic-groom").attr("src", base64);
                            $('#myModal').modal('hide');
                        } else if(data == "uploadedsampul"){
                            $("#profile-pic-sampul").attr("src", base64);
                            $('#myModal').modal('hide');
                        } else {
                            DiulemDashboard.notify('error', 'Upload Gagal', 'Foto gagal diupload.');
                        }
                    },
                    error: function() {
                        DiulemDashboard.notify('error', 'Upload Gagal', 'Foto gagal diupload.');
                    },
                    complete: function() {
                        $(".file-upload").val('');
                        DiulemDashboard.setButtonLoading($button, false);
                    }
                });
            }).catch(function() {
                DiulemDashboard.notify('error', 'Upload Gagal', 'Foto gagal diproses. Silakan coba lagi.');
                DiulemDashboard.setButtonLoading($button, false);
            });
        });

        /* To Rotate Image Left or Right */
        $(".rotate").on("click", function() {
            croppie.rotate(parseInt($(this).data('deg'))); 
        });

        $('#myModal').on('hidden.bs.modal', function (e) {
            /* This function will call immediately after model close */
            /* To ensure that old croppie instance is destroyed on every model close */
            pendingImageSource = null;
            if (cropInitTimeout) {
                clearTimeout(cropInitTimeout);
                cropInitTimeout = null;
            }
            setTimeout(function() {
                if (croppie) {
                    croppie.destroy();
                    croppie = null;
                }
            }, 100);
        });

});


    $('#simpanWanita').on('click', function(event) {

        var $button = $(this);
        var datanyaSiapa = 'wanita';
        var nama = $('#nama_lengkap_wanita').val();
        var nama_panggilan = $('#nama_panggilan_wanita').val();
        var nama_ayah = $('#nama_ayah_wanita').val();
        var nama_ibu = $('#nama_ibu_wanita').val();
        DiulemDashboard.post("<?= base_url('user/update_mempelai') ?>", {
            nama: nama,
            nama_panggilan: nama_panggilan,
            nama_ayah: nama_ayah,
            nama_ibu: nama_ibu,
            datanyaSiapa: datanyaSiapa
        }, {
            button: $button,
            successMessage: 'Data mempelai wanita berhasil disimpan.',
            errorMessage: 'Data mempelai wanita gagal disimpan.'
        });

    });

    $('#simpanPria').on('click', function(event) {

        var $button = $(this);
        var datanyaSiapa = 'pria';
        var nama = $('#nama_lengkap_pria').val();
        var nama_panggilan = $('#nama_panggilan_pria').val();
        var nama_ayah = $('#nama_ayah_pria').val();
        var nama_ibu = $('#nama_ibu_pria').val();

        DiulemDashboard.post("<?= base_url('user/update_mempelai') ?>", {
            nama: nama,
            nama_panggilan: nama_panggilan,
            nama_ayah: nama_ayah,
            nama_ibu: nama_ibu,
            datanyaSiapa: datanyaSiapa
        }, {
            button: $button,
            successMessage: 'Data mempelai pria berhasil disimpan.',
            errorMessage: 'Data mempelai pria gagal disimpan.'
        });

    });

</script>
