<?php if (!empty($menu_id)): ?>
    <div class="br-block menu">
        <div class="container">
            <div class="row">
                <div class="col-md-12" drop-down-container>
                    <div class="nav ae-select">
                        <div class="ae-select-container">
                            <div class="ae-select-content"><?= wp_nav_menu(['menu' => $menu_id]); ?></div>
                        </div>
                        <div class="ae-select-arrow"></div>
                    </div>
                    <div class="nav flex-column ae-hide">
                        <?= wp_nav_menu(['menu' => $menu_id]); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php elseif ($is_preview): ?>
    <?= __('Brak menu', TEXT_DOMAIN) ?>
<?php endif; ?>