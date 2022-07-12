<div class="row children-pages">
    <div class="col-md-5 children-pages__background-left"></div>

    <div class="container">
    <div class="row">
        <div class="col-md-5 children-pages-nav ">
            <div class="content <?php if (!empty($featured_media) && is_video_url($featured_media)): ?>with-video<?php endif; ?>" drop-down-container>
                <div <?php if(!$childPages): ?>class="children-pages-nav-title"<?php endif; ?>><h1><?= $parentPost->post_title ?></h1></div>
                <?php if($childPages): ?>
                    <div class="nav ae-select">
                        <?php foreach ($childPages as $page): ?>
                            <?php  if($currentPostId == $page->ID) $activePage = $page->post_title; 
                            ?>
                        <?php endforeach; ?>
                        <div class="ae-select-container "><span class="ae-select-content"><?= $activePage ?></span></div>
                        <?php if(count($childPages) > 1) : ?>
                            <div class="ae-select-arrow"></div>                   
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                    <ul class="nav <?php if(count($childPages) > 1) : ?> flex-column <?php endif; ?> ae-hide">
                    <?php foreach ($childPages as $page): ?>
                        <?php $thisPage = $page->ID == $post->ID; ?>
                        <li class="nav-item <?= $thisPage ? 'active' : '' ?>">
                            <a class="nav-link <?= $thisPage ? 'active' : '' ?>" href="<?= $page->guid ?>">
                                <?= $page->post_title ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>               
            </div>
            <?php theme()->templateTags()->breadrumbs() ?>
        </div>
    </div>
    </div>

        
    <?php if (!empty($featured_media) && is_image_url($featured_media)): ?>
        <div class="col-md-7 children-pages-thumbnail children-pages-image">
            <img src="<?= $featured_media?>" alt="">
        </div>
    <?php elseif (!empty($featured_media) && is_video_url($featured_media)): ?>
        <div class="col-md-7 children-pages-thumbnail children-pages-video">
            <video src="<?= $featured_media ?>" autoplay loop muted></video>
        </div>
    <?php else: ?>
        <div class="col-md-7 children-pages-thumbnail"></div>
    <?php endif; ?>
    
</div>
