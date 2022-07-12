<?php

get_header();
while ( have_posts() ) : the_post();

theme()->competenceModel()->injectField($post);
$category = theme()->competenceModel()->getPostCategory($post->ID);
?>

<main>
    <?php theme()->templateTags()->printCompetenceMenu(); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="product-title"><?= $post->post_title ?></h1>
            </div>
        </div>
    </div> 

    <div class="row">
        <div class="single-content col-12"><?= the_content(); ?></div>
    </div>

    <!-- Section - Other competences -->
    <?php partial('competence/single/other-competences', compact('post')) ?>

    <?php if (!empty($category)): ?>
    <div class="container single-competences">
        <div class="row">
            <div class="col-md-12">
                <a class="button-primary" href="<?= get_category_link($category) ?>"><?= __('Wróc do kategorii kompetencji', TEXT_DOMAIN) ?></a>
            </div>
        </div>
    </div>
    <?php endif; ?>

</main>

<?php

endwhile;
get_footer();

?>
