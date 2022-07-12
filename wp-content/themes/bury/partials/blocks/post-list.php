<?php if (!empty($items)): ?>
    <div class="br-block block__post-list">
        <div class="container">
            <div class="row section-header__container">
                <div class="col-md-12">
                    <?= partial('section-header', compact('title', 'link')) ?>
                </div>
            </div>
            <div class="row no-gutters">
                <?php foreach($items as $item): ?>
                    <div class="col-4 post">
                        <a href="<?= get_permalink($item); ?>">
                            <?php $date = get_the_date('d.m.Y', $item); ?>
                            <div class="block__post-list__image" style="background-image: url('<?= get_the_post_thumbnail_url($item) ?>');">
                                <div class="overlay"></div>
                            </div>
                            <div class="block__post-list__title"><?= $item->post_title; ?></div>
                            <div class="block__post-list__excerpt">
                                <?= get_the_excerpt($item); ?>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php elseif ($is_preview): ?>
    <?= __('Nie znaleziono pracowników', TEXT_DOMAIN) ?>
<?php endif; ?>