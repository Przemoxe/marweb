<div class="br-block innovation">

    <div class="col-6 innovation__background-left"></div>
    <div class="col-6 innovation__background-right"></div>

    <div class="container innovation ae-container">

        <div class="row">

            <div class="col-md-5 d-flex justify-content-end management-description">
                <nav class="content-navbar">
                    <div class="content">
                        <h2 class="box-title"><?= $title ?></h2>
                        <date_interval_create_from_date_string class="box-description"><?= $description ?></date_interval_create_from_date_string>
                    </div>
                    <nav class="navbar">
                        <div class="ae-select">
                            <div class="ae-select-container"><span class="ae-select-content"></span></div>
                            <div class="arrow"></div>
                        </div>
                        <ul class="nav innovation-flex-column ae-hide" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <?php foreach ($items as $k => $item): ?>
                            <li class="innovation-li">
                                <?php if(array_get($item, 'title_alt')): ?>
                                    <a class="nav-link <?= $k == 0 ? 'active selected' : '' ?>" id="innovations-<?= $uniqueId ?>-<?= $k ?>" data-toggle="pill" href="#tab-<?= $uniqueId ?>-<?= $k ?>" role="tab" aria-controls="tab-<?= $uniqueId ?>-<?= $k ?>" aria-selected="true">
                                        <?= array_get($item, 'title_alt') ?>
                                    </a>
                                <?php endif; ?>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </nav>
                </nav>
            </div>

            <div class="col-md-4 management-members">
                <div class="tab-content" id="v-pills-tabContent" equal-height>
                    <?php foreach ($items as $k => $item): ?>
                        <?php if(array_get($item, 'title_alt')): ?>
                            <div class="tab-pane fade show <?= $k == 0 ? 'active' : '' ?>" id="tab-<?= $uniqueId ?>-<?= $k ?>" equal-height-watch role="tabpanel" aria-labelledby="innovations-<?= $uniqueId ?>-<?= $k ?>">
                                <h3 class="innovation-title"><?= array_get($item, 'title') ?></h3>
                                <?php if(!empty(array_get($item, 'image'))): ?>
                                    <img class="innovation-item-image img-fluid" alt="innovation-image" src="<?= wp_get_attachment_url(array_get($item, 'image')) ?>">
                                <?php endif; ?>
                                <div class="innovation-body"><?= array_get($item, 'content') ?>
                                    <div class="text-right">
                                        <?php $button = array_get($item, 'link'); ?>
                                        <?php if ($button) : ?>
                                            <a class="button" <?php if($button['url']) : ?> href="<?= $button['url'] ?>" <?php else: ?> href="#" <?php endif; ?>><?= $button['title'] ?></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </div>
</div>
