<?php
/* Template Name: Stronga główna*/
?>

<?php
get_header();
?>
<?php
//backend data

$bannerImg = get_field("image")["sizes"]["2048x2048"];
$bannerPreheading = get_field('preheading');
$bannerHeading = get_field('heading');
$bannerSubheading = get_field('subheading');
$bannerFirstButtonText = get_field('first_button_text');
$bannerFirstButtonUrl = get_field('first_button_url');
$bannerSecondButtonText = get_field('second_button_text');
$bannerSecondButtonUrl = get_field('second_button_url');
$bannerFormTitle = get_field('form_title');
$bannerFormShortCode = get_field('form_shortcode');
$bannerFormTelNumber = get_field('form_tel_number');

$serviceSectionTitle = get_field('service_section_title');
$serviceSectionDescription = get_field('service_section_description');
$serviceImage = get_field('service_image')["sizes"]["2048x2048"];
$servicesCards = get_field('services');

$portfolioTitle = get_field('portfolio_title');
$portfolioSectionDescription = get_field('portfolio_section_description');
$portfolioSectionWorks = get_field('portfolio_section_works');
$portfolioSectionQuote = get_field('portfolio_section_quote');

$technologiesSectionTitle = get_field('techonologies_section_title');
$technologiesSectionDescription = get_field('technologies_section_description');

$blogTitle = get_field('blog_title');
$blogSectionDescription = get_field('blog_section_description');
$blogSectionPosts = get_field('blog_section_posts');

?>

<section class="intro-section">
    <div class="bg-overlay"></div>
    <div class="bg-img">
        <img src="<?= $bannerImg ?>" alt="Zdjęcie bannera">
    </div>
    <div class="main-container-px20">
        <div class="banner-container">
            <p class="preheading">
                <?= $bannerPreheading ?>
            </p>
            <h1 class="heading">
                <?= $bannerHeading ?>
            </h1>
            <p class="subheading">
                <?= $bannerSubheading ?>
            </p>
            <div class="buttons">
                <a href="<?= $bannerFirstButtonUrl ?>" class="btn-check" aria-label="check">
                    <?= $bannerFirstButtonText ?>
                </a>
                <a href="<?= $bannerSecondButtonUrl ?>" class="btn-read-more" aria-label="read more">
                    <?= $bannerSecondButtonText ?>
                </a>
            </div>
        </div>
                <div class="ask-us-container">
            <div class="form">
                <?= apply_shortcodes($bannerFormShortCode); ?>
            </div>

        </div>
    </div>
</section>

<section class="services-section">
    <div class="main-container-px20">
        <div class="services-description">
            <h1><?= $serviceSectionTitle ?></h1>
            <p><?= __($serviceSectionDescription, 'marweb') ?></p>
        </div>
        <div class="services-image" id="services">
            <img src="<?= $serviceImage ?>" alt="service image">
        </div>
    </div>
    <div class="main-container">
        <?php
        foreach ($servicesCards as $el) { ?>
            <div class="icon-box-container">
                <div class="icon-box">
                    <div class="icon-box-icon">
                        <i class="fa <?= $el['icon'] ?> fa-2x" aria-hidden="true"></i>
                    </div>
                    <div class="icon-box-title">
                        <h2><?= $el['title'] ?></h3>
                    </div>
                    <div class="icon-box-content">
                        <p><?= $el['description'] ?></p>
                    </div>
                </div>
            </div>
        <?php }
        ?>

    </div>
</section>

<section class="portfolio-section">
    <div class="main-container-px20">
        <div class="services-description">
            <h1><?= $portfolioTitle ?></h1>
            <p><?= $portfolioSectionDescription ?></p>
        </div>
    </div>
    <div class="main-container">
        <div class="container-portfolio-projects">
            <?php

            foreach ($portfolioSectionWorks as $el) {
            ?>
                <div class="portfolio-project">
                    <div class="single-project">
                        <a href="<?= get_field('portfolio_single_url', $el->ID)?>" class="card" target="_blank" aria-label="portfolio link">
                            <div class="card-img-top">
                                <img src="<?= get_the_post_thumbnail_url($el->ID) ?>" alt="portfolio img">
                            </div>
                            <div class="card-body">
                                <h2 class="card-title">
                                    <?= $el->post_title ?>
                                    
                                </h2>
                                <p class="card-text">
                                    <?= get_the_excerpt($el->ID) ?>
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            <?php
            }
            ?>

        </div>
    </div>
    <div class="main-container-px20">
        <div class="quote">
            <i class="fa fa-quote-left" aria-hidden="true"></i>
            <p class="quote-blockquote-content">
                <?= $portfolioSectionQuote ?>
            </p>
        </div>
    </div>
</section>

<section class="section-our-techonologies">
    <div class="main-container-px20">
        <h2>
            <?= $technologiesSectionTitle ?>
        </h2>
        <p>
            <?= $technologiesSectionDescription ?>
        </p>
        <div class="container">
            <div id="carousel">
                <figure> <img src="<?= get_template_directory_uri() . '/assets/src/front/images/webp/sass.webp' ?>" alt="sass"></figure>
                <figure> <img src="<?= get_template_directory_uri() . '/assets/src/front/images/webp/vuejs.webp' ?>" alt="vue"></figure>
                <figure> <img src="<?= get_template_directory_uri() . '/assets/src/front/images/webp/jquery-js.webp' ?>" alt="jquery"></figure>
                <figure> <img src="<?= get_template_directory_uri() . '/assets/src/front/images/webp/Laravel-9.webp' ?>" alt="laravel"></figure>
                <figure> <img src="<?= get_template_directory_uri() . '/assets/src/front/images/webp/php.webp' ?>" alt="php"></figure>
                <figure> <img src="<?= get_template_directory_uri() . '/assets/src/front/images/webp/mysq.webp' ?>" alt="mysql"></figure>
                <figure> <img src="<?= get_template_directory_uri() . '/assets/src/front/images/webp/google-analytic.webp' ?>" alt="google analytics"></figure>
                <figure> <img src="<?= get_template_directory_uri() . '/assets/src/front/images/webp/woocommerce.webp' ?>" alt="woocommerce"></figure>
                <figure> <img src="<?= get_template_directory_uri() . '/assets/src/front/images/webp/wordpress.webp' ?>" alt="wordpress"></figure>
            </div>
        </div>
    </div>
</section>

<section class="portfolio-section">
    <div class="main-container-px20">
        <div class="services-description">
            <h1><?= $blogTitle ?></h1>
            <p><?= $blogSectionDescription ?></p>
        </div>
    </div>
    <div class="main-container">
        <div class="container-portfolio-projects">
            <?php

            foreach ($blogSectionPosts as $el) {
            ?>
                <div class="portfolio-project">
                    <div class="single-project">
                        <a href="<?= get_permalink($el->ID) ?>" class="card" aria-label="link blog">
                            <div class="card-img-top">
                                <img src="<?= get_the_post_thumbnail_url($el->ID) ?>" alt="blog image">
                            </div>
                            <div class="card-body">
                                <h2 class="card-title">
                                    <?= $el->post_title ?>
                                </h2>
                                <p class="card-text">

                                    <?= get_the_excerpt($el->ID) ?>
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>

<?php
get_footer();
?>