<div class="career__section-header d-flex justify-content-between">
    <h2 class="title"><?= $title ?></h2>
    <?php if ($link) : ?>
            <a class="button-inverted button" <?php if($link['url']) : ?> href="<?= $link['url'] ?>" <?php else: ?> href="#" <?php endif; ?>><?= $link['title'] ?></a>      
    <?php endif; ?>
</div>