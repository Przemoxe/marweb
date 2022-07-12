<?php
    $sizeClassOptions = [
        'small' => 'col-md-3',
        'large' => 'col-md-6',
    ];
    $sizeClass = array_get($sizeClassOptions, $item->size);
?>

<div class="<?= $sizeClass ?> border text-center">
    <div><strong><?= $item->title ?></strong></div>
    <?= wp_get_attachment_image($item->featured_image, 'medium'); ?>
</div>