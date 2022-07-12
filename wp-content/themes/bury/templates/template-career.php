<?php
/**
* Template Name: Kariera
*/

get_header();

while ( have_posts() ) : the_post();
?>

<main class="page-career-content">
    <div class="container"><?php theme()->templateTags()->breadrumbs(); ?></div>
    <?php the_content(); ?> 
</main>

<?php
endwhile;
get_footer();
?>
