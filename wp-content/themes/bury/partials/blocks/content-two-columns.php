<div class="br-block content-two-columns" style="background-image: url(<?= $image ?>)">
    <div class="container">
    <?php if(!empty($title)) :?> <h2 class="content-two-columns__title"><?= $title; ?></h2> <?php endif; ?>
    <?php if(!empty($subtitle)) :?> <h3 class="content-two-columns__subtitle"><?= $subtitle; ?></h3> <?php endif; ?>
        <div class="row justify-content-between">
            <div class="content-two-columns__column content-two-columns__left col-sm-12 col-md-6">
                <?= $contentLeft; ?>
            </div>
            <div class="content-two-columns__column content-two-columns__right col-sm-12 col-md-6">
                <?= $contentRight; ?>
            </div>
        </div>
    </div>
</div>