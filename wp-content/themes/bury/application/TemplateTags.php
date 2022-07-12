<?php
namespace App;

use \WP_Query;
use App\Extensions\Breadcrumb;

/**
* Class with template tags methods
*/
class TemplateTags
{

    /**
    * Print main menu
    */
    public function printMainMenu()
    {
        wp_nav_menu([
            'theme_location'    => 'primary-menu',
            'menu_id'        	=> 'primary-menu',
            'container_class'   => 'main-menu',
            'container_id'      => '',
            'menu_class'        => 'row',
            'add_li_class'      => 'col-md-2',
            'before'            => '<div class="menu-item-content">', 
            'after'             => '</div><button class="more"></button>'
        ]);
    }

    /**
    * Print footer menu
    */
    public function printFooterMenu1()
    {
        wp_nav_menu([
            'theme_location'    => 'footer-menu-1',
            'menu_id'        	=> 'footer-menu-1',
            'menu_class'        => 'links',
        ]);
    }

    /**
    * Print footer menu
    */
    public function printFooterMenu2()
    {
        wp_nav_menu([
            'theme_location'    => 'footer-menu-2',
            'menu_id'        	=> 'footer-menu-2',
            'menu_class'        => 'links',
        ]);
    }

    /**
    * Print footer menu
    */
    public function printFooterMenu3()
    {
        wp_nav_menu([
            'theme_location'    => 'footer-menu-3',
            'menu_id'        	=> 'footer-menu-3',
            'menu_class'        => 'links',
        ]);
    }

    /**
    * Print footer menu
    */
    public function printFooterMenu4()
    {
        wp_nav_menu([
            'theme_location'    => 'footer-menu-4',
            'menu_id'        	=> 'footer-menu-4',
            'menu_class'        => 'links',
        ]);
    }

    /**
    * Print footer menu
    */
    public function printFooterMenu5()
    {
        wp_nav_menu([
            'theme_location'    => 'footer-menu-5',
            'menu_id'        	=> 'footer-menu-5',
            'menu_class'        => 'links',
        ]);
    }

    /**
    * Print footer menu
    */
    public function printFooterMenuBottom()
    {
        wp_nav_menu([
            'theme_location'    => 'footer-menu-bottom',
            'menu_id'        	=> 'footer-menu-bottom',
            'menu_class'        => 'links',
        ]);
    }

    /**
    * Print description menu
    */
    public function printDescriptionMenu()
    {
        wp_nav_menu([
            'theme_location'    => 'description-menu',
            'menu_id'        	=> 'description-menu',
            'menu_class'        => 'links'
        ]);
    }

    public function printCareerMenu(string $type, $required = true)
    {
        global $post;
        $currentPostId = get_queried_object_id();

        $hasMenu = has_nav_menu('kariera-menu');
        if (!$hasMenu && $required) return;

        $newsMenuItems = [];
        $menuLocations = get_nav_menu_locations();
        $menuID = $menuLocations['kariera-menu'];
        if (!isset($menuID) && $required)
            return;

        $newsMenuItems = wp_get_nav_menu_items($menuID);

        if (!$newsMenuItems && $required)
            return;

        $currentId = null;
        foreach ($newsMenuItems as $k => $item) 
        {
            if ($item->type == 'post_type')
            {
                if (isset($currentPostId) && $item->object_id == $currentPostId)
                {
                    $currentId = $item->object_id;
                    break;
                }
            } 
            elseif ($item->type == 'post_type_archive')
            {
                if ($item->object == $type)
                {
                    $currentId = $item->object_id;
                    break;
                }
            }
            elseif ($item->type == 'taxonomy')
            {
                if ($item->object == 'category' && $item->object_id == $currentPostId)
                {
                    $currentId = $item->object_id;
                    break;
                }
            }
            elseif ($item->type == $type)
            {
                $currentId = $item->ID;
                break;
            }
        }

        $inNewsMenu = true;
        if (!$currentId)
        {
            $inNewsMenu = false;
            if ($required) return false;
        }

        $featured_media = null;
        $show = true;

        if (is_single() || is_page())
        {
            $featured_media = get_the_post_thumbnail_url($post);
            $show = true;
        }

        if (!$show) return false;

        partial('blocks/menu', [
            'is_preview' => false,
            'menu_id' => $menuID,
        ]);

        return true;
    }

