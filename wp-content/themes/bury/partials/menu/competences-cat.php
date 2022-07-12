<div class="row header-menu">
    <div class="col-md-5 header-menu__background-left"></div>

    <div class="container">
    <div class="row">
        <div class="col-md-5 header-menu-nav">
            <div class="content" drop-down-container>
                <h1><?= __('Kompetencje', TEXT_DOMAIN) ?></h1>
                <?php if (!empty($parentCategory)): ?>
                    <h2 class="parent-category">
                        <a class="link" href="<?= get_category_link($parentCategory) ?>"><?= $parentCategory->name ?></a>
                    </h2>
                <?php endif; ?>
                <div class="nav ae-select title-select">
                    <?php foreach ($categories as $item): ?>
                        <?php  if($currentTermId == $item->term_id) $name = $item->name; 
                        ?>
                    <?php endforeach; ?>
                    <div class="ae-select-container"><span class="ae-select-content"><a class="title-link" href="<?= get_category_link($currentTermId) ?>"><?= $name ?></a></span></div>
                    <?php if(count($categories) > 1) : ?>
                        <div class="ae-select-arrow"></div>
                    <?php endif; ?>
                </div>
                    <ul class="nav <?php if(count($categories) > 1) : ?> flex-column <?php endif;?> ae-hide">
                    <?php $countCategories = count($categories) ?>
                        <?php if($countCategories < 8) : ?>
                            <?php foreach ($categories as $item): ?>
                                <?php $thisPage = $currentTermId == $item->term_id; ?>
                                <li class="nav-item <?= $thisPage ? 'active' : '' ?>">
                                    <a class="nav-link <?= $thisPage ? 'active' : '' ?>" href="<?= get_category_link($item) ?>">
                                        <?= $item->name ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <li class="row">
                                <ul class="col-6 mobile">
                                    <?php for($index = 0; $index <  ceil($countCategories/2); $index++ ) : ?>
                                        <?php $thisPage = $currentTermId == $categories[$index]->term_id; ?>
                                        <li class="nav-item <?= $thisPage ? 'active' : '' ?>">
                                            <a class="nav-link <?= $thisPage ? 'active' : '' ?>" href="<?= get_category_link($categories[$index]) ?>">
                                                <?= $categories[$index]->name ?>
                                            </a>
                                        </li>
                                    <?php endfor; ?>
                                </ul>
                                <ul class="col-6 mobile">
                                    <?php for($index = ceil($countCategories/2); $index < $countCategories; $index++ ) : ?>                              
                                        <?php $thisPage = $currentTermId == $categories[$index]->term_id; ?>
                                        <li class="nav-item <?= $thisPage ? 'active' : '' ?>">
                                            <a class="nav-link <?= $thisPage ? 'active' : '' ?>" href="<?= get_category_link($categories[$index]) ?>">
                                                <?= $categories[$index]->name ?>
                                            </a>
                                        </li>                           
                                    <?php endfor; ?>
                                </ul>
                            </li>
                        <?php endif; ?>
                </ul>               
            </div>
            <?php theme()->templateTags()->breadrumbs() ?>
        </div>

        <div class="col-md-7 header-menu-thumbnail" style="background-image: url('<?= wp_get_attachment_url($category->header_image); ?>')"></div>
    </div>
    </div>

</div>