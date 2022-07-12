<?php
    $homeUrl = esc_url( home_url( '/' ) );
    $cookieInfo = theme()->config()->options()->cookie_info;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <link href="https://fonts.googleapis.com/css?family=Barlow:400,700,900&display=swap&subset=latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap&subset=cyrillic-ext" rel="stylesheet">

    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/assets/dist/favicons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri(); ?>/assets/dist/favicons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/assets/dist/favicons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/assets/dist/favicons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/assets/dist/favicons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/assets/dist/favicons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/assets/dist/favicons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/assets/dist/favicons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/dist/favicons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo get_template_directory_uri(); ?>/assets/dist/favicons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/assets/dist/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_template_directory_uri(); ?>/assets/dist/favicons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/assets/dist/favicons/favicon-16x16.png">
    <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/assets/dist/favicons/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/assets/dist/favicons/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <?php wp_head(); ?>

    <?php if (1 == get_option( 'blog_public' )): ?>
        <meta name="robots" content="index,follow" />
    <?php endif; ?>

    <?php if (!theme()->isPageSpeed()): ?>
        <?= theme()->config()->pageOptions()->script->head_script . theme()->config()->options()->script->head_script ?>
    <?php endif; ?>
    <?php theme()->templateTags()->getThemeColorStyle() ?>
</head>


<body <?php body_class(); ?>>
    <?php if (!theme()->isPageSpeed()): ?>
        <?= theme()->config()->pageOptions()->script->body_start_script . theme()->config()->options()->script->body_start_script ?>
    <?php endif; ?>
            <header>
                <!-- COOKIES INFO -->
                <?php if (!theme()->isPageSpeed() && !empty($cookieInfo->content) && !empty($cookieInfo->buttons)) : ?>
                    <div id="cookie-notice" class="cookie-notice is-clicked">
                        <div class="container">
                            <div class="row">
                                <div class="cookie-notice__content col-md-8 ">
                                    <?= $cookieInfo->content; ?>
                                </div>
                                <div class="cookie-notice__buttons col-md-4 text-sm-right text-center">
                                    <?php foreach ($cookieInfo->buttons as $key => $button) : ?>
                                        <?php if ($key == '0') : ?>
                                            <a href="<?= $button->url; ?>" id="cn-refuse-cookie" class="button button--secondary button--small">
                                                <?= $button->label; ?>
                                            </a>
                                        <?php else : ?>
                                            <a href="javascript:;" id="cn-accept-cookie" data-cookie-set="accept" class="button button--primary button--small with-icon">
                                                <?= $button->label; ?>
                                                <i class="icon-button-arrow-right"></i>
                                            </a>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                    <div class="top">
                        <div class="container">
                            <span></span><span></span><span></span><span></span>
                        </div>
                    </div>
                    <div class="site-branding">
                        <nav>
                            <div class="container">
                                <!-- LANGUAGE SWITCHER -->
                                <?php partial('language-switcher') ?>
                                <div class="content" style="clear: both;">
                                    <!--LOGO-->
                                    <div class="logo__container">
                                        <?php if( is_front_page() ) : ?>
                                            <h1>
                                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo" rel="home">
                                                    <img src="<?= theme()->config()->getLogoSrc() ?>" alt="<?php echo get_bloginfo( 'name' ); ?>" />
                                                </a>
                                            </h1>
                                        <?php else: ?>
                                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo" rel="home">
                                                <img src="<?= theme()->config()->getLogoSrc() ?>" alt="<?php echo get_bloginfo( 'name' ); ?>" />
                                            </a>
                                        <?php endif ?>
                                    </div>       
                                    <!-- HAMBURGER -->
                                    <button class="hamburger" type="button" aria-label="menu">
                                        <span class="hamburger-icon"></span>
                                    </button>

                                    <?php get_search_form(); ?>
                                </div><!-- logo, button -->
                            </div>
                        </nav>
                        <div class="content-menu menu">
                            <div class="container">
                                <div class="row">
                                    <div class="menu-container col-4">
                                        <?php theme()->templateTags()->printMainMenu() ?>
                                    </div>
                                    <div class="products-container col-8">
                                        <?php theme()->templateTags()->printProductMainMenu() ?>
                                        <?php theme()->templateTags()->printCompetenceMainMenu() ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </header>