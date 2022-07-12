<?php
    $products = theme()->competenceModel()->getAllPublished(['category' => [$category->term_id]])->posts;
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
                <span class="link category-post__col__content__name" style="color: <?= theme()->getColor($item->color, '#ffffff') ?>"><?= $item->post_title ?></span>
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
<?php if($contactform = get_field('formularz_kontaktowy',$category->taxonomy.'_'.$category->term_id)): ?>
    <div class="br-block contact-form-7">
        <img width="1024" height="509" src="https://bury.ires.pl/wp-content/uploads/2020/08/formularz-tlo-1024x509_2.png" class="attachment-full size-full" alt="" loading="lazy" srcset="https://bury.ires.pl/wp-content/uploads/2020/08/formularz-tlo-1024x509_2.png 1024w, https://bury.ires.pl/wp-content/uploads/2020/08/formularz-tlo-1024x509_2-300x149.png 300w, https://bury.ires.pl/wp-content/uploads/2020/08/formularz-tlo-1024x509_2-768x382.png 768w, https://bury.ires.pl/wp-content/uploads/2020/08/formularz-tlo-1024x509_2-150x75.png 150w, https://bury.ires.pl/wp-content/uploads/2020/08/formularz-tlo-1024x509_2-140x70.png 140w" sizes="(max-width: 1024px) 100vw, 1024px">        <div class="container">
        <div class="row">
            <div class="col-12 content">    
                <?php echo do_shortcode("[contact-form-7 id='".$contactform."']"); ?>
            </div>
        </div>
    </div>
<?php endif; ?>