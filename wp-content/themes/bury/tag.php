<?php
    get_header();
?>

<div class="row column">
    <nav role="navigation">
        <?php
            partial('breadcrumbs', [
                'steps' => [
                    ['title' => single_tag_title("", false)],
                ]
            ]);
        ?>
    </nav>
</div>

<?php partial('vue-apps/post-list') ?>

<?php
    get_footer();
?>