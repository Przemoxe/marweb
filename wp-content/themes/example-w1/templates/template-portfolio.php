<?php
/* Template Name: Portfolio */
?>

<?php
get_header();
?>
<?php
$preheading = get_field("portfolio-preheading");
$title = get_field("portfolio-title");
$description = get_field("portfolio-description");
$image = get_field("portfolio-image")["sizes"]["medium_large"];

?>

<section class="archive-portfolio-top-section">
    <div class="main-container-px20">
        <div class="portfolio-top-container">
            <div class="portfolio-top-left">
                <p class="preheading">
                    <?= $preheading ?>
                </p>
                <h1>
                    <?= $title ?>
                </h1>
                <p>
                    <?= $description ?>
                </p>
            </div>
            <div class="portfolio-top-right">
                <img src="<?= $image ?>" alt="">
            </div>
        </div>
    </div>
</section>

<section class="archive-portfolio-projects-section">
    <div class="main-container">
        <div class="container-portfolio-projects">
            <?php
            $blog = new WP_Query(array(
                'posts_per_page' => -1,
                'post_type' => 'blog',
            ));
            while ($blog->have_posts()) {
                $blog->the_post(); ?>
                <div class="portfolio-project">
                    <div class="single-project">
                        <a href="index-header-carousel.html" class="card">
                            <div class="card-img-top">
                                <img src="<?= get_the_post_thumbnail_url() ?>" alt="">
                                <div class="card-plus">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <?= get_the_title() ?>
                                </h4>
                                <p class="card-text">
                                    <?= get_the_excerpt() ?>
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            <?php }
            wp_reset_postdata();
            ?>
        </div>
    </div>
</section>
<?php
get_footer();
?>