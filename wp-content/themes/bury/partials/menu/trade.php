<?php
$featured_media = wp_get_attachment_url(theme()->config()->options()->sites->posts->header->featured_media);
?>

<div class="row header-menu">
    <div class="col-md-5 d-flex justify-content-end header-menu-nav">
        <div class="content">
            <?php $menu_location = 'header-menu';
                $menu_locations = get_nav_menu_locations();
                $menu_object = (isset($menu_locations[$menu_location]) ? wp_get_nav_menu_object($menu_locations[$menu_location]) : null);
                $menu_name = (isset($menu_object->name) ? $menu_object->name : '');  
            ?>
            <h1>
                <?= $menu_name ?>
            </h1>
            <ul class="nav flex-column">
                <?php foreach ($items as $item): ?>
                    <?php $thisPage = $currentPostId == $item->object_id; 
                    ?>
                    <li class="nav-item">
                        <a class="nav-link <?= $thisPage ? 'active' : '' ?>" href="<?= $item->url ?>">
                            <?= $item->title ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>           
        </div>
        <?php theme()->templateTags()->breadrumbs() ?>
    </div>

    <?php if (!empty($featured_media) && is_image_url($featured_media)): ?>
        <div class="col-md-7 header-menu-thumbnail" style="background-image: url(<?= $featured_media ?>);"></div>
    <?php elseif (!empty($featured_media) && is_video_url($featured_media)): ?>
        <div class="col-md-7 header-menu-thumbnail">
            <video src="<?= $featured_media ?>" autoplay loop muted></video>
        </div>
    <?php endif; ?>
    
</div>
