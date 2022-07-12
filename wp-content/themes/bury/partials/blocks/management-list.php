<div class="br-block management-list">
    <div class="ae-container management-list">
        <div class="container">
            <div class="row">
                <div class="col-5 management-list__left">
                        <div class="management-description">
                            <div class="content">
                                <h2 class="box-title"><?= $title ?></h2>
                                <div class="box-description"><?= $description ?></div>
                                <nav class="navbar">
                                    <div class="ae-select">
                                        <span class="ae-select-content"></span>
                                        <div class="arrow"></div>
                                    </div>
                                    <ul class="nav innovation-flex-column ae-hide" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <?php foreach ($items as $k => $position): ?>
                                        <li class="innovation-li">
                                            <?php if($position->name): ?>
                                                <a class="nav-link <?= $k == 0 ? 'active selected' : '' ?>" id="position<?= $position->term_id ?>-<?= $k ?>" data-toggle="pill" href="#position-<?= $position->term_id ?>-<?= $k ?>" role="tab" aria-controls="position-<?= $position->term_id ?>-<?= $k ?>" aria-selected="true">
                                                    <?=  $position->name ?>
                                                </a>
                                            <?php endif; ?>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                </div>
                
                        <div class="col-md-7 management-members">
                                <div class="tab-content" id="v-pills-tabContent" equal-height>
                                    <?php foreach ($items as $k => $position): ?>
                                            <div class="tab-pane fade show <?= $k == 0 ? 'active' : '' ?>" id="position-<?= $position->term_id ?>-<?= $k ?>" role="tabpanel" aria-labelledby="position-<?= $position->term_id ?>-<?= $k ?>" equal-height-watch>
                                                <div class="row">
                                                    <?php foreach ($position->menagement as $count => $menager): ?>
                                                        <?php if($count < 4 ) :  ?>
                                                            <?php if($count > 0 & !($count % 2)) : ?><div class="w-100"></div><?php endif; ?> 
                                                            <?php $thumb = get_the_post_thumbnail($menager, 'post-thumbnail', ['class' => 'img-fluid']) ?>
                                                            <?php if (!empty($thumb)) : ?>
                                                                <div class="photo col-6">
                                                                    <div class="shadow"></div>
                                                                    <?= $thumb ?>
                                                                    <div class="employees__employee__description content text-center">
                                                                        <div class="employees__employee__description__name"><?= $menager->post_title ?></div>
                                                                        <?php foreach($menager->positions as $position): ?>
                                                                            <?php if(get_field('kraj', $position)): continue; endif; ?>
                                                                            <div class="employees__employee__description__position">
                                                                                <?= $position->name ?>
                                                                            </div>
                                                                            <div class="employees__employee__description">
                                                                                <?= $menager->post_excerpt ?>
                                                                            </div>
                                                                        <?php endforeach; ?>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                    <?php endforeach; ?> 
                                </div>
                        </div>

            </div>
        </div>
    </div>
</div>