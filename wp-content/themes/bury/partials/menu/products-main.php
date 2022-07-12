<div class="products-menu row">

    <span class="menu-title"><?= __('Produkty', TEXT_DOMAIN) ?></span>
    <!-- Level 1 categories -->
    <ul id="product-menu" class="accordion menu-right md-accordion primary-menu col-12" role="tablist" aria-multiselectable="true">
        <?php foreach ($categories as $index => $category) : ?>
            <?php
                $special = get_field('show_underline_red', 'products_category' . '_' . $category->term_id);
            ?>
            <li class="card  row menu-item menu-item-<?= $index ?> <?= $special ? 'special' : 'no-special' ?>">
                <div class="card-header" role="tab" id="heading-<?= $index ?>">
                    <a class="menu-item-text" href="<?= get_category_link($category->term_id) ?>">

                        <span class="<?= $special ? 'background-red' : '' ?>">
                            <?= $category->name ?>
                        </span>
                    </a>
                    <button class="more collapsed" type="button" data-toggle="collapse" data-parent="#product-menu" data-target="#products-<?= $index ?>" aria-expanded="true"></button>
                    <div style="color:white">
                    </div>
                </div>

                <!-- Level 2 categories -->
                <ul class="card-body sub-menu sub-menu__categories col-9 collapse show" id="products-<?= $index ?>" aria-labelledby="heading-<?= $index ?>" data-parent="#product-menu">
                    <li id="sub-menu-<?= $index ?>" class="row accordion md-accordion">
                        <?php foreach ($category->childrens as $childIndex => $child) : ?>
                            <ul class="col-5 sub-menu__categories__column">
                                <li class="card">
                                    <div class="card-header" role="tab" id="heading-<?= $index ?>-<?= $childIndex ?>">
                                        <div class="card-header-content"><a href="<?= get_category_link($child->term_id) ?>"><?= $child->name ?></a></div>
                                        <button class="more collapsed" type="button" data-toggle="collapse" data-parent="#sub-menu-<?= $index ?>" data-target="#sub-menu-product-<?= $index ?>-<?= $childIndex ?>" aria-expanded="true"></button>
                                    </div>
                                    <!-- Level 2 category products -->
                                    <?php if (array_key_exists($child->term_id, $products)) : ?>

                                        <ul class="card-body sub-menu sub-menu__categories__products collapse" id="sub-menu-product-<?= $index ?>-<?= $childIndex ?>" aria-labelledby="heading-<?= $index ?>-<?= $childIndex ?>" data-parent="#sub-menu-<?= $index ?>">

                                            <?php foreach ($products[$child->term_id] as $categoryProduct) : ?>
                                                <li>
                                                    <a href="<?= get_permalink($categoryProduct) ?>"><?= $categoryProduct->post_title ?></a>
                                                </li>
                                            <?php endforeach; ?>

                                        </ul>

                                    <?php endif; ?>
                                    <!--/ Level 2 category products -->

                                </li>
                            </ul>
                        <?php endforeach; ?>
                        <!-- Level 1 category products -->
                        <?php if (array_key_exists($category->term_id, $productsOfTopCat)) : ?>

                            <ul class="col-5 sub-menu__categories__column" id="sub-menu-product-<?= $index ?>" aria-labelledby="heading-<?= $index ?>" data-parent="#sub-menu-<?= $index ?>">

                                <?php foreach ($productsOfTopCat[$category->term_id] as $categoryProduct) : ?>
                                    <li class="card">
                                        <div class="card-header ofTopCat">
                                            <a href="<?= get_permalink($categoryProduct) ?>"><?= $categoryProduct->post_title ?></a>
                                        </div>
                                    </li>
                                <?php endforeach; ?>

                            </ul>

                        <?php endif; ?>
                        <!--/ Level 1 category products -->
                    </li>
                </ul>
                <!--/ Level 2 categories -->

            </li>

        <?php endforeach; ?>
        <li class='card row menu-item menu-item-archive'>
            <div class="card-header" role="tab" id="heading-3">
                <?php
                $archivePage = get_page_by_path('archiwum-produktow');
                $translatedArchivePage = get_page(icl_object_id($archivePage->ID));
                ?>
                <a class="menu-item-text" href='<?= get_permalink($translatedArchivePage); ?>'><span class="archive-span"><?= $translatedArchivePage->post_title; ?></span></a>
            </div>
        </li>
    </ul>
    <!--/ Level 1 categories -->
</div>