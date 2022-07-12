<?php if ($slides) :?>
    <?php $sliderTimeDefault = $sliderTime; ?>

<div id="<?= $uniqueId ?>" class="br-block row carousel slide carousel-fade" data-ride="carousel" data-interval="<?= $sliderTime ?>" data-pause="false">

    <!-- Indicators -->
    <?php if ($slides && count($slides) > 1): ?>
        <ol class="indicators carousel-indicators">
            <?php foreach ($slides as $k => $slide): ?>
                <li data-target="#<?= $uniqueId ?>" data-slide-to="<?= $k ?>" class="<?= $k == 0 ? 'active' : ''?>"></li>
            <?php endforeach; ?>
        </ol>
    <?php endif;; ?>

    <!-- Slides -->
    <div class="carousel-inner" role="listbox">
        <?php foreach ($slides as $k => $slide): ?>
            <?php if ($slide['type'] == 'video' && !empty($slide['video'])) : ?>
                <?php $sliderTime = theme()->templateTags()->getVideoLength($slide['video']); ?>
            <?php else: ?>
                <?php $sliderTime = $sliderTimeDefault ?>
            <?php endif; ?>
            
            <div class="carousel-item <?= $k == 0 ? 'active' : '' ?>" data-interval="<?= $sliderTime ?>" data-type="<?= $slide['type']?>">
                <?php if ($slide['type'] == 'image') : ?>
                    <?php
                        $slideTitle = array_get($slide, 'title_right') ?? false;
                        $slideSubtitle = array_get($slide, 'subtitle') ?? false;
                        $slideLabel = array_get($slide, 'title_left') ?? false;
                        $btnColor = theme()->getColor(array_get($slide, 'button_color'), '#002454');
                        $bgColor = theme()->getColor(array_get($slide, 'button_background'), '#aaaaaa');
                        $imgLeft = wp_get_attachment_url($slide['image_left']);
                        $imgRight = wp_get_attachment_url($slide['image_right']);
                        $button = array_get($slide, 'button');
                    ?>

                    <div class="custom-slide row">
                        <div class="img-left col-md-7" style="background-image: url('<?= $imgLeft ?>');">
                            <img src='<?= $imgLeft ?>' alt="slider-image" />
                            <?php if ($slideLabel) : ?>
                                <h2><?= $slideLabel ?></h2>
                            <?php endif; ?>
                        </div>
                        <div class="img-right col-md-5" style="background-image: url(<?= $imgRight?>)">
                            <div class="item-content">
                                <?php if ($slideTitle) : ?>
                                    <h2><?= $slideTitle ?></h2>
                                <?php endif; ?>
                                <?php if ($slideSubtitle) : ?>
                                    <p><?= $slideSubtitle ?></p>
                                <?php endif; ?>
                            </div>
                            <?php if ($button) : ?>
                                <a class="button" <?php if($button['url']) : ?> href="<?= $button['url'] ?>" <?php else: ?> href="#" <?php endif; ?> style="background-color: <?= $bgColor ?>; border: solid 1px <?= $bgColor ?>; color: <?= $btnColor ?>;"><?= $button['title'] ?></a>      
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($slide['type'] == 'imagefullwidth') : ?>
                    <?php
                        $redirect = array_get($slide, 'redirect');
                        $img = wp_get_attachment_url($slide['image']);
                    ?>
                    <?php if ($redirect) : ?>
                        <?php if($redirect['url']) : ?>
                            <a href="<?= $redirect['url']; ?>" class="test">
                        <?php endif; ?>
                    <?php endif; ?>
                        <div class="custom-slide row">
                            <div class="img-cover col" style="background-image: url('<?= $img ?>');">
                                <img src='<?= $img ?>' alt="slider-image" />
                            </div>
                        </div>
                    <?php if ($redirect) : ?>
                        <?php if($redirect['url']) : ?>
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if ($slide['type'] == 'video' && !empty($slide['video'])) : ?>

                    <?php $redirect = array_get($slide, 'redirect'); ?>
                    <?php if ($redirect) : ?>
                        <?php if($redirect['url']) : ?>
                            <a href="<?= $redirect['url']; ?>" class="test">
                        <?php endif; ?>
                    <?php endif; ?>
                    <div class="custom-slide view">
                        <video class="slide-video" autoplay muted<?= (count($slides)==1)?' loop':''; ?>>
                            <source src="<?= wp_get_attachment_url($slide['video']) ?>" type="video/mp4" />
                        </video>
                    </div>
                    <?php if ($redirect) : ?>
                        <?php if($redirect['url']) : ?>
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>
            </div>

        <?php endforeach; ?>
    </div>
    <div class="arrows"></div>
</div>
<?php endif; ?>

