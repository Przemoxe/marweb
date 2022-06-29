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
$bannerSecondButtonText = get_field('second_button_text');
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

<section class="banner-section">
    <div class="bg-image" style="background-image: url('<?= $bannerImg ?>)">
    </div>
    <div class="bg-overlay"></div>
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
                <a href="#!" class="btn-check">
                    <?= $bannerFirstButtonText ?>
                </a>
                <a href="#about" class="btn-read-more">
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
            <img src="<?= $serviceImage ?>" alt="">
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
                        <h6><?= $el['title'] ?></h6>
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
                        <a href="index-header-carousel.html" class="card">
                            <div class="card-img-top">
                                <img src="<?= get_the_post_thumbnail_url($el->ID) ?>" alt="">
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <?= $el->post_title ?>
                                </h4>
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
                <figure> <img src="<?= get_template_directory_uri() . '/assets/src/front/images/1093wordpress-1.jpg' ?>"></figure>
                <figure> <img src="<?= get_template_directory_uri() . '/assets/src/front/images/Laravel-9.jpg' ?>"></figure>
                <figure> <img src="<?= get_template_directory_uri() . '/assets/src/front/images/php-leader-1024x524.png' ?>"></figure>
                <figure> <img src="<?= get_template_directory_uri() . '/assets/src/front/images/sta-je-html.jpg' ?>"></figure>
                <figure> <img src="<?= get_template_directory_uri() . '/assets/src/front/images/useful-sass-scss-mixins-for-every-website.jpg' ?>"></figure>
                <figure> <img src="<?= get_template_directory_uri() . '/assets/src/front/images/z74oqos1984w5g5ah0i9.webp' ?>"></figure>
                <figure> <img src="<?= get_template_directory_uri() . '/assets/src/front/images/42.jpg' ?>"></figure>
                <figure> <img src="<?= get_template_directory_uri() . '/assets/src/front/images/asdas.jpg' ?>"></figure>
                <figure> <img src="<?= get_template_directory_uri() . '/assets/src/front/images/Responsive-Web-Design.png' ?>"></figure>
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
                        <a href="<?= get_permalink() ?>" class="card">
                            <div class="card-img-top">
                                <img src="<?= get_the_post_thumbnail_url($el->ID) ?>" alt="">
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <?= $el->post_title ?>
                                </h4>
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