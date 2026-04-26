<div class="page-body">
<?php
$waGatewayRaw = $setting[0]->wa_gateway ?? 'nusagateway';
$waTokenRaw = $setting[0]->token_wa ?? '';
$waGatewayEnabled = (strpos($waGatewayRaw, 'off:') === 0 || strpos($waTokenRaw, '__disabled__:') === 0) ? '0' : '1';
?>
    <div class="container-xl">
        <div class="page-header d-print-none mb-3">
            <div class="row align-items-center">
                <div class="col">
                    <div class="page-pretitle">Buku Tamu</div>
                    <h1 class="page-title"><?= esc($title); ?></h1>
                </div>
                <div class="col-auto">
                    <div class="btn-list">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                            <i class="ti ti-plus me-2"></i>Input Data Tamu
                        </button>
                        <?php if ($paket[0]->import_datatamu == 1) { ?>
                            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modalExcel">
                                <i class="ti ti-file-spreadsheet me-2"></i>Import Excel
                            </button>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Tamu Undangan</h3>
                <div class="card-actions">
                    <button type="submit" form="formHapusTamu" class="btn btn-danger btn-sm">
                        <i class="ti ti-trash me-2"></i>Hapus Banyak
                    </button>
                </div>
            </div>
            <?= form_open('user/hapusbanyaktamu', ['class' => 'formhapusbanyak', 'id' => 'formHapusTamu']) ?>
            <div class="table-responsive">
                <table class="table table-vcenter card-table table-striped" id="dataTable">
                    <thead>
                        <tr>
                            <th class="w-1"><input type="checkbox" id="centangSemua"></th>
                            <th>Nama Tamu</th>
                            <th>No Whatsapp</th>
                            <th>Domain Undangan</th>
                            <th>Tgl Kirim Undangan</th>
                            <th>Status Undangan</th>
                            <th class="w-1">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tamu as $row) { ?>
                            <tr>
                                <td><input type="checkbox" class="centangTamu" name="idTamu[]" value="<?= esc($row->id_tamu) ?>"></td>
                                <td><?= esc($row->nama_tamu) ?></td>
                                <td><?= esc($row->no_wa) ?></td>
                                <td>
                                    <a href="<?= rtrim(SITE_UNDANGAN, '/') ?>/<?= esc($row->domain) ?>/<?= esc($row->id_tamu) ?>" target="_blank">
                                        <?= esc(DOMAIN_UNDANGAN) ?>/<?= esc($row->domain) ?>/<?= esc($row->id_tamu) ?>
                                    </a>
                                </td>
                                <td><?= esc($row->tgl_kirim) ?></td>
                                <td><span class="badge bg-secondary-lt"><?= esc($row->status_kirim) ?></span></td>
                                <td>
                                    <div class="btn-list flex-nowrap">
                                        <?php if ($paket[0]->kirim_whatsapp == 1) { ?>
                                            <button
                                                data-id="<?= esc($row->id_tamu) ?>"
                                                class="btn btn-sm btn-success btn-icon kirim"
                                                title="Kirim undangan"
                                                aria-label="Kirim undangan">
                                                <i class="ti ti-send"></i>
                                            </button>
                                        <?php } ?>
                                        <button
                                            data-id="<?= esc($row->id_tamu) ?>"
                                            data-nama="<?= esc($row->nama_tamu) ?>"
                                            data-alamat="<?= esc($row->alamat_tamu) ?>"
                                            data-no="<?= esc($row->no_wa) ?>"
                                            data-tgl="<?= esc($row->tgl_kirim) ?>"
                                            class="btn btn-sm btn-primary btn-icon edit"
                                            data-toggle="modal"
                                            data-target="#modalEdit"
                                            title="Edit tamu"
                                            aria-label="Edit tamu">
                                            <i class="ti ti-pencil"></i>
                                        </button>
                                        <button data-id="<?= esc($row->id_tamu) ?>" class="btn btn-sm btn-danger btn-icon hapus" title="Hapus tamu" aria-label="Hapus tamu">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

        <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Tamu</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col mt-2">
                        <label>Nama Tamu Undangan</label>
                        <input id="id_user" type="hidden" class="form-control" value="<?=$_SESSION['id'] ?>">
                        <input id="nama_tamu" type="text" class="form-control diulem-text-capitalize" placeholder="Contoh : Agus Sukamto" required>
                    </div>
                    <div class="col mt-2">
                        <label>Alamat Tamu Undangan</label>
                        <input id="alamat_tamu" type="text" class="form-control diulem-text-capitalize" placeholder="Contoh : Medan Merdeka" required>
                    </div>

                    <div class="col mt-2">
                        <label>No Whatsapp</label>
                        <input id="no_wa" type="text" placeholder="Contoh : 628xxxxx" class="form-control" required>
                    </div>

                    <div class="col mt-2">
                        <label>Tanggal </label>
                        <input name="datepicker" type="text" class="form-control diulem-datepicker-input" placeholder="Tanggal" id="datepicker" readonly="readonly" required>
                        <input type="hidden" id="tgl_kirim">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" id="simpanTamu">Simpan</button>
            </div>
            </div>
        </div>
        </div>
        
        <div class="modal fade" id="modalExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Data Tamu (Excel)</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="<?php echo base_url('user/prosesExcel'); ?>" enctype="multipart/form-data">
            <div class="modal-body">
                
			<div class="form-group">
				<label>File Excel</label>
				<input type="file" name="fileexcel" class="form-control" id="file" required accept=".xls, .xlsx" /></p>
			</div>
		    <label class="form-check-label ">
                <a class="diulem-help-link" href="<?php echo base_url('import_tamu'); ?>" target="_blank"><i class="lni-question-circle"></i>&nbsp Susunan Data Untuk File Data Tamu (Excel)</a>
            </label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="submit">Upload</button>
            </div>
            </form>
            </div>
        </div>
        </div>
        
<!-- Modal -->

<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Tamu</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="col mt-2">
                        <label>Nama Tamu Undangan</label>
                        <input id="namaTamu" type="text" class="form-control diulem-text-capitalize" placeholder="Contoh : Agus Sukamto" required>
                    </div>
                    <div class="col mt-2">
                        <label>Alamat Tamu Undangan</label>
                        <input id="alamatTamu" type="text" placeholder="Contoh : Tlogosari, Semarang" class="form-control diulem-text-capitalize" required>
                    </div>

                    <div class="col mt-2">
                        <label>No Whatsapp</label>
                        <input id="noWa" type="text" placeholder="Contoh : 628xxxxx" class="form-control" required>
                    </div>

                    <div class="col mt-2">
                        <label>Tanggal </label>
                        <input name="datepicker2" type="text" class="form-control diulem-datepicker-input" placeholder="Tanggal" id="datepicker2" readonly="readonly" required>
                        <input type="hidden" id="tglKirim">
                    </div>
        <input type="hidden" id="idTamunya" >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm text-danger" id="editBtn">Update</button>
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo base_url() ?>/assets/base/js/pikaday.js"></script>
<script>
$(document).ready(function () {
    
    moment.locale('id');
    
    
    // $('#datepicker').val(moment('<?= date('Y-m-d') ?>').format('dddd, Do MMMM YYYY'));
    var picker = new Pikaday({ 
      
      field: $('#datepicker')[0],
      format: 'dddd, Do MMMM YYYY',
      onSelect: function() {
        $('#tgl_kirim').val(this.getMoment().format('YYYY/MM/DD'));
      }
    });
    var tanggalKirim=  $('#tglKirim').val();
        if(tanggalKirim != ''){
      $('#datepicker2').val(moment(tanggalKirim).format('dddd, Do MMMM YYYY'));
    }
   var picker2 = new Pikaday({ 
      
      field: $('#datepicker2')[0],
      format: 'dddd, Do MMMM YYYY',
      onSelect: function() {
        $('#tglKirim').val(this.getMoment().format('YYYY/MM/DD'));
      }
    });
    $('#simpanTamu').on('click', function(event) {

        var tgl_kirim = $('#tgl_kirim').val();
        var no_wa = $('#no_wa').val();
        var nama_tamu = $('#nama_tamu').val();
        var alamat_tamu = $('#alamat_tamu').val();
        var id_user = $('#id_user').val();

        DiulemDashboard.post("<?= base_url('user/save_tamu') ?>", {
            tgl_kirim: tgl_kirim,
            no_wa: no_wa,
            nama_tamu: nama_tamu,
            alamat_tamu: alamat_tamu,
            id_user: id_user
        }, {
            button: $(this),
            successMessage: 'Data tamu berhasil disimpan.',
            errorMessage: 'Data tamu gagal disimpan.'
        });

    });

    $('.hapus').on('click', function () {
        $('#centangSemua').prop('checked', false);
        $('.centangTamu').prop('checked', false);
        var idTamu = $(this).data('id');
        var $button = $(this);

        DiulemDashboard.confirm({
            title: 'Hapus Tamu',
            text: 'Apakah kamu yakin ingin menghapus data tamu ini?',
            confirmButtonText: 'Ya, Hapus'
        }).then(function(result) {
            if (!result.value) {
                return;
            }

            DiulemDashboard.post("<?= base_url('user/hapus_tamu') ?>", {
                id_tamu: idTamu
            }, {
                button: $button,
                successMessage: 'Data tamu berhasil dihapus.',
                errorMessage: 'Data tamu gagal dihapus.'
            });
        });
    });

    $('.kirim').on('click', function(event) {
        event.preventDefault();
        $('#centangSemua').prop('checked', false);
        $('.centangTamu').prop('checked', false);

        var id_tamu = $(this).data('id');
        var $button = $(this);

        DiulemDashboard.post("<?= base_url('user/kirim_undangan') ?>", {
            id_tamu: id_tamu
        }, {
            button: $button,
            dataType: 'json',
            reload: false,
            errorMessage: 'Undangan gagal dikirim.',
            onSuccess: function(response){
                if (response.status === 'manual' && response.url) {
                    DiulemDashboard.notify('info', 'Kirim Manual', response.message || 'Silakan kirim manual via WhatsApp.')
                        .then(function () {
                            window.open(response.url, '_blank');
                            DiulemDashboard.reload();
                        });
                    return;
                }

                if (response.status === 'success') {
                    DiulemDashboard.notify('success', 'Berhasil', response.message || 'Undangan berhasil dikirim.')
                        .then(DiulemDashboard.reload);
                    return;
                }

                DiulemDashboard.notify('error', 'Gagal', response.message || 'Undangan gagal dikirim.');
            }
        });
    });
    
    
$('.edit').on('click', function (event) {
    $('#centangSemua').prop('checked', false);
    $('.centangTamu').prop('checked', false);
        var idTamu = $(this).data('id');
        var namaTamu = $(this).data('nama');
        var alamatTamu = $(this).data('alamat');
        var noWa = $(this).data('no');
       
        var tglKirim  = $(this).data('tgl');
        
        $("#modalEdit #idTamunya").val(idTamu);
        $("#modalEdit #namaTamu").val(namaTamu);
        $("#modalEdit #alamatTamu").val(alamatTamu);
        $("#modalEdit #noWa").val(noWa);
        $("#modalEdit #datepicker2").val(moment(tglKirim).format('dddd, Do MMMM YYYY'));

        $("#modalEdit #tglKirim").val(tglKirim);
         
    });
$('#editBtn').on('click', function(event) {

var id_tamu = $('#idTamunya').val();
var nama_tamu = $('#namaTamu').val();
var alamat_tamu = $('#alamatTamu').val();
var no_wa = $('#noWa').val();
var tgl_kirim = $('#tglKirim').val();

DiulemDashboard.post("<?= base_url('user/update_tamu') ?>", {
    id_tamu: id_tamu,
    nama_tamu: nama_tamu,
    alamat_tamu: alamat_tamu,
    no_wa: no_wa,
    tgl_kirim: tgl_kirim
}, {
    button: $(this),
    successMessage: 'Data tamu berhasil diupdate.',
    errorMessage: 'Data tamu gagal diupdate.'
});


});
});

</script>
<script>
$(document).ready(function () {
$('#centangSemua').click(function(e){
          if($(this).is(':checked')){
              $('.centangTamu').prop('checked', true);
          }else{
              $('.centangTamu').prop('checked', false);
          }
          
      });
    $('.formhapusbanyak').on('submit',function(e){
        e.preventDefault();
        let jmldata = $('.centangTamu:checked');
        
        if(jmldata.length === 0){
            return false;
        }else {
            DiulemDashboard.confirm({
              title: 'Hapus Banyak Data',
              text: `Yakin data Tamu dihapus sebanyak ${jmldata.length} data ?`,
              confirmButtonText: 'Ya, Hapus Data Tamu!'
            }).then((result) => {
                if(result.value) {
              DiulemDashboard.post($(this).attr('action'), $(this).serialize(), {
                  dataType: 'json',
                  reload: false,
                  errorMessage: 'Data tamu gagal dihapus.',
                  onSuccess: function(response){
                      if(response.sukses){
                        DiulemDashboard.notify('success', 'Berhasil', response.sukses).then(DiulemDashboard.reload);
                      }
                  }
              });
                }
            });
        }
        return false;
    });
});
</script>
