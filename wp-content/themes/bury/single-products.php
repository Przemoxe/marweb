<?php

get_header();
while ( have_posts() ) : the_post();

theme()->productModel()->injectField($post);
$category = theme()->productModel()->getPostCategory($post->ID);
?>

<main>
    <?php theme()->templateTags()->printProductMenu(); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="product-title"><?= $post->post_title ?></h1>
            </div>
        </div>
    </div> 

    <!-- Section - Gallery -->
    <?php partial('product/single/gallery', compact('post')) ?>
    <!-- Section - Advantages -->
    <?php partial('product/single/advantages', compact('post')) ?>
    <!-- Section - Description -->
    <?php partial('product/single/description', compact('post')) ?>
    <!-- Section - Fact sheet -->
    <?php partial('product/single/fact-sheet', compact('post')) ?>
    <!-- Section - Other products -->
    <?php partial('product/single/other-products', compact('post')) ?>

    <?php if (!empty($category)): ?>
    <div class="container single-products">
        <div class="row">
            <div class="col-md-12">
            <?php if($post->is_archive): ?>
                <?php 
                    $archivePage = get_page_by_path( 'archiwum-produktow' );
                    $translatedArchivePage = get_page(icl_object_id($archivePage->ID));
                ?>
                <a class="button-primary" href='<?= get_permalink($translatedArchivePage); ?>'><?= __('Wróć do archiwum produktów', TEXT_DOMAIN) ?></a>
            <?php else: ?>
                <a class="button-primary" href="<?= get_category_link($category) ?>"><?= __('Wróć do kategorii produktów', TEXT_DOMAIN) ?></a>
            <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

</main>

<?php

endwhile;
get_footer();

?>
