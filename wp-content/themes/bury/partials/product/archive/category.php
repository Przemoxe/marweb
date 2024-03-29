<div class="top container category">
    <span></span><span></span><span></span><span></span>
</div>
<div class="container category">
    <div class="row category__row" equal-height>
        <div class="category__row__background"></div>
        <?php foreach($categories as $item): ?>
            <div class="category__col col-sm-4 category__col__type-image" style="background-image: url('<?= wp_get_attachment_url($item->image); ?>')">
                <a class="link-container" href="<?= get_category_link($item) ?>"></a> 
                <div class="category__col__content <?php if(!empty($item->description)): ?>  <?php endif; ?>" equal-height-watch>
                    <h2 class="link category__col__content__name" style="color: <?= theme()->getColor($item->color, '#ffffff') ?>"><?= $item->name ?></h2>
                </div>
            </div>
        <?php endforeach; ?>
        <?php foreach($products as $item): ?>
            <div class="category__col col-sm-4 category__col__type-image" style="background-image: url(<?=  get_the_post_thumbnail_url($item); ?>)">         
                <a class="link-container" href="<?= get_permalink($item) ?>"></a>
                <div class="category-post__col__content" equal-height-watch>
                    <span class="link category-post__col__content__name"><?= $item->post_title ?></span>
                </div> 
            </div>
        <?php endforeach; ?>
    </div>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 category__description" has-iframe>
                <?= nl2br(do_shortcode($category->description)) ?>
            </div>
        </div>
    </div>

</div>