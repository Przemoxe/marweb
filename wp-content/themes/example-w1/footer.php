<?php wp_footer(); ?>

<footer>
    <div class="main-container">
        <div class="footer-widgets-container">
            <div class="footer-widgets">
                <aside class="widget">
                    <div class="widget-title">
                        <h6>About Us</h6>
                    </div>
                    <div class="textwidget">
                        <p>Map where your photos were taken and discover local points of interest. Map where your photos.</p>
                        <p>
                            Location: 12 London Avenue, Suite 18<br>
                            E-mail: support@theme.com<br>
                            Phone: 8 800 123 4567<br>
                        </p>
                    </div>
                </aside>
            </div>
            <div class="footer-widgets">
                <aside class="widget widget-recent-entries">
                    <div class="widget-title">
                        <h6>Recent Posts</h6>
                    </div>
                    <ul>
                        <?php
                        $blog = new WP_Query(array(
                            'posts_per_page' => 6,
                            'post_type' => 'blog',
                        ));
                        while ($blog->have_posts()) {
                            $blog->the_post(); ?>

                            <li><a href="#"><?= get_the_excerpt() ?></a><span class="post-date"><?= get_the_date() ?></span></li>

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
                                    <a href="#">
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
            <p>© 2022 Marweb.pl, All Rights Reserved</p>
        </div>
    </div>
</footer>


</body>

</html>