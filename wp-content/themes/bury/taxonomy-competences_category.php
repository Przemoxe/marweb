<?php

get_header();

$category = get_queried_object();
theme()->competenceModel()->injectCategoryField($category);
$currentTermId = $category->term_id;
$categories = theme()->competenceModel()->getAllCategories(null, false, ['hide_empty' => true, 'parent' => $category->term_id, 'only_shown_menu' => true]);
$competences = theme()->competenceModel()->getAllPublished(['category_without_children' => [$category->term_id]])->posts;
?>

<main>

    <?php theme()->templateTags()->printCompetenceMenu(); ?>

    <?php if (empty($categories)): ?>
        <?php partial('competence/archive/post', compact('category')); ?>
    <?php else: ?>
        <?php partial('competence/archive/category', compact('categories', 'competences')); ?>
    <?php endif; ?>

</main>

<?php

get_footer();

?>
