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
<nav class="single-blog-nav">
    <div class="main-container-px20">
        <nav class="single-blog-nav">
            <div class="container-title">
                <h5>
                <?= get_the_title() ?>
                </h5>
            </div>
            <div class="container-links">
                <span class="breadcrumb-item">
                    <a href="<?= get_home_url() ?>"><?= get_the_title( get_option('page_on_front') ); ?></a>
                </span>
                <span class="breadcrumb-item active">
                    <i class="arrow right"></i>
                    <?= get_the_title() ?>
                </span>
            </div>
        </nav>
    </div>
</nav>
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
                'post_type' => 'portfolio',
            ));
            while ($blog->have_posts()) {
                $blog->the_post(); 
                ?>
                
                <div class="portfolio-project">
                    <div class="single-project">
                        <a href="<?=get_field('portfolio_single_url')?>" class="card" target="_blank">
                            <div class="card-img-top">
                                <img src="<?= get_the_post_thumbnail_url() ?>" alt="portfolio-url">
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