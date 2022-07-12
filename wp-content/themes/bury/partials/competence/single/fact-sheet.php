<?php if (are_empty([$post->fact->image, $post->fact->title, $post->fact->subtitle, $post->fact->description])) return ?>
<?php $button = $post->fact->button; ?>
<section class="fact-sheet">

    <div class="row">
        <div class="fact-sheet__left col-md-7" <?php if (!empty($post->fact->image)): ?>style="background-image: url('<?= wp_get_attachment_url($post->fact->image) ?>');"<?php endif; ?>>
            <?php if (!empty($post->fact->image)): ?><img src="<?= wp_get_attachment_url($post->fact->image)?>" alt="fact-sheet"<?php endif; ?> />
        </div>
        <div class="fact-sheet__right col-md-5">
            <div class="fact-sheet__content">
                <h2 class="fact-sheet__title"><?= $post->fact->title; ?></h2>
                <h3 class="fact-sheet__subtitle"><?= $post->fact->subtitle; ?></h3>
                <div class="fact-sheet__description">
                    <?= $post->fact->description; ?>
                </div>
                <?php if (!are_empty([$post->fact->button, $post->fact->button->url, $post->fact->button->title])): ?>
                <div>
                    <?php if ($button) : ?>
                        <a class="button-secondary" <?php if($button->url) : ?> href="<?= $button->url ?>" <?php else: ?> href="#" <?php endif; ?>><?= $button->title ?></a>      
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

</section>