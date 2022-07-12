<?php if (empty($post->other_products)) return; ?>

<section class="other-products">

    <div class="container">
        <div class="section-header">
            <h2 class="other-products__header"><?= __('Inne kompetencje', TEXT_DOMAIN) ?></h2>
        </div>
        <div class="other-products__row row">
            <?php foreach($post->other_products as $item): ?>
                <div class="other-products__col col-md-4">
                    <a class="link-container" href="<?= get_permalink($item) ?>"></a>
                    <div class="other-products__image"><?= get_the_post_thumbnail($item, 'full') ?></div>
                    <div class="other-products__name-container"><span class="other-products__name"><?= $item->post_title ?></span></div>
                    <div class="other-products__description"><?= get_the_excerpt($item) ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</section>