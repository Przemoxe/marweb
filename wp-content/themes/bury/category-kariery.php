<?php
    get_header();
    $title = is_category() ? single_term_title( '', false ) : post_type_archive_title( '', false );
    $hasMenu = has_nav_menu('news-menu');
?>
<main class="posts">
    <div class="container"><?php theme()->templateTags()->breadrumbs(array('show_browse' => false)); ?></div>
    <?php theme()->templateTags()->printCareerMenu('category'); ?>

    <?php if ( have_posts() ): ?>
        <section class="posts-list columns">
                <?php
                    $i = 0;
                    while ( have_posts() ) {
                        $i += 1;
                        the_post();

                        $fields = get_fields($post->ID);
                        $fairThumbUrl = get_the_post_thumbnail_url();
                        ?>
                        <div class="post">
                                <?php if($i % 2){ ?>
                                <!-- IMAGE RIGHT -->
                                <div class="container">
                                <div class="row">
                                    <div class="col-md-5 order-sm-1 order-2 text-left-side medium-6 columns">
                                        <div class="post-content">
                                            <h1><a href="<?= get_permalink(); ?>"><?php the_title(); ?></a></h1>
                                                <span class="fair-dates"><?= get_the_date(); ?></span>
                                            <?php the_excerpt(); ?>
                                            <a href="<?= get_permalink(); ?>" class="button read-more" title="<?php the_title(); ?>"><?= __('Czytaj więcej', TEXT_DOMAIN) ?></a>
                                        </div>
                                    </div>

                                    <div class="col-md-7 order-sm-2 image-right hide-for-medium" <?php if($fairThumbUrl): ?> style="background:url(<?php echo the_post_thumbnail_url() ?>)no-repeat center center / cover" <?php endif; ?>>
                                    </div><!-- END IMAGE RIGHT -->
                                </div>
                                </div>
                                <?php } else { ?>
                                    <!-- IMAGE LEFT -->
                                    <div class="row">
                                        <div class="col-md-7 image-left justify-content-end hide-for-medium" style="background:url(<?php echo the_post_thumbnail_url() ?>)no-repeat center center / cover">
                                        </div>

                                        <div class="col-md-5 text-right-side medium-6 columns">
                                            <div class="post-content">
                                                <h1><a href="<?= get_permalink(); ?>"><?php the_title(); ?></a></h1>
                                                    <span class="fair-dates"><?= get_the_date(); ?></span>
                                                <?php the_excerpt(); ?>
                                                <a href="<?= get_permalink(); ?>" class="button read-more" title="<?php the_title(); ?>"><?= __('Czytaj więcej', TEXT_DOMAIN) ?></a>
                                            </div>
                                        </div><!-- END IMAGE LEFT-->
                                    </div>
                                <?php } ?>
                        </div>
                        <?php
                    }
                    wp_reset_postdata();
                ?>
            <div class="pagination-row row justify-content-center">
                    <nav class="pagination">
                        <?php
                            $templateTags->pagination();
                        ?>
                    </nav>
            </div>
        </section>
    <?php endif; ?>
</main>

<?php
    get_footer();
?>