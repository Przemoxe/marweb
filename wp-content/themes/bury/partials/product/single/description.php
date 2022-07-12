<?php if(empty($post->description)) return ?>

<section class="product-description">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 product-description__content" has-iframe>
                <?= do_shortcode($post->description) ?>
            </div>
        </div>
    </div>
</section>