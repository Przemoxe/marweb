<div class="br-block <?= $class ?> row <?= $rowClass ?>">
    <?= $containerOpen ?>
    <div class="col-md-7 html-content">
        <div class="subtitle" > <?php if($subtitle) : ?> <h2> <?= $subtitle ?> </h2><?php endif; ?></div>
        <div class="html-inner-content">
            <?= $html ?>
        </div>
        <?php if ($alerts && is_array($alerts)) : ?>
            <div class="facts">
                <?php foreach ($alerts as $alert) : ?>
                    <?php 
                        $alertTextColor = theme()->getColor(array_get($alert, 'color_text'), '#aaaaaa');
                        $alertBgColor = theme()->getColor(array_get($alert, 'color_background'), '#002454');
                        $alertLabel = array_get($alert, 'label', false);
                        $alertText = array_get($alert, 'description', false);
                    ?>
                    <div class="fact" style="color:<?= $alertTextColor ?>;background-color:<?= $alertBgColor ?>">
                    
                        <?php if ($alertLabel) : ?>
                            <span class="fact-label"><?= $alertLabel ?></span>
                        <?php endif; ?>

                        <?php if ($alertText) : ?>
                            <span class="fact-text"><?= $alertText ?></span>
                        <?php endif; ?>
                    </div>

                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="text-content col-md-5">
    <div class="content">
        <h2> <?= $title ?> </h2>
        <p></p>
        <?= $content ?><br/>
        <?php if ($button) : ?>
            <a class="button" <?php if($button['url']) : ?> href="<?= $button['url'] ?>" <?php else: ?> href="#" <?php endif; ?>><?= $button['title'] ?></a>      
        <?php endif; ?>
        <?php if ($alerts && is_array($alerts)) : ?>
            <div class="facts">
                <?php foreach ($alerts as $alert) : ?>
                    <?php 
                        $alertTextColor = theme()->getColor(array_get($alert, 'color_text'), '#aaaaaa');
                        $alertBgColor = theme()->getColor(array_get($alert, 'color_background'), '#002454');
                        $alertLabel = array_get($alert, 'label', false);
                        $alertText = array_get($alert, 'description', false);
                    ?>
                    <div class="fact" style="color:<?= $alertTextColor ?>;background-color:<?= $alertBgColor ?>">
                    
                        <?php if ($alertLabel) : ?>
                            <span class="fact-label"><?= $alertLabel ?></span>
                        <?php endif; ?>

                        <?php if ($alertText) : ?>
                            <span class="fact-text"><?= $alertText ?></span>
                        <?php endif; ?>
                    </div>

                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>   
    </div>
    <?= $containerClose ?>
</div>