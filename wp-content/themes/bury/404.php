<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package CityFit
 */

get_header(); 

$not_found = theme()->config()->options()->not_found;
?>

<div class="error-section-404 parallax-container">
    <div class="parallax-header">
        <div class="h1">
            <?= $not_found->parallax_title ?>
        </div>
    </div>

        <div class="row">
            <div class="left col-md-7">
                <div class="helpless-icon">
                    <?php if(!empty($not_found->icon)) 
                        print_svg($not_found->icon); 
                    else ?> 
                        <embed src="<?php echo get_template_directory_uri(); ?>/assets/dist/images/404.svg" type="image/svg+xml" /> 
                        
                </div>
            </div>
            <div class="right col-md-5">
                <div class="msg-box-404">
                    <h2><?= $not_found->title ?? __('nie znaleziono strony', TEXT_DOMAIN) ?></h2>
                    <div class="description-404"><?= $not_found->content ?></div>
                    <?php if(!empty($not_found->link)): ?>
                        <?= build_link($not_found->link, ['class' => 'button']) ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

</div>

<?php
get_footer();