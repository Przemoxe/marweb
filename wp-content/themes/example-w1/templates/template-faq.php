<?php
/* Template Name: FAQ */
?>

<?php
get_header();
?>

<?php

$accordionNavbarTitle = get_field('accordion_navbar_title');
$accordionTitle = get_field('accordion_title');
$accordionTitleColored = get_field('accordion_title_colored');
$accordionDescription = get_field('accordion_description');
$accordionAccordions = get_field('accordion_accordions');

$infoNavbarTitle = get_field('info_navbar_title');
$infoTitle = get_field('info_title');
$infoDescription = get_field('info_description');
$infoButtons = get_field('info_buttons');



?>

<nav class="single-blog-nav">
    <div class="main-container-px20">
        <nav class="single-blog-nav">
            <div class="container-title">
                <h5>
                <?= get_the_title() ?>
                </h5>
            </div>
            <div class="container-links">
                <span class="breadcrumb-item">
                    <a href="<?= get_home_url() ?>"><?= get_the_title( get_option('page_on_front') ); ?></a>
                </span>
                <span class="breadcrumb-item active">
                    <i class="arrow right"></i>
                    <?= get_the_title() ?>
                </span>
            </div>
        </nav>
    </div>
</nav>

<section class="template-faq-section">
    <div class="main-container-px20">
        <div class="template-faq-container">
            <div class="left-navbar">
                <h6 class="title">
                    <?= $accordionNavbarTitle ?>
                </h6>
            </div>
            <div class="faq-content">
                <h3>
                    <?= $accordionTitle ?> <span><?= $accordionTitleColored ?></span>
                </h3>
                <p>
                    <?= $accordionDescription ?>
                </p>

                <div class="accordions-wrapper">
                    <?php

                    foreach ($accordionAccordions as $el) { ?>

                        <div class="accordion">
                            <div class="accordion-header">
                                <div class="accordion-plus"></div>
                                <h4><?= $el['title'] ?></h4>
                            </div>

                            <div class="accordion-body">
                                <p>
                                    <?= $el['description'] ?>
                                </p>
                            </div>
                        </div>

                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>
        <div class="template-faq-container">
            <div class="left-navbar">
                <h6 class="title">
                    <?= $infoNavbarTitle ?>
                </h6>
            </div>
            <div class="faq-content">
                <h3>
                    <?= $infoTitle ?>
                </h3>
                <p>
                    <?= $infoDescription ?>
                </p>
                <div class="more-info-container">

                    <?php

                    foreach ($infoButtons as $el) { ?>

                        <div class="contact-support">
                            <div class="card-body">
                                <div class="card-icon">
                                    <i class="fa <?= $el['icon'] ?>" aria-hidden="true"></i>
                                </div>
                                <h5>
                                    <?= $el['title'] ?>
                                </h5>
                                <p>
                                    <?= $el['description'] ?>
                                </p>
                            </div>
                            <a href="<?=$el['url']?>">
                            </a>
                        </div>

                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>


</section>



<?php
get_footer();
?>