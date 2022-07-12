<div class="products-menu row">
    <span class="menu-title"><?= __('Kompetencje', TEXT_DOMAIN) ?></span>
    <!-- Level 1 categories -->
    <ul id="competence-menu" class="competence-menu menu-right accordion md-accordion primary-menu col-12" role="tablist" aria-multiselectable="true">
        <?php foreach ($categories as $index => $category): ?>

            <li class="card  row menu-item menu-item-<?= $index ?>">
                <div class="card-header" role="tab" id="heading-competences-<?= $index ?>">
                    <a class="menu-item-text" href="<?= get_category_link($category->term_id) ?>">
                    <?php
                        $special = get_field('show_underline_red', 'products_category' . '_' . $category->term_id);
                        ?>
                        <span>
                            <?= $category->name ?>
                        </span>
                    </a>
                    <button class="more collapsed" type="button" data-toggle="collapse" data-parent="#competence-menu" data-target="#competences-<?= $index ?>" aria-expanded="true"></button>
                </div>
                <!-- Level 2 categories -->
                <ul class="card-body sub-menu sub-menu__categories col-9 collapse show" id="competences-<?= $index ?>" aria-labelledby="heading-competences-<?= $index ?>" data-parent="#competence-menu">
                    <li id="sub-menu-competence-<?= $index ?>" class="row accordion md-accordion">
                        <?php foreach ($category->childrens as $childIndex => $child): ?>
                            <ul class="col-5 sub-menu__categories__column">
                                <li class="card">
                                    <div class="card-header" role="tab" id="heading-competences-<?= $index ?>-<?= $childIndex ?>">
                                        <div class="card-header-content"><a href="<?= get_category_link($child->term_id) ?>"><?= $child->name ?></a></div>
                                        <button class="more collapsed" type="button" data-toggle="collapse" data-parent="#sub-menu-competence-<?= $index ?>" data-target="#sub-menu-competence-<?= $index ?>-<?= $childIndex ?>" aria-expanded="true" ></button>
                                    </div>
                                    <!-- Level 2 category products -->
                                    <?php if(array_key_exists($child->term_id, $products)): ?>

                                        <ul class="card-body sub-menu sub-menu__categories__products collapse"  id="sub-menu-competence-<?= $index ?>-<?= $childIndex ?>"  aria-labelledby="heading-competences-<?= $index ?>-<?= $childIndex ?>" data-parent="#sub-menu-competence-<?= $index ?>">

                                            <?php foreach ($products[$child->term_id] as $categoryProduct): ?>
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
                        <?php if(array_key_exists($category->term_id, $productsOfTopCat)): ?>

                        <ul class="col-5 sub-menu__categories__column"  id="sub-menu-product-<?= $index ?>"  aria-labelledby="heading-<?= $index ?>" data-parent="#sub-menu-<?= $index ?>">

                            <?php foreach ($productsOfTopCat[$category->term_id] as $categoryProduct): ?>
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

    </ul>
    <!--/ Level 1 categories -->
</div>