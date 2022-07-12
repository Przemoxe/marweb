<?php
    get_header();
    global $wp_query;
    while ( have_posts() ) : the_post();

    theme()->fairModel()->injectField($post);
    $archiveUrl = get_post_type_archive_link($post->post_type);
?>

<main>
    <?php
        if(!theme()->templateTags()->printHeaderMenu('page'))
            theme()->templateTags()->printChildrensMenu($post);
    ?>
    
    <div class="single-page-content">
        <div class="column">
            <div class="row">
                <div class="col-12">
                    <h1 class="fair-title"><?= $post->post_title ?></h1>
                    <div class="fair-info">
                        <?php if($post->dateFrom && $post->dateTo): ?>
                            <span class="fair-info__dates"><strong><?= __('Termin', TEXT_DOMAIN) ?>:</strong> <span class="fair-info__dates__content"><?= $post->dateFrom->formatted ?> - <?= $post->dateTo->formatted ?></span></span>
                        <?php endif; ?>
                        <?php if($post->address): ?>
                            <span class="fair-info__address"><strong><?= __(' Adres', TEXT_DOMAIN) ?>:</strong> <span class="fair-info__address__content"><?= $post->address ?></span></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="fair-content col-12"><?= the_content(); ?></div>
            </div>

            <?php if($post->icon): ?>
                <div class="row">
                    <div class="fair-icon col-12"><img class="fair-icon" src="<?= $post->icon ?>" alt="fair-icon"></div>
                </div>
            <?php endif; ?>
            
            <?php if($post->mapCode): ?>
                <div class="row">
                    <div class="fair-map col-12"><?= $post->mapCode ?></div>
                </div>
            <?php endif; ?>
        </div>

        <div class="column">
            <a href="<?= $archiveUrl ?>" class="button-primary" title="<?= __('Wróć do listy Artykułów', TEXT_DOMAIN) ?>"><?= __('Wróć do listy wpisów', TEXT_DOMAIN) ?></a>
        </div>
    </div>
</main>
<?php
endwhile;
get_footer();
?>
