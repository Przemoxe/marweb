<?php

get_header();

$category = get_queried_object();
theme()->productModel()->injectCategoryField($category);
$currentTermId = $category->term_id;
$categories = theme()->productModel()->getAllCategories(null, false, ['hide_empty' => true, 'parent' => $category->term_id, 'only_shown_menu' => true]);
$products = theme()->productModel()->getAllPublished(['category_without_children' => [$category->term_id]])->posts;
?>

<main>

    <?php theme()->templateTags()->printProductMenu(); ?>

    <?php if (empty($categories)): ?>
        <?php partial('product/archive/post', compact('category')); ?>
    <?php else: ?>
        <?php partial('product/archive/category', compact('categories', 'products')); ?>
    <?php endif; ?>

</main>

<?php

get_footer();

?>
