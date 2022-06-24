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
                    FAQ
                </h5>
            </div>
            <div class="container-links">
                <span class="breadcrumb-item">
                    <a href="<?= get_home_url() ?>">Home</a>
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
                    ADDITIONAL RESOURCES
                </h6>
            </div>
            <div class="faq-content">
                <h3>
                    Still confused?
                </h3>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit, explicabo nam fugit aspernatur quaerat est id sequi, molestias dolore laboriosam perferendis officiis provident asperiores. Eveniet vitae cumque at ab dolorem!
                </p>
                <div class="more-info-container">
                    <div class="contact-support">
                        <div class="card-body">
                            <div class="card-icon">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </div>
                            <h5>
                                Contact support
                            </h5>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit deserunt vero pariatur.
                            </p>
                        </div>
                        <a href="">
                        </a>
                    </div>
                    <div class="contact-support">
                        <div class="card-body">
                            <div class="card-icon">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </div>
                            <h5>
                                Ask a question
                            </h5>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit deserunt vero pariatur.
                            </p>
                        </div>
                        <a href="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


</section>



<?php
get_footer();
?>