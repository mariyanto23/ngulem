<div class="page-body">
    <div class="container-xl">
        <div class="page-header d-print-none mb-3">
            <div class="row align-items-center">
                <div class="col">
                    <div class="page-pretitle">Setting</div>
                    <h1 class="page-title"><?= esc($title); ?></h1>
                </div>
            </div>
        </div>

        <div class="row row-cards">
            <?php foreach ($setting as $index => $paket) { ?>
            <div class="col-xl-4 col-lg-6">
                <form method="post" enctype="multipart/form-data" action="<?= base_url('admin/update_paket'); ?>">
                    <div class="card h-100">
                        <div class="card-header">
                            <h3 class="card-title">Paket <?= $index + 1 ?></h3>
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="id_paket" value="<?= esc($paket->id_paket) ?>">
                            <div class="mb-3">
                                <label class="form-label">Nama Paket Undangan</label>
                                <input name="nama_paket" type="text" class="form-control" placeholder="Masukkan nama paket" value="<?= esc($paket->nama_paket) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Harga Paket Undangan</label>
                                <input name="harga_paket" type="text" class="form-control" placeholder="Masukkan harga paket" value="<?= esc($paket->harga_paket) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Masa Aktif Undangan (hari)</label>
                                <input name="masa_aktif" type="text" class="form-control" placeholder="Masa aktif undangan" value="<?= esc($paket->masa_aktif) ?>" required>
                            </div>
                            <?php
                            $switches = [
                                ['name' => 'setTamu', 'label' => 'Halaman Bukutamu', 'value' => $paket->buku_tamu],
                                ['name' => 'setKirim', 'label' => 'Kirim Whatsapp', 'value' => $paket->kirim_whatsapp],
                                ['name' => 'setTema', 'label' => 'Bebas Pilih Tema', 'value' => $paket->tema_bebas],
                                ['name' => 'setHadiah', 'label' => 'Kirim Hadiah', 'value' => $paket->kirim_hadiah],
                                ['name' => 'setImport', 'label' => 'Import Data Tamu (Excel)', 'value' => $paket->import_datatamu],
                            ];
                            foreach ($switches as $switch) {
                                $switchId = $switch['name'] . $index;
                            ?>
                            <label class="form-check form-switch mb-2">
                                <input type="checkbox" class="form-check-input" id="<?= esc($switchId) ?>" name="<?= esc($switch['name']) ?>" <?= $switch['value'] == '1' ? 'checked' : '' ?>>
                                <span class="form-check-label"><?= esc($switch['label']) ?></span>
                            </label>
                            <?php } ?>
                        </div>
                        <div class="card-footer bg-transparent">
                            <button class="btn btn-primary w-100" type="submit">
                                <i class="ti ti-device-floppy me-2"></i>Simpan Paket
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
