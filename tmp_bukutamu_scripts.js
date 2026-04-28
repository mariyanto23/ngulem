// script 1

        function hasValidGuestData() {
            var qrCodeValue = ($('#outputData').val() || '').trim();
            var namaTamu = ($('#nama_tamu').val() || '').trim();
            return qrCodeValue !== '' && namaTamu !== '' && namaTamu !== '-';
        }

        function updateAttendanceUiState() {
            var canOpenCamera = hasValidGuestData();
            var hasImage = (($('.image-tag').val() || '').trim() !== '');
            var openCameraButton = document.getElementById('btn-open-camera');
            var helper = document.getElementById('selfie-helper');
            var webcamVisible = document.getElementById('webcam').hidden === false;

            if (openCameraButton) {
                openCameraButton.classList.toggle('is-disabled', !canOpenCamera);
            }

            if (helper) {
                if (hasImage) {
                    helper.textContent = 'Foto selfie sudah siap. Klik Simpan untuk menyelesaikan kehadiran.';
                } else if (webcamVisible) {
                    helper.textContent = 'Posisikan wajah tamu dengan jelas, lalu klik Capture.';
                } else if (canOpenCamera) {
                    helper.textContent = 'Data tamu sudah ditemukan. Klik ikon kamera untuk ambil foto selfie.';
                } else {
                    helper.textContent = 'Scan QR tamu terlebih dahulu untuk membuka kamera selfie.';
                }
            }
        }

        function updateScanUiState(isScanning, message) {
            var scanButton = document.getElementById('btn-scan-qr');
            var scanHelper = document.getElementById('scan-helper');
            var canvasElement = document.getElementById('qr-canvas');

            if (scanButton) {
                scanButton.classList.toggle('is-disabled', !!isScanning);
                scanButton.setAttribute('aria-busy', isScanning ? 'true' : 'false');
            }

            if (canvasElement) {
                canvasElement.hidden = !isScanning;
            }

            if (scanHelper) {
                if (message) {
                    scanHelper.textContent = message;
                } else {
                    scanHelper.textContent = isScanning ?
                        'Kamera aktif. Arahkan QR ke dalam frame.' :
                        'Klik tombol scan untuk membuka kamera belakang.';
                }
            }
        }

        function escapeHtml(value) {
            return $('<div>').text(value || '').html();
        }

        function updateAttendanceStats() {
            var totalTamu = parseInt($('#stat-total-tamu').text(), 10) || 0;
            var totalHadir = $('#hadir-list .list-group-item').not('#hadir-empty-state').length;
            var totalHadirToday = parseInt($('#stat-total-hadir-today').text(), 10) || 0;
            var totalBelumHadir = Math.max(0, totalTamu - totalHadir);
            var attendanceRate = totalTamu > 0 ? Math.round((totalHadir / totalTamu) * 100) : 0;

            $('#stat-total-hadir').text(totalHadir);
            $('#stat-total-hadir-today').text(totalHadirToday);
            $('#stat-attendance-rate').text(attendanceRate + '%');
            $('#stat-total-belum-hadir').text(totalBelumHadir + ' tamu belum hadir');
        }

        $(document).ready(function() {
            $('#save').on('click', function(event) {
                event.preventDefault();
                var image = $('.image-tag').val();
                var qrcode2 = $('#outputData').val();
                var nama = $('#nama_tamu').val();
                var alamat = $('#alamat_tamu').val();
                var $saveButton = $('#save');

                if (!qrcode2 || !nama || nama === '-' || !image) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Data belum lengkap',
                        text: 'Scan QR dan ambil foto selfie terlebih dahulu sebelum menyimpan.'
                    });
                    return;
                }

                $.ajax({
                    url: base_url + '/add_hadir',
                    method: "POST",
                    data: {
                        qrcode: qrcode2,
                        image: image,
                        nama: nama,
                        alamat: alamat
                    },
                    async: true,
                    dataType: 'json',
                    beforeSend: function() {
                        $saveButton.prop('disabled', true).text('Menyimpan...');
                    },
                    success: function($hasil) {
                        if ($hasil && $hasil.status === 'sukses') {
                            $('#hadir-empty-state').remove();
                            $('#hadir-list').prepend(
                                '<li class="list-group-item">' +
                                '<div class="media" style="display:flex;align-items:center;gap:12px;">' +
                                '<div><img src="' + escapeHtml($hasil.selfie_url || '') + '" alt="Selfie ' + escapeHtml($hasil.nama_tamu || nama) + '" style="width:48px;height:48px;border-radius:10px;object-fit:cover;border:2px solid #facc15;cursor:pointer;" class="hadir-selfie-thumb" data-image="' + escapeHtml($hasil.selfie_url || '') + '" data-name="' + escapeHtml($hasil.nama_tamu || nama) + '"></div>' +
                                '<div style="text-align:left;">' +
                                '<strong>' + escapeHtml($hasil.nama_tamu || nama) + '</strong><br>' +
                                '<small>' + escapeHtml($hasil.alamat_tamu || alamat) + '</small><br>' +
                                '<small class="text-muted">' + escapeHtml($hasil.waktu_hadir || '') + '</small>' +
                                '</div>' +
                                '</div>' +
                                '</li>'
                            );
                            $('#outputData').val('');
                            $('#nama_tamu').val('');
                            $('#alamat_tamu').val('');
                            $('.image-tag').val('');
                            $('#simpan').prop('hidden', true).hide();
                            $('#webcam').prop('hidden', true).hide();
                            $('#camera').prop('hidden', true).hide();
                            $('#btn-open-camera').prop('hidden', false);
                            Webcam.reset();
                            var currentToday = parseInt($('#stat-total-hadir-today').text(), 10) || 0;
                            $('#stat-total-hadir-today').text(currentToday + 1);
                            updateAttendanceStats();
                            updateAttendanceUiState();
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Data hadir berhasil disimpan.'
                            });
                        } else {
                            $('#modalGagal').modal('show');
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal menyimpan',
                            text: 'Terjadi kendala saat menyimpan data hadir.'
                        });
                    },
                    complete: function() {
                        $saveButton.prop('disabled', false).text('Simpan');
                    }
                });
            });
        });
    
