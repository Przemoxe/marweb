<?php
    $block = theme()->config()->options();
    get_header();

    while ( have_posts() ) : the_post();
?>

<main>
<?php the_content(); ?> 
    <?php
        // $b = get_object_taxonomies( array( 'post_type' => 'products' ) ); 

        // $a = get_field('show_underline');
        // var_dump($a);

    ?>
</main>

<?php
endwhile;
get_footer();
?>
