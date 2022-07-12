<?php
$linkTitle = array_get($link, 'title');
$linkUrl = array_get($link, 'url');
?>
<div class="br-block link-tile" <?= $style ?>>
    <a class="link-container"  <?php if (!empty($link)): ?> href="<?= $linkUrl ?>"<?php endif; ?>></a>
    <div class="link-tile__content">
        <div class="link-tile__title">
            <?php if (!empty($title)): ?>
                <span class="title link"><?= $title; ?></span>
            <?php elseif (!empty($linkTitle)): ?>
                <span class="title link"><?= $linkTitle ?></span>
            <?php endif; ?>
        </div>
        <?php if (!empty($description)): ?>
            <div class="link-tile__description">
                <?= $description; ?>
            </div>
        <?php endif; ?>
    </div>
</div>