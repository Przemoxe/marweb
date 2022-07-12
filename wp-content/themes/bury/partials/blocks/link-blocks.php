<section class="br-block link-block" <?= $backgroundStyle ?>>
    <div class="container">
        <div class="services row">
        <?php if (!empty($items)) : ?>
            <?php foreach($items as $item): ?>
                <?php
                    $textColor = theme()->getColor(array_get($item, 'color_text'), '#002454');
                    $bgColor = theme()->getColor(array_get($item, 'color_background'), '#ffffff');
                    $image = array_get($item, 'image');
                    $styleBg = 'style="background-color: ' . $bgColor . '"';
                    $styleImg = null;
                    $link = array_get($item, 'link'); 
                    if (!empty($image))
                    {
                        $styleBg = '';
                        $styleImg = 'style="background-image: url(' . wp_get_attachment_url($image) . ')"';
                    }
                ?>  
                    <div class="service col-md-3 col-sm-3 text-center" <?= $styleBg ?>>
                        <?php if (empty(array_get($item, 'name'))): ?>
                            <a class="service__link" href="<?= $link['url'] ?>"></a>
                        <?php endif; ?>
                        <div class="overlay"></div>
                        <div class="content" <?= $styleImg ?>></div>
                        <div class="text row">
                            <?php if (!empty(array_get($item, 'name'))): ?>
                                <span class="text-content col" style="color: <?= $textColor ?>">
                                    <span><?= array_get($item, 'name') ?></span>
                                </span>
                            <?php else: ?>
                                <span class="text-content col">
                                    <?php if ($link) : ?>
                                        <a class="text__link" style="color:<?= $textColor ?>" <?php if($link['url']) : ?> href="<?= $link['url'] ?>" <?php else: ?> href="#" <?php endif; ?>><?= $link['title'] ?></a>
                                    <?php endif; ?>
                                </span>
                            <?php endif; ?>
                            <?php if ( is_page_template( 'templates/template-career.php' ) && !empty(array_get($item, 'description'))): ?>
                                <div class="text-description" style="color: <?= $textColor ?>"><?= array_get($item, 'description') ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
            <?php endforeach; ?>
        <?php endif; ?>
        </div>
    </div>
</section>