    public function printHeaderMenu(string $type, $required = true)
    {
        global $post;
        $currentPostId = get_queried_object_id();

        $hasMenu = has_nav_menu('news-menu');
        if (!$hasMenu && $required) return;

        $newsMenuItems = [];
        $menuLocations = get_nav_menu_locations();
        $menuID = $menuLocations['news-menu'];
        if (!isset($menuID) && $required)
            return;

        $newsMenuItems = wp_get_nav_menu_items($menuID);
        if (!$newsMenuItems && $required)
            return;

        $currentId = null;
        foreach ($newsMenuItems as $k => $item) 
        {
            if ($item->type == 'post_type')
            {
                if (isset($currentPostId) && $item->object_id == $currentPostId)
                {
                    $currentId = $item->object_id;
                    break;
                }
            } 
            elseif ($item->type == 'post_type_archive')
            {
                if ($item->object == $type)
                {
                    $currentId = $item->object_id;
                    break;
                }
            }
            elseif ($item->type == 'taxonomy')
            {
                if ($item->object == 'category' && $item->object_id == $currentPostId)
                {
                    $currentId = $item->object_id;
                    break;
                }
            }
            elseif ($item->type == $type)
            {
                $currentId = $item->ID;
                break;
            }
        }

        $inNewsMenu = true;
        if (!$currentId)
        {
            $inNewsMenu = false;
            if ($required) return false;
        }

        $featured_media = null;
        $show = true;
        $postArchive = get_permalink( get_option( 'page_for_posts' ) );

        if (is_archive() || (is_archive() && is_category()) || is_home())
        {
            $show = false;
            if (array_has(theme()->config()->options()->sites, $post->post_type))
            {
                $featured_media = wp_get_attachment_url(data_get(theme()->config()->options()->sites, $post->post_type . '.header.featured_media'));
                $show = data_get(theme()->config()->options()->sites, $post->post_type . '.header.show', false);
            }
        }
        elseif (is_single() || is_page())
        {
            $featured_media = get_the_post_thumbnail_url($post);
            $show = true;
        }

        if (!$show) return false;

        partial('menu/default', [
            'items'             => $newsMenuItems,
            'currentPostId'     => $currentId,
            'currentPost'       => $post,
            'featured_media'    => $featured_media,
            'inNewsMenu'        => $inNewsMenu,
            'postArchive'       => $postArchive
        ]);

        return true;
    }

    function printChildrensMenu($post)
    {
        $isParent = $post->post_parent == 0;
        $parentPost = $isParent ? $post : get_post($post->post_parent);
        $childPages = get_children([
            'post_parent' => 0,
            'post_type'   => 'page', 
            'numberposts' => -1,
            'post_status' => 'any',
            'post_parent' => $parentPost->ID
        ]);
        if (isset($childPages) && is_array($childPages))
        {
            $featured_media = null;
            $show = false;
            $viewName = 'menu/children-pages';
            if (is_single())
            {
                if (array_has(theme()->config()->options()->sites, $post->post_type))
                {
                    $featured_media = get_the_post_thumbnail_url($post);
                    $show = data_get(theme()->config()->options()->sites, $post->post_type . '.header.show', false);
                    if (partial_exists('menu/' . $post->post_type . '-single'))
                    {
                        $viewName = 'menu/' . $post->post_type . '-single';
                    }
                }
            }
            elseif (is_page())
            {
                $featured_media = get_the_post_thumbnail_url($post);
                if (empty($featured_media))
                {
                    $featured_media = wp_get_attachment_url(theme()->config()->pageOptions()->header->featured_media);
                }
                $show = theme()->config()->pageOptions()->header->show;
            }

            if (!$show) return false;

            partial($viewName, [
                'parentPost' => $parentPost,
                'childPages' => $childPages,
                'post' => $post,
                'currentPostId' => $post->ID,
                'featured_media' => $featured_media
            ]);
        }
    }

