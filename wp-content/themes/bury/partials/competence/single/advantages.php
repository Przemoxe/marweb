<?php if (are_empty([$post->advantage->media, $post->advantage->title, $post->advantage->description])) return ?>

<section class="advantages">

    <div class="row">
        <div class="col-md-7 advantages__left" <?php if (is_image_url($post->advantage->media_url)): ?>style="background-image: url('<?= $post->advantage->media_url ?>');"<?php endif; ?>>
            <?php if (is_video_url($post->advantage->media_url)): ?>
                <video src="<?= $post->advantage->media_url ?>" muted autoplay loop></video>
            <?php elseif (is_image_url($post->advantage->media_url)): ?> 
                <img src="<?=($post->advantage->media_url)?>" alt="advantages" />
            <?php endif; ?>
        </div>
        <div class="col-md-5 advantages__right">
            <div class="advantages__content">
                <h2 class="advantages__title"><?= $post->advantage->title; ?></h2>
                <div class="advantages__description">
                    <?= $post->advantage->description; ?>
                </div>
            </div>
        </div>
    </div>

</section>