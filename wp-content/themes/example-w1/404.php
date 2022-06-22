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
                    Page <span>not</span> found
                </h3>
                <p>
                   Lorem ipsum, dolor sit amet consectetur adipisicing elit. Excepturi voluptatibus, natus labore ratione numquam expedita nostrum voluptate ipsum iste esse in aliquid, ipsam fugit? In.
                </p>
                <div class="first-button">
                    <button type="submit" class="btn-send">
                        HomePage<i class="arrow right"></i>
                    </button>
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
<?php
get_footer();
?>