    public function printProductMainMenu()
    {
        $categories = theme()->productModel()->getAllCategories(null, true, ['only_shown_menu' => true]);
        $childrens = array_flatten(array_filter(array_pluck($categories, 'childrens')), 1);
        $childrensIds = array_pluck($childrens, 'term_id');
        $products = [];
        $productsOfTopCat = [];
        foreach ($categories as $category) 
        {
            $productsOfTopCat[$category->term_id] = theme()->productModel()->getAllPublished(['category_without_children' => [$category->term_id]])->posts;
        }
        foreach ($childrensIds as $id) 
        {
            $products[$id] = theme()->productModel()->getAllPublished(['category_without_children' => [$id]])->posts;
        }
        partial('menu/products-main', compact('categories', 'products', 'productsOfTopCat'));
    }

    public function printProductMenu()
    {
        if (is_archive('products') && is_tax('products_category'))
        {
            $category = get_queried_object();
            $currentTermId = $category->term_id;

            $categories = theme()->productModel()->getAllCategories(null, false, ['hide_empty' => true, 'parent' => $category->parent, 'only_shown_menu' => true]);
            $parentCategory = null;

            if (!empty($category->parent))
            {
                $parentCategory = theme()->productModel()->getCategory($category->parent);
            }

            partial('menu/products-cat', compact('category', 'parentCategory', 'categories', 'currentTermId'));
        }
        elseif (is_single() && 'products' == get_post_type())
        {
            global $post;
            theme()->productModel()->injectField($post);
            $product = $post;
            $productCategories = theme()->productModel()->getAllShowInMenuCategories(theme()->productModel()->getAllCategories(null, true));
            $productCategories = array_pluck($productCategories, 'term_id');

            $product->other_products = theme()->productModel()->getRandom(3, ['post__not_in' => $post->ID, 'category' => $productCategories])->posts;
            $currentPostId = $post->ID;
            $category = theme()->productModel()->getPostCategory($post->ID);
            $products = [];
            $categoryAncestors = [];
            if ($category)
            {
                $categoryAncestors = (array)theme()->productModel()->getParentCategories($category->term_id);
                $products = theme()->productModel()->getAllPublished(['category_without_children' => [$category->term_id]])->posts;
            }

            $isarchive = $post->is_archive ?? false;

            partial('menu/products-single', compact('category', 'categoryAncestors', 'product', 'products', 'currentPostId', 'isarchive'));
        }
    }

    public function printCompetenceMainMenu()
    {
        $categories = theme()->competenceModel()->getAllCategories(null, true, ['only_shown_menu' => true]);
        $childrens = array_flatten(array_filter(array_pluck($categories, 'childrens')), 1);
        $childrensIds = array_pluck($childrens, 'term_id');
        $products = [];
        $productsOfTopCat = [];
        foreach ($categories as $category) 
        {
            $productsOfTopCat[$category->term_id] = theme()->competenceModel()->getAllPublished(['category_without_children' => [$category->term_id]])->posts;
        }
        foreach ($childrensIds as $id) 
        {
            $products[$id] = theme()->competenceModel()->getAllPublished(['category_without_children' => [$id]])->posts;
        }
        partial('menu/competences-main', compact('categories', 'products', 'productsOfTopCat'));
    }

    public function printCompetenceMenu()
    {
        if (is_archive('competences') && is_tax('competences_category'))
        {
            $category = get_queried_object();
            $currentTermId = $category->term_id;

            $categories = theme()->competenceModel()->getAllCategories(null, false, ['hide_empty' => true, 'parent' => $category->parent, 'only_shown_menu' => true]);
            $parentCategory = null;

            if (!empty($category->parent))
            {
                $parentCategory = theme()->competenceModel()->getCategory($category->parent);
            }

            partial('menu/competences-cat', compact('category', 'parentCategory', 'categories', 'currentTermId'));
        }
        elseif (is_single() && 'competences' == get_post_type())
        {
            global $post;
            theme()->competenceModel()->injectField($post);
            $product = $post;
            $productCategories = theme()->competenceModel()->getAllShowInMenuCategories(theme()->competenceModel()->getAllCategories(null, true));
            $productCategories = array_pluck($productCategories, 'term_id');

            if ( has_post_thumbnail() ) {
                $product->featured_media = wp_get_attachment_url( get_post_thumbnail_id());
            }
            $product->other_products = theme()->competenceModel()->getRandom(3, ['post__not_in' => $post->ID, 'category' => $productCategories])->posts;
            $currentPostId = $post->ID;
            $category = theme()->competenceModel()->getPostCategory($post->ID);
            $products = [];
            $categoryAncestors = [];
            if ($category)
            {
                $categoryAncestors = (array)theme()->competenceModel()->getParentCategories($category->term_id);
                $products = theme()->competenceModel()->getAllPublished(['category_without_children' => [$category->term_id]])->posts;
            }
            partial('menu/competences-single', compact('category', 'categoryAncestors', 'product', 'products', 'currentPostId'));
        }
    }

