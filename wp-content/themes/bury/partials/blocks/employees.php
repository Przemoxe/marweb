<?php if (!empty($items)): ?>
    <div class="br-block employees" equal-height>
        <div class="container">
            <div class="row">
                <?php foreach($items as $item): ?>
                    <div class="employees__employee col-sm-12 col-md-3">
                        <div class="shadow"></div>
                        <?= wp_get_attachment_image(array_get($item, 'image'), 'medium img-fluid') ?>
                        <div class="employees__employee__description content text-center" equal-height-watch>
                            <div class="employees__employee__description__name">
                                <strong><?= array_get($item, 'fullname') ?></strong>
                            </div>
                            <?php $positions = explode(",", array_get($item, 'position')); ?>
                            <?php foreach($positions as $position){ ?>
                                <span class="employees__employee__description__position" >
                                    <?= $position ?>                                   
                                </span>
                            <?php } ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php elseif ($is_preview): ?>
    <?= __('Nie znaleziono pracowników', TEXT_DOMAIN) ?>
<?php endif; ?>