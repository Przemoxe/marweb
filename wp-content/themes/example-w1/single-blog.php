<?php
get_header();
?>

<nav class="single-blog-nav">
    <div class="main-container-px20">
        <nav class="single-blog-nav">
            <div class="container-title">
                <h5>
                    Blog post
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

<section class="single-blog-section">
    <div class="main-container-px20">
        <div class="blog-header">
            <h1>
                What are the big reasons for marketing your business
            </h1>
        </div>
        <div class="blog-thumbnail">
            <img src="<?= get_template_directory_uri() . '/assets/src/front/images/asdas.jpg' ?>" alt="">
        </div>
        <div class="blog-content-container">
            <div class="blog-content">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum labore molestiae voluptatibus officia quae aliquid aperiam nulla suscipit, eveniet distinctio. Officiis quis impedit quo nobis dolores architecto quos perferendis! Aliquam?
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum labore molestiae voluptatibus officia quae aliquid aperiam nulla suscipit, eveniet distinctio. Officiis quis impedit quo nobis dolores architecto quos perferendis! Aliquam?
                <br><br>

                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum labore molestiae voluptatibus officia quae aliquid aperiam nulla suscipit, eveniet distinctio. Officiis quis impedit quo nobis dolores architecto quos perferendis! Aliquam?
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum labore molestiae voluptatibus officia quae aliquid aperiam nulla suscipit, eveniet distinctio. Officiis quis impedit quo nobis dolores architecto quos perferendis! Aliquam?
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum labore molestiae voluptatibus officia quae aliquid aperiam nulla suscipit, eveniet distinctio. Officiis quis impedit quo nobis dolores architecto quos perferendis! Aliquam?
                <br>
                <br>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum labore molestiae voluptatibus officia quae aliquid aperiam nulla suscipit, eveniet distinctio. Officiis quis impedit quo nobis dolores architecto quos perferendis! Aliquam?
                <br>
                <br>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum labore molestiae voluptatibus officia quae aliquid aperiam nulla suscipit, eveniet distinctio. Officiis quis impedit quo nobis dolores architecto quos perferendis! Aliquam?
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum labore molestiae voluptatibus officia quae aliquid aperiam nulla suscipit, eveniet distinctio. Officiis quis impedit quo nobis dolores architecto quos perferendis! Aliquam?
            </div>
        </div>
    </div>
</section>


<section class="random-blogs">
    <div class="main-container-px20">
        <div class="similar-title">
            <h6 class="title">
                Similar posts
            </h6>
        </div>
    </div>
    <div class="main-container">
        <div class="container-portfolio-projects">
            <div class="portfolio-project">
                <div class="single-project">
                    <a href="index-header-carousel.html" class="card">
                        <div class="card-img-top">
                            <img src="<?= get_template_directory_uri() . '/assets/src/front/images/42.jpg' ?>" class="img-fluid">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">
                                Carousel header
                            </h4>
                            <p class="card-text">
                                Switch between multiple slides with full cover background images.
                            </p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="portfolio-project">
                <div class="single-project">
                    <a href="index-header-carousel.html" class="card">
                        <div class="card-img-top">
                            <img src="<?= get_template_directory_uri() . '/assets/src/front/images/42.jpg' ?>" class="img-fluid">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">
                                Carousel header
                            </h4>
                            <p class="card-text">
                                Switch between multiple slides with full cover background images.
                            </p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="portfolio-project">
                <div class="single-project">
                    <a href="index-header-carousel.html" class="card">
                        <div class="card-img-top">
                            <img src="<?= get_template_directory_uri() . '/assets/src/front/images/42.jpg' ?>" class="img-fluid">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">
                                Carousel header
                            </h4>
                            <p class="card-text">
                                Switch between multiple slides with full cover background images.
                            </p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
?>