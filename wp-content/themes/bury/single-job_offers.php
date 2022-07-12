<?php
get_header();
global $wp_query;
while ( have_posts() ) : the_post();

theme()->jobOfferModel()->injectField($post);
$archiveLink = get_post_type_archive_link('job_offers');
?>

<main class="job-offer-container">
<div class="container"><?php theme()->templateTags()->breadrumbs(); ?></div>
<?php theme()->templateTags()->printCareerMenu('category', false); ?>
<div class="container job-offer">
        <div class="column">
            <div class="row">
                <div class="col-12">
                    <h1 class="single-title"><?= $post->post_title ?></h1>
                </div>
            </div>

            <div class="row">
                <div class="single-content col-12">
                    <?php foreach ($post->items as $item): ?>
                    <div class="paragraph">
                        <h3><?= $item->title; ?></h3>
                        <?= $item->description; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="row">
                <div class="single-content col-12">
                    <small><?= $post->description ?></small>
                    <div class="d-flex justify-content-center"><?= the_page_link($post->application_link, ['class' => 'button-inverted']) ?></div>
                </div>
            </div>

        </div>
        <?php if (!empty($archiveLink)): ?>
        <div class="column">
            <a href="<?= $archiveLink ?>" class="button-primary" title="<?= __('Wróć do listy Artykułów', TEXT_DOMAIN) ?>"><?= __('Wróć do listy wpisów', TEXT_DOMAIN) ?></a>
        </div>
        <?php endif; ?>
    </div>
</main>
<?php
endwhile;
get_footer();
?>
