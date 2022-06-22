<?php
/* Template Name: O Nas*/
?>

<?php
get_header();
?>

<nav class="single-blog-nav">
    <div class="main-container-px20">
        <nav class="single-blog-nav">
            <div class="container-title">
                <h5>
                    O Nas
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

<section class="template-about-us-section">
    <div class="main-container-px20">
        <div class="about-us-image">
            <img src="<?= get_template_directory_uri() . '/assets/src/front/images/asdas.jpg' ?>" alt="">
        </div>
        <div class="template-about-us-container">
            <div class="left-navbar">
                <h6 class="title">
                    TWO WORDS ABOUT OUR COMPANY
                </h6>
            </div>
            <div class="about-us-content">
                <h3>
                    Need help? Browse our <span>FAQs</span>
                </h3>
                <p>
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolores tempore omnis non nemo distinctio, perspiciatis ut reprehenderit tenetur eveniet, et doloribus ipsa eligendi incidunt voluptas? Incidunt perferendis reiciendis velit optio corporis, delectus commodi nam ad distinctio, omnis fuga obcaecati consequatur numquam reprehenderit amet necessitatibus eum aspernatur sequi. Accusantium, quo cum.
                </p>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
?>