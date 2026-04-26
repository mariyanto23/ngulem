<?php
$themes = $tema->getResult();
$categories = [];

foreach ($themes as $theme) {
    $categoryName = $theme->category_name ?? 'Lainnya';
    $categoryId = $theme->category_id ?? 'lainnya';
    $categories[$categoryId] = $categoryName;
}

$categoryBadgeClass = static function ($categoryName) {
    $name = strtolower((string) $categoryName);

    if (strpos($name, 'slide') !== false || strpos($name, 'slider') !== false) {
        return 'diulem-theme-badge-slide';
    }

    if (strpos($name, 'scroll') !== false) {
        return 'diulem-theme-badge-scroll';
    }

    if (strpos($name, 'mobile') !== false) {
        return 'diulem-theme-badge-mobile';
    }

    if (strpos($name, 'video') !== false) {
        return 'diulem-theme-badge-video';
    }

    if (strpos($name, 'premium') !== false) {
        return 'diulem-theme-badge-premium';
    }

    return 'diulem-theme-badge-default';
};
?>

<div class="page-body">
    <div class="container-xl">
        <div class="page-header d-print-none mb-3">
            <div class="row align-items-center">
                <div class="col">
                    <div class="page-pretitle">Undangan</div>
                    <h1 class="page-title"><?= esc($title); ?></h1>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <div class="row g-3 align-items-end">
                    <div class="col-md">
                        <label class="form-label">Kategori Tampilan</label>
                        <select class="form-control" id="themeCategoryFilter">
                            <option value="all">Semua Kategori</option>
                            <?php foreach ($categories as $categoryId => $categoryName) { ?>
                                <option value="<?= esc($categoryId) ?>"><?= esc($categoryName) ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-auto">
                        <button class="btn btn-outline-primary w-100" type="button" id="resetThemeFilter">
                            <i class="ti ti-refresh me-2"></i>Reset
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-cards" id="themeGrid">
            <div class="col-sm-6 col-lg-3 theme-item" data-category="active">
                <div class="card h-100 diulem-theme-card is-active">
                    <img class="diulem-theme-preview card-img-top" src="<?= base_url() ?>/assets/themes/<?= esc($order[0]->nama_theme) ?>/preview.png" alt="<?= esc($order[0]->nama_theme) ?>">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between gap-2 mb-2">
                            <h3 class="card-title mb-0"><?= esc($order[0]->nama_theme) ?></h3>
                            <span class="badge bg-success text-success-fg">Aktif</span>
                        </div>
                        <div class="text-secondary small">Tampilan yang sedang digunakan.</div>
                    </div>
                </div>
            </div>

            <?php foreach ($themes as $row) {
                if ($row->nama_theme == $order[0]->nama_theme) {
                    continue;
                }

                $categoryName = $row->category_name ?? 'Lainnya';
                $categoryId = $row->category_id ?? 'lainnya';
            ?>
                <div class="col-sm-6 col-lg-3 theme-item" data-category="<?= esc($categoryId) ?>">
                    <div class="card h-100 diulem-theme-card">
                        <div class="position-relative">
                            <img class="diulem-theme-preview card-img-top" src="<?= base_url() ?>/assets/themes/<?= esc($row->nama_theme) ?>/preview.png" alt="<?= esc($row->nama_theme) ?>">
                            <span class="badge diulem-theme-badge <?= esc($categoryBadgeClass($categoryName)) ?>"><?= esc($categoryName) ?></span>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title mb-3"><?= esc($row->nama_theme) ?></h3>
                            <div class="btn-list">
                                <?php if ($paket[0]->tema_bebas == 1 && $order[0]->status_bayar == 2) { ?>
                                    <button class="btn btn-success btn-sm pilih" data-id="<?= esc($row->id) ?>">
                                        Pilih
                                    </button>
                                <?php } ?>
                                <a target="_blank" href="<?= SITE_UTAMA . '/demo/' . esc($row->nama_theme) ?>" class="btn btn-primary btn-sm">Demo</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="empty d-none" id="themeEmptyState">
            <div class="empty-icon"><i class="ti ti-palette"></i></div>
            <p class="empty-title">Belum ada tampilan di kategori ini</p>
            <p class="empty-subtitle text-secondary">Pilih kategori lain untuk melihat pilihan tampilan undangan.</p>
        </div>
    </div>
</div>

<script>
$('.pilih').on('click', function () {
    var $button = $(this);
    var idtema = $button.data('id');
    DiulemDashboard.post("<?= base_url('user/ganti_tema') ?>", {
        id: idtema
    }, {
        button: $button,
        successMessage: 'Tema berhasil diganti.',
        errorMessage: 'Tema gagal diganti.'
    });
});

$('#themeCategoryFilter').on('change', function () {
    var selectedCategory = $(this).val();
    var visibleCount = 0;

    $('.theme-item').each(function () {
        var itemCategory = String($(this).data('category'));
        var isVisible = selectedCategory === 'all' || itemCategory === selectedCategory || itemCategory === 'active';
        $(this).toggleClass('d-none', !isVisible);

        if (isVisible && itemCategory !== 'active') {
            visibleCount++;
        }
    });

    $('#themeEmptyState').toggleClass('d-none', visibleCount !== 0 || selectedCategory === 'all');
});

$('#resetThemeFilter').on('click', function () {
    $('#themeCategoryFilter').val('all').trigger('change');
});
</script>
