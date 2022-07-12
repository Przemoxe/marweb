<div class="br-block files-full" <?= $backgroundStyle ?>>
    <div class="br-block container">
        <div class="row">
            <div class="col-md-12">
                <?php if (!empty($files)) : ?>
                    <div class="row justify-content-center">
                        <?php foreach($files as $file) :?>
                            <?php
                                $colorText = theme()->getColor(array_get($file, 'color_text'), '#002454');;
                                $textStyle = '';
                                if (!empty($colorText))
                                {
                                    $textStyle = 'style="color: '.$colorText.'"';
                                }
                            ?>
                            <?php if (!empty(array_get($file, 'file'))) : ?>
                                <div class="files-full__file-box col-sm-3 text-center" style="background-color: #002454;">
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
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>