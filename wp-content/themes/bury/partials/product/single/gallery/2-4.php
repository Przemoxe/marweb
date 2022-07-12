<?php
$sizeClassOptions = [
    'small' => 'product-gallery__list-item--size-small',
    'large' => 'product-gallery__list-item--size-large',
];
?>
<div class="row">

    <div class="col-md-12">

        <div class="product-gallery__container">

            <!-- selected -->
            <?php foreach($items as $index => $item): ?>
                <?php
                    $active = $index == 0 ? 'product-gallery__item--active' : '';
                ?>

                <!-- rotator -->
                <div data-item-index="<?= $index ?>" id="product-gallery-slider-<?= $index ?>" class="<?= $active ?> product-gallery__item product-gallery__slider carousel slide carousel-fade" data-ride="carousel" data-interval="4000">
                    <!-- Slides -->
                    <div class="carousel-inner" role="listbox">
                        <?php foreach ($item->images as $imageIndex => $image): ?>
                            <div data-interval="4000" class="carousel-item <?= $imageIndex == 0 ? 'active' : '' ?>" style="background-image: url('<?= wp_get_attachment_image_url($image, 'full'); ?>');">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <?php if ($item->images && count($item->images) > 1): ?>
                        <!-- Indicators -->
                        <ol data-item-index="<?= $index ?>" class="product-gallery__item product-gallery__slider-indicators <?= $active ?> indicators carousel-indicators square">
                            <?php foreach ($item->images as $imageIndex => $image): ?>
                                <li data-target="#product-gallery-slider-<?= $index ?>" data-slide-to="<?= $imageIndex ?>" class="<?= $imageIndex == 0 ? 'active' : ''?>"></li>
                            <?php endforeach; ?>
                        </ol>
                        <!-- Arrows -->
                        <a class="carousel-control-prev" href="#product-gallery-slider-<?= $index ?>" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#product-gallery-slider-<?= $index ?>" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    <?php endif; ?>
                </div>
        
                <!-- title -->
                <div data-item-index="<?= $index ?>" class="product-gallery__item product-gallery__title-content <?= $active ?>" anchor>
                    <div class="product-gallery__title-box">
                        <div>
                            <h2 class="product-gallery__item product-gallery__title"><?= $item->title ?></h3>
                            <h6 class="product-gallery__item product-gallery__subtitle"><?= $item->subtitle ?></h6>
                        </div>
                    </div>
                </div>
                <!-- description -->
                <div data-item-index="<?= $index ?>" class="product-gallery__item product-gallery__description <?= $active ?>" data-simplebar>
                    <?= $item->description ?>
                </div>

            <?php endforeach; ?>

            <!-- list -->
            <?php foreach($items as $index => $item): ?>
                <?php $bgColor = theme()->getColor($item->featured_background, '#ffffff') ?>
                <?php
                    $current = $index == 0 ? 'product-gallery__list-item--current' : '';
                ?>
                <?php if ($item->thumbnail_type == 'image'): ?>
                    <div data-item-index="<?= $index ?>"  class="product-gallery__list-item product-gallery__list-item-<?= $index ?> product-gallery__list-item--type-image  <?= array_get($sizeClassOptions, $item->size) ?> <?= $current ?> " style="background-image: url('<?= wp_get_attachment_image_url($item->featured_image, 'full'); ?>');" anchor-link>
                        <!-- <?= wp_get_attachment_image($item->featured_image, 'medium'); ?> -->
                        <div class="product-gallery__list-item--content">
                            <span class="product-gallery__list-item--title"><?= $item->title ?></span>
                            <?php if(!empty($item->excerpt)) : ?> <span class="product-gallery__list-item--excerpt" <?php if($bgColor  === "#002454") : ?> style="color: white" <?php endif; ?>><?= $item->excerpt?></span> <?php endif; ?>
                        </div>
                    </div>
                <?php else: ?>
                    <div data-item-index="<?= $index ?>" style="background-color: <?= $bgColor ?> " class="product-gallery__list-item product-gallery__list-item-<?= $index ?> product-gallery__list-item--type-background <?= array_get($sizeClassOptions, $item->size) ?> <?= $current ?> " anchor-link>
                        <div class="product-gallery__list-item--content">
                            <span class="product-gallery__list-item--title" <?php if($bgColor === "#002454") : ?> style="color: white" <?php endif; ?>><?= $item->title ?></span>
                            <?php if(!empty($item->excerpt)) : ?> <span class="product-gallery__list-item--excerpt" <?php if($bgColor  === "#002454") : ?> style="color: white" <?php endif; ?>><?= $item->excerpt?></span> <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
            <!-- /list -->

        </div>


    </div>

</div>