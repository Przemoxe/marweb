<?php
/* Template Name: O Nas*/
?>

<?php
get_header();
?>

<?php

$bannerImage = get_field('image')["sizes"]["2048x2048"];
$navbarTitle = get_field('navbar_title');
$title = get_field('title');
$titleColored = get_field('title_colored');
$description = get_field('description');

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

<section class="template-about-us-section">
    <div class="main-container-px20">
        <div class="about-us-image">
            <img src="<?= $bannerImage ?>" alt="">
        </div>
        <div class="template-about-us-container">
            <div class="left-navbar">
                <h6 class="title">
                    <?= $navbarTitle ?>
                </h6>
            </div>
            <div class="about-us-content">
                <h3>
                <?= $title ?> <span><?= $titleColored ?></span>
                </h3>
                <p>
                <?= $description ?>
                </p>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
?>