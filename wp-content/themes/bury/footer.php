    <div class="top container">
        <span></span><span></span><span></span><span></span>
    </div>
    <footer class="footer">
        <div class="container">
            <div class="row footer-container footer-column">
                <div class="column col md-2">
                    <?php partial('footer-contact') ?>
                </div>
                <div class="column col md-2">
                    <?php if ( has_nav_menu( 'footer-menu-1' ) ) : ?>
                        <?php theme()->templateTags()->printFooterMenu1() ?>
                    <?php endif; ?>
                </div>
                <div class="column col md-2">
                    <?php if ( has_nav_menu( 'footer-menu-2' ) ) : ?>
                        <?php theme()->templateTags()->printFooterMenu2() ?>
                    <?php endif; ?>
                </div>
                <div class="column col md-2">
                    <?php if ( has_nav_menu( 'footer-menu-3' ) ) : ?>
                        <?php theme()->templateTags()->printFooterMenu3() ?>
                    <?php endif; ?>
                </div>
                <div class="column col md-2">
                    <?php if ( has_nav_menu( 'footer-menu-4' ) ) : ?>
                        <?php theme()->templateTags()->printFooterMenu4() ?>
                    <?php endif; ?>
                </div>
                <div class="column col md-2">
                    <?php if ( has_nav_menu( 'footer-menu-5' ) ) : ?>
                        <?php theme()->templateTags()->printFooterMenu5() ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row footer-container">
                <div class="col-copyright col-sm-9">
                    <div class="footer-logo">
                        <!--LOGO-->
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo" rel="home">
                            <?= theme()->config()->getLogo('footer'); ?>
                        </a>
                    </div>
                    <div class="footer-copyright">
                        <p>BURY copyright © <?= date("Y"); ?> Realizacja <a href="https://www.ideo.pl/" rel="nofollow">Ideo</a></p>
                        <div class="column col md-2">
                            <?php partial('footer-contact') ?>
                        </div>
                    </div>
                
                    <div class="content-menu menu">
                        <?php if ( has_nav_menu( 'footer-menu-bottom' ) ) : ?>
                            <?php theme()->templateTags()->printFooterMenuBottom() ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-social-media-footer col-sm-3 text-sm-right">
                    <div class="social-media-footer row">
                        <?php partial('social-media-profiles') ?>
                    </div>
                </div>
            </div>
        </div>
    </footer>


<!--</div>-->
<?php wp_footer(); ?>
<?php if (!theme()->isPageSpeed()): ?>
    <?= theme()->config()->pageOptions()->script->body_end_script . theme()->config()->options()->script->body_end_script ?>
<?php endif; ?>

</body>
</html>
