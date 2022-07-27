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
                    <a href="<?= get_home_url() ?>"><?= get_the_title( get_option('page_on_front') ); ?></a>
                </span>
                <span class="breadcrumb-item active">
                    <i class="arrow right"></i>
                    <?php 
                    
             
                    foreach(get_the_category() as $el){
                       ?>
                       <a href="/wiedza">Wiedza</a>
                       <i class="arrow right"></i>
                       <a href="<?=get_category_link($el)?>"><?=$el->name?></a>
                       <i class="arrow right"></i>
                       <?php
                    }
                    ?>
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
                <?= get_the_title() ?>
                
            </h1>
        </div>
        <div class="blog-thumbnail">
            <img src="<?= get_the_post_thumbnail_url() ?>" alt="">
        </div>
        <div class="blog-content-container">
            <div class="blog-content">
                <?= get_the_content() ?>
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
            <?php
            $blog = new WP_Query(array(
                'posts_per_page' => 3,
                'post_type' => 'post',
            ));
            while ($blog->have_posts()) {
                $blog->the_post(); ?>
                <div class="portfolio-project">
                    <div class="single-project">
                        <a href="<?= get_permalink() ?>" class="card">
                            <div class="card-img-top">
                                <img src="<?= get_the_post_thumbnail_url() ?>" alt="">
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <?= get_the_title() ?>
                                </h4>
                                <p class="card-text">
                                    <?= get_the_excerpt() ?>
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            <?php }
            wp_reset_postdata();
            ?>
        </div>
    </div>
</section>

<?php
get_footer();
?>