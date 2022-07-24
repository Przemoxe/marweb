<?php
/* Template Name: blog */
?>

<?php
get_header();
?>
<?php


$preheading = get_field("blog-preheading");
$getAllUrl = get_field('all_categories_url');

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
                    <a href="<?= get_home_url() ?>"><?= get_the_title(get_option('page_on_front')); ?></a>
                </span>
                <span class="breadcrumb-item active">
                    <i class="arrow right"></i>
                    <?= get_the_title() ?>
                </span>
            </div>
        </nav>
    </div>
</nav>

<section class="archive-blog-top-section">
    <div class="main-container-px20">
        <?php
        $blog = new WP_Query(array(
            'posts_per_page' => -1,
            'post_type' => 'post',
        ));
        $counter = 0;
        while ($blog->have_posts()) {
            $blog->the_post();
            if ($counter < 1) {
        ?>

                <div class="blog-top-container">
                    <div class="blog-top-left">
                        <p class="preheading">
                            <?= $preheading ?>
                        </p>
                        <h1>
                            <?= get_the_title() ?>
                        </h1>
                        <p>
                            <?= get_the_excerpt() ?>
                        </p>
                        <a href="<?= get_the_permalink() ?>" class="btn-send"><?= __('Czytaj więcej', 'marweb') ?></a>
                    </div>
                    <div class="blog-top-right">
                        <img src="<?= get_the_post_thumbnail_url() ?>" alt="">
                    </div>
                </div>

        <?php
            }
            $counter++;
        }
        wp_reset_postdata();
        ?>

    </div>

</section>

<section class="archive-blog-content-section">
    <div class="main-container-px20">
        <div class="archive-blog-posts">
            <?php
            $blog = new WP_Query(array(
                'posts_per_page' => -1,
                'post_type' => 'post',
            ));
            $counter = 0;
            while ($blog->have_posts()) {
                $blog->the_post();
                if ($counter > 0) {
            ?>

                    <div class="archive-blog-single-post">
                        <a class="" href="<?= get_the_permalink() ?>">
                            <div class="img-container">
                                <img src="<?= get_the_post_thumbnail_url() ?>" alt="">
                            </div>
                            <div class="content-container">
                                <h4>
                                    <?= get_the_title() ?>
                                </h4>
                                <p class="mb-0 text-sm text-muted">
                                    <?= get_the_excerpt() ?>
                                </p>
                            </div>
                        </a>
                    </div>

            <?php
                }
                $counter++;
            }
            wp_reset_postdata();
            ?>

        </div>
        <div class="archive-blog-posts-nav">
            <div>
                <h6 class="title">
                    Categories
                </h6>
                <div class="categories-cards">
                    <a href="<?= $getAllUrl ?>"><?= __('All', 'marweb')?></a>
                    <?php
                    $args = array(
                        "hide_empty" => 0,
                        "type"      => "post",
                        "orderby"   => "name",
                        "order"     => "ASC"
                    );
                    $types = get_categories($args);

                    foreach ($types as $el) {
                        ?>
                            <a href="<?= get_category_link($el->term_id) ?>"><?= $el->name ?></a>
                        <?php
                    }
                    ?>
                </div>




            </div>
        </div>
    </div>

</section>


<?php
get_footer();
?>