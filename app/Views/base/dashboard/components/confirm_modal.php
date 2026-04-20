<?php
$modalId = $modalId ?? 'modalHapus';
$title = $title ?? 'Peringatan';
$message = $message ?? 'Apakah kamu yakin?';
$hiddenName = $hiddenName ?? 'id';
$hiddenId = $hiddenId ?? $hiddenName;
$confirmId = $confirmId ?? 'hapusBtn';
$confirmText = $confirmText ?? 'Hapus';
$confirmClass = $confirmClass ?? 'btn-danger';
$cancelText = $cancelText ?? 'Batal';
?>

<div class="modal fade" id="<?= esc($modalId) ?>" tabindex="-1" role="dialog" aria-labelledby="<?= esc($modalId) ?>Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="<?= esc($modalId) ?>Label"><?= esc($title) ?></h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?= esc($message) ?>
                <input type="hidden" name="<?= esc($hiddenName) ?>" id="<?= esc($hiddenId) ?>" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm <?= esc($confirmClass) ?>" id="<?= esc($confirmId) ?>"><?= esc($confirmText) ?></button>
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><?= esc($cancelText) ?></button>
            </div>
        </div>
    </div>
</div>