    public function breadrumbs(array $args = array('show_browse' => false))
    {
        $breadcrumb = new Breadcrumb( $args );

        echo $breadcrumb->trail();
    }

    /**
    * Print header
    *
    */
    public function printHeader()
    {
        $header = theme()->config()->headerOptions();

        if (empty($header) || ! $header->show) return;

        $path = 'headers/' . $header->view;

        $located = locate_template( 'partials/' . $path . '.php' );

        if ( !empty( $located ) ) 
        {
            partial($path, ['header' => $header, 'type' => is_single() ? 'single' : 'archive']);
        }
    }

    /**
    * Print pagination links
    */
    public function pagination(WP_Query $wp_query = null)
    {
        if ($wp_query === null)
        {
            global $wp_query;
        }

        $big = 999999999; // need an unlikely integer

        $links =  paginate_links( [
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            'total' => $wp_query->max_num_pages,
            'type'  => 'array',
            'next_text' => __( '' ),
            'prev_text' => __( '' ),
        ]);

        if( is_array( $links ) )
        {
            $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');

            echo '<ul class="page-numbers">';

            foreach ( $links as $link )
            {
                echo '<li>' . $link . '</li>';
            }

            echo '</ul>';
        }
        
    }


    /**
    * Print pagination links for search
    */
    public function searchPagination(WP_Query $wp_query = null, $type = "standardPage")
    {
        $big = 999999999; // need an unlikely integer
        $get = input_get();
        $links = paginate_links( [
            'base' => str_replace( $big, '%#%', esc_url( home_url('?'.$type.'=%#%') ) ),
            'format' => '?'.$type.'=%#%',
            'current' => array_get($get, $type, 1),
            'total' => $wp_query->max_num_pages,
            'type' => 'array',
            'next_text' => __( '' ),
            'prev_text' => __( '' ),
        ]);

        if( is_array( $links ) )
        {
            $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');

            echo '<nav class="pagination"><ul class="page-numbers">';

            foreach ( $links as $link )
            {
                echo '<li>' . $link . '</li>';
            }

            echo '</ul></nav>';
        }
    }

    public function redirect_parent_0_to_first_children($post)
    {
        $isParent = $post->post_parent == 0;
        if (!$isParent)
            return;
        
        $parentPost = $isParent ? $post : get_post($post->post_parent);
        $childPages = get_children([
            'post_parent' => 0,
            'post_type'   => 'page', 
            'numberposts' => -1,
            'post_status' => 'any',
            'post_parent' => $parentPost->ID
        ]);
        if (isset($childPages) && is_array($childPages) && count($childPages) && $isParent)
        {
            $firstChild = head($childPages);
            if (isset($firstChild))
            {
                wp_redirect($firstChild->guid);
                exit;
            }
        }
    }

    public function getVideoLength($id){
        $videoPath = wp_get_attachment_url($id);
        $position = strpos($videoPath, "wp-content");
        $link = substr($videoPath, $position);
        
        if ( !function_exists( 'wp_read_video_metadata' ) ) 
        { 
            require_once ABSPATH . '/wp-admin/includes/media.php'; 
        } 

        $metadata = wp_read_video_metadata($link);
        $length = $metadata['length'] * 1000;
        return $length;
    }

    public function getThemeColorStyle()
    {
        $color = theme()->config()->options()->color;
        return partial('theme-colors', compact('color'));
    }
}
