<?php
    $first = head($items);
?>

<div class="row">

    <div class="col-md-12">

        <div class="product-gallery__container">
            
            <!-- rotator -->
            <div id="product-gallery-slider" class="product-gallery__item product-gallery__slider br-block carousel slide carousel-fade" data-ride="carousel" data-interval="4000">
                <!-- Slides -->
                <div class="carousel-inner" role="listbox">
                    <?php foreach ($first->images as $index => $image): ?>
                        <div data-interval="4000" style="background-image: url('<?= wp_get_attachment_image_url($image, 'full'); ?>');" id="product-gallery-slider-<?= $index ?>" class="carousel-item <?= $index == 0 ? 'active' : '' ?>">
                        </div>
                    <?php endforeach; ?>
                </div>  

                <?php if ($first->images && count($first->images) > 1): ?>
                    <!-- Indicators -->
                    <ol class="indicators product-gallery__slider-indicators carousel-indicators square">
                        <?php foreach ($first->images as $index => $image): ?>
                            <li data-target="#product-gallery-slider" data-slide-to="<?= $index ?>" class="<?= $index == 0 ? 'active' : ''?>"></li>
                        <?php endforeach; ?>
                    </ol>
                    <!-- Arrows -->
                    <a class="carousel-control-prev" href="#product-gallery-slider" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#product-gallery-slider" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                <?php endif; ?>
            </div>
    
            <!-- title -->
            <div class="product-gallery__item product-gallery__title-content">
                <div>
                    <h2 class="product-gallery__item product-gallery__title"><?= $first->title ?></h2>
                    <h6 class="product-gallery__item product-gallery__subtitle"><?= $first->subtitle ?></h6>
                </div>
            </div>
            <!-- description -->
            <div class="product-gallery__item product-gallery__description" data-simplebar>
                <?= $first->description ?>
            </div>

        </div>


    </div>

</div>