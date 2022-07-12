<?php
    theme()->fairModel()->injectField($parentPost);
?>
<div class="row children-pages">
    <div class="col-md-5 children-pages__background-left"></div>

    <div class="container">
    <div class="row">
        <div class="col-md-5 children-pages-nav ">
            <div class="content <?php if (!empty($featured_media) && is_video_url($featured_media)): ?>with-video<?php endif; ?>" drop-down-container>
                <div <?php if(!$childPages): ?>class="children-pages-nav-title"<?php endif; ?>><h1><?= $parentPost->post_title ?></h1></div>
                <?php if($childPages): ?>
                    <div class="nav ae-select">
                        <?php foreach ($items as $item): ?>
                            <?php  if($currentPostId == $item->object_id) $name = $item->title; 
                            ?>
                        <?php endforeach; ?>
                        <div class="ae-select-container"><span class="ae-select-content"><?= $name ?></span></div>
                        <div class="ae-select-arrow"></div>
                    </div>
                <?php endif; ?>
                <ul class="nav flex-column ae-hide">
                    <?php foreach ($childPages as $page): ?>
                        <?php $thisPage = $page->ID == $post->ID; ?>
                        <li class="nav-item">
                            <a class="nav-link <?= $thisPage ? 'active' : '' ?>" href="<?= $page->guid ?>">
                                <?= $page->post_title ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>          
            </div>
            <?php theme()->templateTags()->breadrumbs() ?>
        </div>

        
        <?php if (!empty($featured_media) && is_image_url($featured_media)): ?>
            <div class="col-md-7 children-pages-thumbnail children-pages-image" style="background-image: url(<?= $featured_media ?>);">
                <?php if (!empty($parentPost->icon)): ?>
                    <img class="children-pages-image__icon" src="<?= $parentPost->icon ?>" alt="icon">
                <?php endif; ?>
            </div>
        <?php elseif (!empty($featured_media) && is_video_url($featured_media)): ?>
            <div class="col-md-7 children-pages-thumbnail children-pages-video">
                <video src="<?= $featured_media ?>" autoplay loop muted></video>
                <?php if (!empty($parentPost->icon)): ?>
                    <img src="<?= $parentPost->icon ?>" alt="icon">
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="col-md-7 children-pages-thumbnail"></div>
        <?php endif; ?>
    </div>
    </div>
</div>