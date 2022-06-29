<?php
get_header();
?>

<nav class="single-blog-nav">
    <div class="main-container-px20">
        <nav class="single-blog-nav">
            <div class="container-title">
                <h5>
                    404
                </h5>
            </div>
            <div class="container-links">
                <span class="breadcrumb-item">
                    <a href="<?= get_home_url() ?>">Home</a>
                </span>
                <span class="breadcrumb-item active">
                    <i class="arrow right"></i>
                    404
                </span>
            </div>
        </nav>
    </div>
</nav>

<section class="template-404-section">
    <div class="main-container-px20">
        <div class="template-404-container">
            <div class="left-navbar">
                <h6 class="title">
                    404 ERROR PAGE
                </h6>
            </div>
            <div class="content-404">
                <h3>
                    <?= __('Strona', 'marweb') ?> <span><?= __('nie', 'marweb') ?> </span><?= __('odnaleziona', 'marweb') ?> 
                </h3>
                <p>
                   <?= __('Nie udało się odnaleźć strony www', 'marweb') ?>
                </p>
                <div class="first-button">
                    <a type="submit" class="btn-send" href="<?= get_home_url()?>">
                        <?= __('Stronga główna', 'marweb') ?><i class="arrow right"></i>
                    </a>
                </div>
            </div>
            <div class="content-404-image">
            <img src="<?= get_template_directory_uri() . '/assets/src/front/images/404.svg' ?>">
            </div>
        </div>
    </div>
</section>




<?php
get_footer();
?>