// script 2

        function preview() {
            const x = document.getElementById('camera');
            // untuk preview gambar sebelum di upload
            Webcam.snap(function(data_uri) {
                $(".image-tag").val(data_uri);
                Webcam.freeze();
                // ganti display webcam menjadi none dan simpan menjadi terlihat
                document.getElementById('webcam').hidden = true;
                document.getElementById('webcam').style.display = 'none';
                document.getElementById('simpan').hidden = false;
                //document.getElementById('webcam').style.display = 'none';
                document.getElementById('simpan').style.display = '';
                x.getElementsByTagName("video")[0].hidden = true;
                updateAttendanceUiState();
            });
        }

        function batal() {
            // batal preview
            Webcam.unfreeze();
            const x = document.getElementById('camera');
            // ganti display webcam dan simpan seperti semula
            document.getElementById('webcam').hidden = false;
            document.getElementById('simpan').hidden = true;
            document.getElementById('webcam').style.display = '';
            document.getElementById('simpan').style.display = 'none';
            $('.image-tag').val('');
            x.getElementsByTagName("video")[0].hidden = false;
            //document.getElementById('simpan').style.display = 'none';
            updateAttendanceUiState();
        }
    
// script 3

        function configure() {
            if (!hasValidGuestData()) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Scan QR dulu',
                    text: 'Silakan scan QR Code tamu terlebih dahulu sebelum ambil foto selfie.'
                });
                return false;
            }

            initializeSelfieCamera();
            return false;
        }

        function initializeSelfieCamera() {
            Webcam.reset();
            Webcam.set({
                width: 187,
                height: 140,
                dest_width: 187,
                dest_height: 140,
                crop_width: 187,
                crop_height: 140,
                image_format: 'jpg',
                jpeg_quality: 100
            });

            Webcam.attach('#camera');
            document.getElementById('btn-open-camera').hidden = true;
            document.getElementById('webcam').style.display = '';
            document.getElementById('webcam').hidden = false;
            document.getElementById('camera').style.display = '';
            document.getElementById('camera').hidden = false;
            document.getElementById('simpan').hidden = true;
            document.getElementById('simpan').style.display = 'none';
            $('.image-tag').val('');
            updateAttendanceUiState();
        }

        $(document).ready(function() {
            const qrcode = window.qrcode || null;
            const jsQRScanner = window.jsQR || null;
            let barcodeDetector = null;
            if ('BarcodeDetector' in window) {
                try {
                    barcodeDetector = new BarcodeDetector({
                        formats: ['qr_code']
                    });
                } catch (error) {
                    barcodeDetector = null;
                }
            }
            const video = document.createElement("video");
            const canvasElement = document.getElementById("qr-canvas");
            const canvas = canvasElement.getContext("2d");
            const qrResult = document.getElementById("qr-result");
            const outputData = document.getElementById("outputData");
            const btnScanQR = document.getElementById("btn-scan-qr");
            let scanning = false;
            let scanStream = null;

            function stopScanStream() {
                scanning = false;

                if (scanStream) {
                    scanStream.getTracks().forEach(function(track) {
                        track.stop();
                    });
                    scanStream = null;
                }

                if (video.srcObject) {
                    video.srcObject = null;
                }

                updateScanUiState(false);
            }

            if (qrcode) {
                qrcode.callback = res => {
                    if (res && !String(res).toLowerCase().includes('error')) {
                        handleScanResult(res);
                    }
                };
            }

            btnScanQR.onclick = function(event) {
                event.preventDefault();

                if (scanning) {
                    return false;
                }

                if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Kamera tidak tersedia',
                        text: 'Browser ini belum mendukung akses kamera untuk scan QR.'
                    });
                    return false;
                }

                navigator.mediaDevices
                    .getUserMedia({
                        video: {
                            facingMode: "environment"
                        }
                    })
                    .then(function(stream) {
                        scanning = true;
                        scanStream = stream;
                        qrResult.hidden = false;
                        updateScanUiState(true);
                        Webcam.unfreeze();
                        document.getElementById('simpan').style.display = 'none';
                        document.getElementById('btn-open-camera').hidden = false;
                        document.getElementById('camera').style.display = 'none';
                        document.getElementById('webcam').hidden = true;
                        document.getElementById('webcam').style.display = 'none';
                        document.getElementById('camera').hidden = true;
                        document.getElementById('btn-do-capture').hidden = false;
                        updateAttendanceUiState();

                        video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
                        video.srcObject = stream;
                        video.onloadedmetadata = function() {
                            video.play();
                            tick();
                            scan();
                        };
                    })
                    .catch(function() {
                        stopScanStream();
                        Swal.fire({
                            icon: 'error',
                            title: 'Izin kamera ditolak',
                            text: 'Izinkan akses kamera agar QR Code bisa dipindai.'
                        });
                    });

                return false;
            };

            $('#btn-scan-qr').on('click', function(event) {
                event.preventDefault();
                if (typeof btnScanQR.onclick === 'function') {
                    return btnScanQR.onclick(event);
                }
                return false;
            });

            function tick() {
                if (!scanning) {
                    return;
                }

                if (!video.videoWidth || !video.videoHeight) {
                    requestAnimationFrame(tick);
                    return;
                }

                canvasElement.height = video.videoHeight;
                canvasElement.width = video.videoWidth;
                canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);

                scanning && requestAnimationFrame(tick);
            }

            function handleScanResult(rawValue) {
                if (!rawValue) {
                    return;
                }

                var normalized = normalizeQrValue(rawValue);
                $("#outputData").val(normalized);
                autofill();
                stopScanStream();

                qrResult.hidden = false;
                document.getElementById('outputData').focus();
                initializeSelfieCamera();
                updateScanUiState(false, 'QR berhasil dibaca. Data tamu sedang diisi otomatis.');
            }

            async function detectWithBarcodeDetector() {
                if (!scanning || !barcodeDetector) {
                    return;
                }

                try {
                    var barcodes = await barcodeDetector.detect(canvasElement);
                    if (barcodes && barcodes.length > 0) {
                        handleScanResult(barcodes[0].rawValue || '');
                        return;
                    }
                } catch (error) {
                    // fallback to legacy decoder below
                }

                if (scanning) {
                    setTimeout(detectWithBarcodeDetector, 180);
                }
            }

            function scan() {
                if (!scanning) {
                    return;
                }

            if (barcodeDetector) {
                detectWithBarcodeDetector();
                return;
            }

            if (jsQRScanner && canvasElement.width && canvasElement.height) {
                try {
                    var imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
                    var qrCodeResult = jsQRScanner(imageData.data, imageData.width, imageData.height);
                    if (qrCodeResult && qrCodeResult.data) {
                        handleScanResult(qrCodeResult.data);
                        return;
                    }
                } catch (error) {
                    // fallback to legacy decoder below
                }
            }

            if (qrcode) {
                try {
                    qrcode.decode();
                } catch (e) {
                    if (scanning) {
                        setTimeout(scan, 300);
                    }
                }
                return;
            }

            if (scanning) {
                setTimeout(scan, 300);
            }
        }
        });
    
