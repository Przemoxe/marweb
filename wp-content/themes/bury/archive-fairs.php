<?php
    get_header();
    $title = is_category() ? single_term_title( '', false ) : post_type_archive_title( '', false );
    $hasMenu = has_nav_menu('news-menu');
?>
<main class="posts fairs">
    <?php theme()->templateTags()->printHeaderMenu('fairs', false); ?>

    <?php if ( have_posts() ): ?>
        <section class="archive-fairs columns">
                <?php
                    $i = 0;
                    while ( have_posts() ) {
                        $i += 1;
                        the_post();

                        $fields = get_fields($post->ID);
                        $dateFrom = $fields['fair_date_from'] ?? null;
                        $dateTo = $fields['fair_date_to'] ?? null;
                        $fairIcon = $fields['fair_icon'] ?? null;
                        $fairAddress = $fields['fair_address'] ?? null;
                        $fairMapCode = $fields['fair_map_code'] ?? null;
                        $fairThumbUrl = get_the_post_thumbnail_url();
                        ?>
                            <div class="fair">                          
                                <?php if($i % 2){ ?>
                                <!-- IMAGE RIGHT -->
                                    <div class="container">
                                    <div class="row">
                                    <div class="col-md-5 order-sm-1 order-2 text-left-side medium-6 columns">
                                        <div class="post-content">
                                            <h2><a href="<?= get_permalink(); ?>"><?php the_title(); ?></a></h2>
                                            <?php if($dateFrom && $dateTo): ?>
                                                <span class="fair-dates"><?= $dateFrom->formatted ?> - <?= $dateTo->formatted ?></span>
                                            <?php endif; ?>
                                            <?php the_excerpt(); ?>
                                            <a href="<?= get_permalink(); ?>" class="button read-more" title="<?php the_title(); ?>"><?= __('Czytaj więcej', TEXT_DOMAIN) ?></a>
                                        </div>
                                    </div>

                                    <div class="col-md-7 order-sm-2  image-right hide-for-medium" <?php if($fairThumbUrl): ?> style="background:url(<?php echo the_post_thumbnail_url() ?>)no-repeat center center / cover" <?php endif; ?>>
                                        <?php if($fairIcon): ?>
                                            <img class="fair-icon" src="<?= $fairIcon ?>" alt="icon">
                                        <?php endif; ?>
                                    </div><!-- END IMAGE RIGHT -->
                                    </div>
                                    </div>
                                <?php } else { ?>
                                    <!-- IMAGE LEFT -->
                                    <div class="row">
                                        <div class="col-md-7 image-left justify-content-end hide-for-medium" style="background:url(<?php echo the_post_thumbnail_url() ?>)no-repeat center center / cover">
                                            <?php if($fairIcon): ?>
                                                <img class="fair-icon" src="<?= $fairIcon ?>" alt="icon">
                                            <?php endif; ?>
                                        </div>

                                        <div class="col-md-5 text-right-side medium-6 columns">
                                            <div class="post-content">
                                                <h2><a href="<?= get_permalink(); ?>"><?php the_title(); ?></a></h2>
                                                <?php if($dateFrom && $dateTo): ?>
                                                    <span class="fair-dates"><?= $dateFrom->formatted ?> - <?= $dateTo->formatted ?></span>
                                                <?php endif; ?>
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