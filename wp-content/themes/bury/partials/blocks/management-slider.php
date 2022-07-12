<div id="carousel-with-lb" class="br-block carousel slide carousel-multi-item" data-ride="carousel">
    <div class="carousel-inner mdb-lightbox" role="listbox">
        <div id="mdb-lightbox-ui"></div>
        <?php foreach ($items->posts as $k => $member) : ?>
            <?php $slides = 4; ?>
                <div class="carousel-item text-center <?= $k == 0 ? 'active' : '' ?>">
                    <?php $thumbUrl = get_the_post_thumbnail_url($member, 'post-thumbnail') ?>
                    <?php if (!empty($thumbUrl)) : ?>
                        <figure class="col-md-4 d-md-inline-block">
                            <img src="<?= $thumbUrl ?>"
                                class="img-fluid">

                                <span class="member-name"><?= $member->post_title ?></span>
                                <?php foreach ($member->positions as $position) { ?>
                                    <span class="member-position"><?= $position->name ?></span>
                                <?php } ?>
                        </figure>
                    <?php endif; ?>
                </div>
        <?php endforeach; ?>

        <a class="carousel-control-prev" href="#carousel-with-lb" role="button" data-slide="prev">
            <span class="btn-floating btn-secondary" aria-hidden="true"><</span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel-with-lb" role="button" data-slide="next">
            <span class="btn-floating btn-secondary" aria-hidden="true">></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>