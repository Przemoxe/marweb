<?php
$query = htmlentities(input_get('s'));

$postSearchQuery = theme()->search()->standardSearch($query, input_get('standardPaged'), ['page']);
$pageSearchQuery = theme()->search()->standardSearch($query, input_get('standardPaged'), ['post']);

get_header();

?>

<main>

    <div class="container search-content">
        <h1 class="search-content__title"><?= __('Wyszukiwanie dla: ', TEXT_DOMAIN) ?><?= $query ?></h1>
        <?php partial('search/default', ['searchQuery' => $postSearchQuery, 'query' => $query]) ?>
        <?php partial('search/default', ['searchQuery' => $pageSearchQuery, 'query' => $query]) ?>
    </div>

</main>

<?php get_footer(); ?>
