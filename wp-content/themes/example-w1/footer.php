<?php wp_footer(); ?>

<footer>
    <div class="main-container">
        <div class="footer-widgets-container">
            <div class="footer-widgets">
                <aside class="widget">
                    <div class="widget-title">
                        <h6><?= __('O Nas', 'marweb') ?></h6>
                    </div>
                    <div class="textwidget">
                        <p>
                            <?php
                            $query = new WP_Query(
                                array(
                                    'post_type' => 'page', //it is a Page right?
                                    'post_status' => 'publish',
                                    'meta_query' => array(
                                        array(
                                            'key' => '_wp_page_template',
                                            'value' => 'templates/about-us.php', // folder + template name as stored in the dB
                                        )
                                    )
                                )
                            );
                            while ($query->have_posts()) {
                                $query->the_post();
                                $description = get_field('description', get_the_ID());
                            ?>
                                <a href="<?= get_the_permalink() ?>"  aria-label="blog link">
                                    <?= mb_strimwidth($description, 0, 100, "..."); ?>
                                </a>
                            <?php
                            }
                            wp_reset_postdata();

                            ?>
                        </p>
                        <div class="data">
                            <?php
                            $query = new WP_Query(
                                array(
                                    'post_type' => 'page', //it is a Page right?
                                    'post_status' => 'publish',
                                    'meta_query' => array(
                                        array(
                                            'key' => '_wp_page_template',
                                            'value' => 'templates/template-kontakt.php', // folder + template name as stored in the dB
                                        )
                                    )
                                )
                            );
                            while ($query->have_posts()) {
                                $query->the_post();

                                $dataInfoCards = get_field('data_info_cards', get_the_ID());
                                foreach ($dataInfoCards as $el) {
                            ?>
                                    <p> <?= $el["info_title"] ?> <?= $el["data"] ?></p><br>
                            <?php
                                }
                            }
                            wp_reset_postdata();

                            ?>
                        </div>
                    </div>
                </aside>
            </div>
            <div class="footer-widgets">
                <aside class="widget widget-recent-entries">
                    <div class="widget-title">
                        <h6><?= __('Ostatnie wpisy', 'marweb') ?></h6>
                    </div>
                    <ul>
                        <?php
                        $blog = new WP_Query(array(
                            'posts_per_page' => 6,
                            'post_type' => 'post',
                        ));
                        
                        while ($blog->have_posts()) {
                            $blog->the_post(); 
         
                            ?>
    
                            <li><a href="<?= get_permalink() ?>" aria-label="excerpt blog"><?= get_the_excerpt() ?></a><span class="post-date"><?= get_the_date() ?></span></li>

                        <?php }
                        wp_reset_postdata();
                        ?>

                    </ul>
                </aside>
            </div>
            <div class="footer-widgets">
                <aside class="widget widget-menu">
                    <div class="widget-title">
                        <h6>Menu</h6>
                        <?php
                        wp_nav_menu([
                            'theme_location'    => 'footer-menu',
                            'menu_id'            => 'footer-menu',
                            'container_class'   => 'footer-menu',
                        ]);
                        ?>
                    </div>
                    <div class="twitter-feed" data-twitter="double_theme" data-number="1" id="twitter-0"></div>
                </aside>
            </div>
            <div class="footer-widgets">
                <aside class="widget widget-recent-works">
                    <div class="widget-title">
                        <h6>Portfolio</h6>
                    </div>
                    <div class="container-recent-works">
                        <?php
                        $blog = new WP_Query(array(
                            'posts_per_page' => 6,
                            'post_type' => 'portfolio',
                        ));
                        while ($blog->have_posts()) {
                            $blog->the_post(); ?>
                            <div class="container-card-recent-work">
                                <div class="card-recent-work">
                                    <a href="<?= get_field('portfolio_single_url', $el->ID)?>" target="_blank"  aria-label="portfolio link">
                                        <?= get_the_post_thumbnail() ?>
                                    </a>
                                </div>
                            </div>

                        <?php }
                        wp_reset_postdata();
                        ?>
                    </div>
                </aside>
            </div>
        </div>
    </div>
    <div class="main-container-px20">
        <div class="copyright">
            <p>© 2022 elcode.pl, All Rights Reserved</p>
        </div>
    </div>
</footer>


</body>

</html>