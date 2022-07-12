<div class="br-block row files-half" <?= $backgroundStyle ?>>
    <div class="container">
    <div class="row">
        <div class="col-md-5 description">
            <div class="content">
                <h6 class="box-title"><?= $title ?></h6>
                <p class="box-description"><?= $description ?></p>
            </div>
        </div>

        <div class="col-md-7 files-half__files-list">
            <div class="files-half__files-list__content row">
                <?php if (!empty($files)) : ?>
                    <?php foreach($files as $file) :?>
                        <?php
                            $colorText = theme()->getColor(array_get($file, 'color_text'), '#002454');
                            $textStyle = '';
                            if (!empty($colorText))
                            {
                                $textStyle = 'style="color: '.$colorText.'"';
                            }
                        ?>
                        <div class="files-half__files-list__file-box col-md-5 text-center" >
                            <a target="_blank" href="<?= wp_get_attachment_url(array_get($file, 'file')) ?>" class="files-link" <?= $textStyle ?>>
                                <div class="circle">
                                    <div class="arrow"></div>
                                </div>
                                <div class="file-name">
                                    <?= array_get($file, 'name') ?>
                                </div>
                            </a>
                            <div class="file-description" <?= $textStyle ?>>
                            <?= array_get($file, 'description') ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    </div>
</div>