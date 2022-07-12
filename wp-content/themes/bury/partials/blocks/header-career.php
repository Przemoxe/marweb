<div class="br-block block-header-career" <?php if (is_image_url($featured_media)): ?> style="background-size: cover; background-image: url('<?= $featured_media ?>')" <?php endif; ?>>
    <?php if (!empty($featured_media)): ?>
        <?php if (is_video_url($featured_media)): ?>
            <video class="block-header-career__media" src="<?= $featured_media ?>" autoplay loop muted></video>
        <?php elseif (is_image_url($featured_media)): ?>
            <!-- <img class="block-header-career__media" src="<?= $featured_media ?>" alt="career"> -->
        <?php endif; ?>
    <?php endif; ?>

    <div class="container">
        <div class="block-header-career-content">
            <?php if (!empty($title)): ?>
                <div class="block-header-career__title"><?= $title ?></div>
            <?php endif; ?>
        
            <?php if (!empty($content)): ?>
                <?= $content ?>
            <?php endif; ?>
        
            <?php if ($link) : ?>
                <a class="button-inverted" <?php if($link['url']) : ?> href="<?= $link['url'] ?>" <?php else: ?> href="#" <?php endif; ?>><?= $link['title'] ?></a>      
            <?php endif; ?>
        </div>
    </div>

</div>