<?php
$postType = get_query_post_type($searchQuery);
$postTypeObject = get_post_type_object($postType);
?>
<div class="search-type search-type-<?= $postType ?>">

    <div class="row">
        <h2><?= $postTypeObject->labels->name ?></h2>
    </div>

    <?php if ( $searchQuery !== null && $searchQuery->have_posts()  && $query !== '' ) : ?>

    <div class="row">
        <ul class="col-12 search-content__list">
            <?php while ( $searchQuery->have_posts() ) : $searchQuery->the_post(); ?>

                <li class="search-content__list__item">
                    <a href="<?= get_permalink(); ?>">
                        <h2 class="search-content__list__item__title"><?php the_title(); ?></h2>
                        <p class="search-content__list__item__link"><?= get_permalink(); ?></p>
                        <p class="search-content__list__item__description"><?= strip_shortcodes(get_the_excerpt()); ?></p>
                    </a>
                </li>

            <?php endwhile; ?>
        </ul>              
    </div>

    <div class="pagination-row">
        <div class="col-md-12 pagination justify-content-center">
            <?= theme()->templateTags()->searchPagination($searchQuery, 'standardPaged'); ?>
        </div>
    </div>

    <?php wp_reset_postdata(); ?>

    <?php endif; ?>


    <?php if ( ($searchQuery !== null) && ($query !== '') ) : ?>
        <?php if ( !$searchQuery->have_posts() ) : ?>
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-center search-content__no-results">
                        <?= __('Brak wyników', TEXT_DOMAIN) ?>
                    </h2>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>

</div>