// script 4

        function autofill() {
            var qrcode = $("#outputData").val();
            $.ajax({
                url: "<?= base_url('bukutamu/autofill') ?>",
                data: '&qrcode=' + qrcode,
                success: function(data) {
                    var hasil = JSON.parse(data);
                    $.each(hasil, function(key, val) {
                        document.getElementById('nama_tamu').value = val.nama_tamu;
                        document.getElementById('alamat_tamu').value = val.alamat_tamu;
                        updateAttendanceUiState();
                    });
                }
            });
        }

        function normalizeQrValue(value) {
            if (!value) {
                return '';
            }

            try {
                var url = new URL(value);
                var code = url.searchParams.get('qrcode');
                if (code) {
                    return code;
                }

                var segments = url.pathname.split('/').filter(Boolean);
                return segments.length ? segments[segments.length - 1] : value;
            } catch (error) {
                return value;
            }
        }

        $(document).ready(function() {
            var params = new URLSearchParams(window.location.search);
            var queryQrCode = params.get('qrcode');
            if (queryQrCode) {
                $('#outputData').val(queryQrCode);
                autofill();
            }
            $(document).on('click', '.hadir-selfie-thumb', function() {
                $('#modalSelfiePreviewLabel').text('Selfie - ' + ($(this).data('name') || 'Tamu'));
                $('#selfie-preview-image').attr('src', $(this).data('image') || '');
                $('#modalSelfiePreview').modal('show');
            });
            updateAttendanceUiState();
            updateAttendanceStats();
        });
    
