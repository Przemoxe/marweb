<?php
    $products = theme()->productModel()->getAllPublished(['category' => [$category->term_id]])->posts;
?>

<div class="top container category">
    <span></span><span></span><span></span><span></span>
</div>
<div class="container category">
    <div class="row category__row" equal-height>
        <div class="category__row__background"></div>
        
        <?php foreach($products as $item): ?>

        <div class="category-post__col col-sm-3" style="background-image: url(<?=  get_the_post_thumbnail_url($item); ?>)">         
            <a class="link-container" href="<?= get_permalink($item) ?>"></a>
            <div class="category-post__col__content" equal-height-watch>
                <span class="link category-post__col__content__name"><?= $item->post_title ?></span>
            </div> 
        </div>

        <?php endforeach; ?>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 category-post__description" has-iframe>
                <?= nl2br(do_shortcode($category->description)) ?>
            </div>
        </div>
    </div>

</div>