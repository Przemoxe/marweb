<?php
    $languages = apply_filters( 'wpml_active_languages', NULL, array( 'skip_missing' => 0 ) );
    $current_lang = apply_filters( 'wpml_current_language', NULL );
?>

<ul class="language">
    <?php foreach($languages as $language): ?> 
        <li>
            <?php if ($language['language_code'] == $current_lang): ?>
                <a href="javascript:;" class="is-current">
                    <?= $language['code'] ?>
                </a>
            <?php else: ?>
                <a href="<?= $language['url'] ?>">
                    <?= $language['code'] ?>
                </a>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>    
</ul>