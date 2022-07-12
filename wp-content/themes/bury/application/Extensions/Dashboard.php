<?php
namespace App\Extensions;

class Dashboard
{
    /**
     * __construct
     */
    function __construct()
    {
        add_action('admin_enqueue_scripts', [$this, 'addCustomAssets']);
        add_action('wp_before_admin_bar_render', [$this, 'wpBeforeAdminBarRender']);
        
    }

    /**
     * Dodanie styli dla panelu wordpressa
     */
    public function addCustomAssets()
    {
        wp_register_style( 'admin-styles', get_template_directory_uri() . '/assets/dist/css/' . bundle('admin.css'), false, '1.0.0' );
        wp_enqueue_style( 'admin-styles' );
        wp_enqueue_script( 'admin-script', get_template_directory_uri() . '/assets/dist/js/' . bundle('admin.js'), array(), '20151215', true );
    }

    function wpBeforeAdminBarRender() 
    {
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu('comments');
    }
}
