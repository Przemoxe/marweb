<div class="br-block block-video">
    <div class="container">
        <div class="row">
            <div class="col-md-12 block-video__content">
                <div class="embed-container" data-type="oembed">
                    <?= $oembed ?>
                    <?php if (!empty($featured_image)): ?>
                        <div class="featured-image">
                            <div class="featured-image__content" style="background-image: url('<?= $featured_image ?>');"></div>
                            <div class="overlay-play"><div class="overlay-button"></div></div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>