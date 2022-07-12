<?php
get_header();
global $wp_query;
while ( have_posts() ) : the_post();

$primaryCategoryId = yoast_get_primary_term_id('category', $post);
$categoryLink = null;
if (!empty($primaryCategoryId))
{
    $categoryLink = get_category_link($primaryCategoryId);
}
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
                    <h1 class="single-title"><?= $post->post_title ?></h1>

                    <div class="single-info">
                        <span class="single-info__dates"><strong><?= __('Data', TEXT_DOMAIN) ?>: </strong><?= get_the_date('', $post) ?></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="single-content col-12"><?= the_content(); ?></div>
            </div>

            <!-- <div class="row">
                <div class="single-comments col-12">
                    <?php //comments_template( '', true ); ?>
                </div>
            </div> -->
        </div>
        <?php if (!empty($categoryLink)): ?>
        <div class="column">
            <a href="<?= $categoryLink ?>" class="button-primary" title="<?= __('Wrróć do listy Artykułów', TEXT_DOMAIN) ?>"><?= __('Wróć do listy wpisów', TEXT_DOMAIN) ?></a>
        </div>
        <?php endif; ?>
    </div>
</main>
<?php
endwhile;
get_footer();
?>
