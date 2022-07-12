<?php
    get_header();
?>

<div class="row column">
    <nav role="navigation">
        <?php
            partial('breadcrumbs', [
                'steps' => [
                    ['title' => get_the_title()],
                ]
            ]);
        ?>
    </nav>
</div>

<?php if ( have_posts() ): ?>
    <section class="loop-posts columns">
            <?php
                $i = 0;
                while ( have_posts() ) {
                    $i += 1;
                    the_post();

                    if ($i % 2 == 0):
                        ?>
                            <div class="row">
                                <div class="small-12 hide-for-medium">
                                    <?= get_the_post_thumbnail(); ?>
                                </div>
                                <div class="small-12 medium-6 columns">
                                    <div class="post-content text-left-side">
                                        <span><?php echo get_the_date(); ?></span>
                                        <h1><a href="<?= get_permalink(); ?>"><?php the_title(); ?></a></h1>
                                        <?php the_excerpt(); ?>
                                        <a href="<?= get_permalink(); ?>" class="read-more" title="<?php the_title(); ?>">> <?= __('Dowiedz się więcej', TEXT_DOMAIN) ?></a>
                                    </div>
                                </div>
                                <div class="small-12 medium-6 columns image-right" style="background:url(<?php echo the_post_thumbnail_url() ?>)no-repeat center center / cover">
                                </div>
                            </div>
                        <?php
                    else:
                        ?>
                            <div class="row">
                                <div class="small-12 hide-for-medium">
                                    <?= get_the_post_thumbnail(); ?>
                                </div>
                                <div class="small-12 medium-6 columns image-left" style="background:url(<?php echo the_post_thumbnail_url() ?>)no-repeat center center / cover">
                                </div>
                                <div class="small-12 medium-6 columns">
                                    <div class="post-content text-right-side">
                                        <span><?php echo get_the_date(); ?></span>
                                        <h1><a href="<?= get_permalink(); ?>"><?php the_title(); ?></a></h1>
                                        <?php the_excerpt(); ?>
                                        <a href="<?= get_permalink(); ?>" class="read-more" title="<?php the_title(); ?>">> <?= __('Dowiedz się więcej', TEXT_DOMAIN) ?></a>
                                    </div>
                                </div>
                            </div>
                        <?php
                    endif;

                }
                wp_reset_postdata();
            ?>
        <div class="row text-center">
            <div class="medium-12 columns">
                <nav class="pagination">
                    <?php
                        $templateTags->pagination( );
                    ?>
                </nav>
            </div>
        </div>
    </section>
<?php endif; ?>


<?php
    get_footer();
?>