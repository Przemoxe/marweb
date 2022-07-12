<?php
namespace App\Extensions;

class ArchivePagesMenu
{
    function initAction()
    {
        add_filter( 'wp_get_nav_menu_items', [$this, 'archiveMenu'], 10, 3 );
        add_filter( 'wp_setup_nav_menu_item', [$this, 'wpSetupNavMenuItem'], 10);
    }

    function adminInitAction()
    {
        $this->addMetaBox();
    }

    public function archiveMenu( $items, $menu, $args )
    {
        foreach ( $items as &$item ) 
        {
            if ( $item->object != 'post_type_archive' ) continue;
            $item->url = get_post_type_archive_link( $item->type );
        }
        return $items;
    }

    public function wpSetupNavMenuItem($menuItem)
    {
        if ($menuItem->object == 'post_type_archive')
        {
            $menuItem->type_label = __( 'Post Type Archive' );
        }

        return $menuItem;
    }

    private function addMetaBox()
    {
        add_meta_box(
            'el_archive_page_menu_metabox',
            __('Archiwa', TEXT_DOMAIN),
            array($this, 'displayMetaBox'),
            'nav-menus',
            'side',
            'low'
        );
    }

    public function displayMetaBox()
    {
        $post_types = get_post_types(array('has_archive' => true));
        $post_types['post'] = 'post';
        partial('dashboard/archive-pages-metabox', compact('post_types'));
    }
}
