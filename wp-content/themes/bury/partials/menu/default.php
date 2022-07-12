<div class="row header-menu">
    <div class="col-md-5 header-menu__background-left"></div>

    <div class="container">
    <div class="row">
        <div class="col-md-5 header-menu-nav">
            <div class="content" drop-down-container>
                <?php if ($inNewsMenu): ?>
                    <?php $menu_location = 'news-menu';
                        $menu_locations = get_nav_menu_locations();
                        $menu_object = (isset($menu_locations[$menu_location]) ? wp_get_nav_menu_object($menu_locations[$menu_location]) : null);
                        $menu_name = (isset($menu_object->name) ? $menu_object->name : '');  
                    ?>
                    <h1>
                        <span class="title-link"><?= $menu_name ?></span>
                    </h1>
                    <div class="nav ae-select">
                        <?php foreach ($items as $item): ?>
                            <?php  if($currentPostId == $item->object_id || $currentPostId == $item->ID) $name = $item->title; 
                            ?>
                        <?php endforeach; ?>
                        <div class="ae-select-container title-up"><span class="ae-select-content"><?= $name ?></span></div>
                        <?php if(count($items) > 1) : ?>
                                <div class="ae-select-arrow"></div>
                        <?php endif; ?>
                    </div>
                    <ul class="nav <?php if(count($items) > 1) : ?> flex-column <?php endif; ?> ae-hide">
                        <?php foreach ($items as $item): ?>
                            <?php $thisPage = $currentPostId == $item->object_id || $currentPostId == $item->ID; 
                            ?>
                            <?php if($thisPage) : ?>
                                <li class="nav-item active">
                                    <h1 class="nav-link active">
                                        <?= $item->title ?>
                                    </h1>
                                </li>
                            <?php else : ?>
                                <li class="nav-item <?= $thisPage ? 'active' : '' ?>">
                                    <a class="nav-link <?= $thisPage ? 'active' : '' ?>" href="<?= $item->url ?>">
                                        <?= $item->title ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <h1><?= get_the_archive_title() ?></h1>
                <?php endif; ?>
            </div>    
            <?php theme()->templateTags()->breadrumbs() ?>          
        </div>
    </div>
    </div>

        <?php if (!empty($featured_media) && is_image_url($featured_media)): ?>
            <div class="col-md-7 header-menu-thumbnail header-menu-image" style="background-image: url(<?= $featured_media ?>);"></div>
        <?php elseif (!empty($featured_media) && is_video_url($featured_media)): ?>
            <div class="col-md-7 header-menu-thumbnail header-menu-video">
                <video src="<?= $featured_media ?>" autoplay loop muted></video>
            </div>
        <?php else: ?>
            <div class="col-md-7 header-menu-thumbnail none"></div>
        <?php endif; ?>

</div>