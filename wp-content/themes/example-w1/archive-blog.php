<?php
get_header();
?>

<section class="archive-blog-top-section">
    <div class="main-container-px20">
        <div class="blog-top-container">
            <div class="blog-top-left">
                <p class="preheading">
                    by Simpleqode
                </p>
                <h1>
                    What are the big reasons for marketing your business
                </h1>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus odio nesciunt harum neque deserunt deleniti nemo, explicabo id accusamus voluptatum dolor.
                </p>
            </div>
            <div class="blog-top-right">
                <img src="<?= get_template_directory_uri() . '/assets/src/front/images/asdas.jpg' ?>" alt="">
            </div>
        </div>
    </div>
</section>

<section class="archive-blog-content-section">
    <div class="main-container-px20">
        <div class="archive-blog-posts">
            <?php
            $blog = new WP_Query(array(
                'posts_per_page' => -1,
                'post_type' => 'blog',
            ));
            while ($blog->have_posts()) {
                $blog->the_post(); ?>
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
            <?php }
            wp_reset_postdata();
            ?>
        </div>
        <div class="archive-blog-posts-nav">
            <div>
                <h6 class="title">
                    Categories
                </h6>
                <div>
                    <a href="">Example</a>
                </div>
                <div>
                    <a href="">Example</a>
                </div>
                <div>
                    <a href="">Example</a>
                </div>
                <div>
                    <a href="">Example</a>
                </div>
                <div>
                    <a href="">Example</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
?>