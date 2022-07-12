<?php

//If this page is main and have childrens, then redirect to first child
theme()->templateTags()->redirect_parent_0_to_first_children($post);

get_header();

while ( have_posts() ) : the_post();

$mainClass = '';
?>

<main <?= $mainClass ?>>
    <?php
        if(!theme()->templateTags()->printHeaderMenu('page'))
            theme()->templateTags()->printChildrensMenu($post);
    ?>
    <div class="page-content">
        <?php the_content(); ?>
    </div>
</main>

<?php
endwhile;
get_footer();
?>
