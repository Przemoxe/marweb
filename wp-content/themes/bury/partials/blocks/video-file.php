<div class="br-block block-video">
    <div class="container">
        <div class="row">
            <div class="col-md-12 block-video__content">
                <div class="embed-container" data-type="file">
                    <video src="<?= $file ?>"></video>                  
                    <div class="featured-image">
                        <?php if (!empty($featured_image)): ?>
                           <div class="featured-image__content" style="background-image: url('<?= $featured_image ?>');"></div>
                        <?php endif; ?>    
                        <div class="overlay-play"><div class="overlay-button"></div></div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>