// script 5

        window.onload = function() {
            jam();
        }

        function jam() {
            var e = document.getElementById('jam'),
                d = new Date(),
                h, m, s;
            h = d.getHours();
            m = set(d.getMinutes());
            s = set(d.getSeconds());

            e.innerHTML = h + ':' + m + ':' + s;

            setTimeout('jam()', 1000);
        }

        function set(e) {
            e = e < 10 ? '0' + e : e;
            return e;
        }
    
// script 6

        $(function() {
            <?php if (session()->has("success")) { ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Great!',
                    text: '<?= session("success") ?>'
                })
            <?php } ?>
            <?php if (session()->has("deleted")) { ?>
                Swal.fire({
                    icon: 'warning',
                    title: 'Great!',
                    text: '<?= session("deleted") ?>'
                })
            <?php } ?>
            <?php if (session()->has("updated")) { ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Great!',
                    text: '<?= session("updated") ?>'
                })
            <?php } ?>
            <?php if (session()->has("error")) { ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '<?= session("error") ?>'
                })
            <?php } ?>
        });
    
// script 7

    var base_url = '<?php echo base_url() ?>';

// script 8

    var tanggal_resepsi = '<?php echo $tgl_acara; ?>';

// script 9

    var tanggal_sekarang = '<?php echo $tanggal_sekarang; ?>';
