<div class="row header-menu">
    <div class="col-md-5 header-menu__background-left"></div>

    <div class="container">
    <div class="row">
        <div class="col-md-5 header-menu-nav">
            <div class="content" drop-down-container>
                <?php if($isarchive): ?>
                    <?php
                        $archivePage = get_page_by_path( 'archiwum-produktow' );
                        $translatedArchivePage = get_page(icl_object_id($archivePage->ID));
                        echo "<div class='menu-title'><a class='title-link' href='".get_permalink($translatedArchivePage)."'>".$translatedArchivePage->post_title."</a></div>";
                    ?>
                <?php else: ?>
                    <?php foreach ($categoryAncestors as $index => $item): ?>
                        <?php if ($index == 0): ?>
                            <div class="menu-title"><a class="title-link" href="<?= get_category_link($item) ?>"><?= $item->name ?></a></div>
                        <?php else: ?>
                            <div class="menu-title"><a class="title-link" href="<?= get_category_link($item) ?>"><?= $item->name ?></a></div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <?php if (!empty($category)): ?>
                        <div class="menu-title"><a class="title-link" href="<?= get_category_link($category) ?>"><?= $category->name ?></a></div>
                    <?php endif; ?>
                    
                    <div class="nav ae-select">
                        <?php foreach ($products as $item): ?>
                            <?php  if($currentPostId == $item->ID) $name = $item->post_title; 
                            ?>
                        <?php endforeach; ?>
                        <div class="ae-select-container"><span class="ae-select-content"><?= $name ?></span></div>
                        <?php if(count($products) > 1) : ?>
                            <div class="ae-select-arrow"></div>                   
                        <?php endif; ?>
                    </div>
                    <ul class="nav flex-column ae-hide">
                        <?php $countProducts = count($products) ?>
                        <?php if($countProducts < 8) : ?>
                            <?php foreach ($products as $item): ?>
                                <?php $thisPage = $currentPostId == $item->ID; ?>
                                <li class="nav-item <?= $thisPage ? 'active' : '' ?>">
                                    <a class="nav-link <?= $thisPage ? 'active' : '' ?>" href="<?= get_permalink($item) ?>">
                                        <?= $item->post_title ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <li class="row">
                            <ul class="col-6 mobile">
                            <?php for($index = 0; $index <  ceil($countProducts/2); $index++ ) : ?>
                                    <?php $thisPage = $currentPostId == $products[$index]->ID; ?>
                                        <li class="nav-item <?= $thisPage ? 'active' : '' ?>">
                                            <a class="nav-link <?= $thisPage ? 'active' : '' ?>" href="<?= get_permalink($products[$index]) ?>">
                                                <?= $products[$index]->post_title ?>
                                            </a>
                                        </li>
                                    <?php endfor; ?>
                                </ul>
                                <ul class="col-6 mobile">
                                    <?php for($index = ceil($countProducts/2); $index < $countProducts; $index++ ) : ?>                              
                                        <?php $thisPage = $currentPostId == $products[$index]->ID; ?>
                                        <li class="nav-item <?= $thisPage ? 'active' : '' ?>">
                                            <a class="nav-link <?= $thisPage ? 'active' : '' ?>" href="<?= get_permalink($products[$index]) ?>">
                                                <?= $products[$index]->post_title ?>
                                            </a>
                                        </li>                             
                                    <?php endfor; ?>
                                </ul>
                            </li>
                        <?php endif; ?>
                    </ul>  
                <?php endif; ?>           
            </div>
            <?php if($isarchive): ?>
                <?php theme()->templateTags()->breadrumbs(['is_archival' => true]) ?>
            <?php else: ?>
                <?php theme()->templateTags()->breadrumbs(['post_taxonomy' => ['products' => 'products_category']]) ?>
            <?php endif; ?>
        </div>

        <?php if (!empty($product->featured_media) && is_image_url($product->featured_media)): ?>
            <div class="col-md-7 header-menu-thumbnail header-menu-image" style="background-image: url(<?= $product->featured_media ?>);"></div>
        <?php elseif (!empty($product->featured_media) && is_video_url($product->featured_media)): ?>
            <div class="col-md-7 header-menu-thumbnail header-menu-video">
                <video src="<?= $product->featured_media ?>" autoplay loop muted></video>
            </div>
        <?php else: ?>
            <div class="col-md-7 header-menu-thumbnail"></div>
        <?php endif; ?>
    </div>
    </div>
</div>