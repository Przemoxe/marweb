<?php
/* Template Name: Kontakt */
?>

<?php
get_header();
?>

<?php

$dataNavbarTitle = get_field('data_navbar_title');
$dataTitle = get_field('data_title');
$dataTitleColored = get_field('data_title_colored');
$dataTitleAfterColored = get_field('data_title_after_colored');
$dataDescription = get_field('data_description');
$dataInfoCards = get_field('data_info_cards');

$formNavbarTitle = get_field('form_navbar_title');
$formTitle = get_field('form_title');
$formTitleColored = get_field('form_title_colored');
$formDescription = get_field('form_description');
$bannerFormShortCode = get_field('form_shortcode');

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

<section class="template-contact-section">
    <div class="main-container-px20">
        <div class="template-contact-container">
            <div class="left-navbar">
                <h6 class="title">
                    <?= $dataNavbarTitle ?>
                </h6>
            </div>
            <div class="contact-content">
                <h3>
                    <?= $dataTitle ?> <span><?= $dataTitleColored ?></span><?= $dataTitleAfterColored ?>
                </h3>
                <p>
                    <?= $dataDescription ?>
                </p>
                <div class="content-data">
                    <?php

                    foreach ($dataInfoCards as $el) {
                    ?>
                        <div class="single-data">
                            <h5>
                                <?= $el['info_title'] ?>
                            </h5>
                            <p>
                                <?= $el['data'] ?>
                            </p>
                        </div>
                    <?php
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>


</section>

<section class="template-contact-form-section">
    <div class="main-container-px20">
        <div class="template-contact-container">
            <div class="left-navbar">
                <h6 class="title">
                    <?= $formNavbarTitle ?>
                </h6>
            </div>
            <div class="ask-us-container">
                <div class="contact-content">
                    <h3>
                        <?= $formTitle ?> <span><?= $formTitleColored ?></span>
                    </h3>
                    <p>
                        <?= $formDescription ?>
                    </p>
                </div>
                <div class="form">
                <?= apply_shortcodes($bannerFormShortCode); ?>
                </div>
            </div>
        </div>
    </div>

</section>



<?php
get_footer();
?>