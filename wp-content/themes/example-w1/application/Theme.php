<?php

namespace App;

/**
 * Template class
 */

class Theme
{
    /**
     * Init constructor.
     */
    public function __construct()
    {
        $this->init();
    }

    /**
     * Initialize plugin - setup plugin actions and hooks
     */
    protected function init()
    {
        // $this->afterSetupThemeAction();
        $this->SetupTheme();
        add_action('init', [$this, 'registerPostTypes']);
        add_action('wp_enqueue_scripts', [$this, 'registerAssetsAction']);
        if (!defined('TEXT_DOMAIN')) define('TEXT_DOMAIN', 'marweb');
    }

    /**
     * register scripts and styles
     */

    public function registerAssetsAction()
    {

        wp_enqueue_style('vendors-style', get_template_directory_uri() . '/assets/dist/css/build-vendor.css');
        wp_enqueue_style('theme-style', get_template_directory_uri() . '/assets/dist/css/build.css');
        wp_enqueue_style('fontawesome', get_template_directory_uri() . '/assets/src/front/favicons/font-awesome-4.7.0/css/font-awesome.min.css');

        wp_enqueue_script('vendors-scripts', get_template_directory_uri() . '/assets/dist/js/build-vendor.js', array(), '20151215', true);
        wp_enqueue_script('theme-script', get_template_directory_uri() . '/assets/dist/js/build.js', array(), '20151215', true);
    }

    public function SetupTheme()
    {
        //Define constants
        define('MARWEB_APP_PATH', trailingslashit(plugin_dir_path(__FILE__)));
        define('MARWEB_APP_URL', trailingslashit(plugins_url('/', __FILE__)));
        //Register nav menus
        register_nav_menus(array(
            'main-menu' => esc_html__('Menu głowne', 'marweb'),
            'footer-menu' => esc_html__('Menu stopka', 'marweb'),
            'language-menu' => esc_html__('Menu select language', 'marweb'),
        ));

        ///////////
        add_theme_support('post-thumbnails');

        //Change all Excerpt Length
        add_filter('excerpt_length', function () {
            return 15;
        });
        add_filter('excerpt_more', function () {
            return '...';
        });

        //Add ACF LOCAL

        add_filter('acf/settings/save_json', function ($path) {
            return get_stylesheet_directory() . '/application/ACF_LOCAL';
        });
        add_filter('acf/settings/load_json', function ($path) {
            return [get_stylesheet_directory() . '/application/ACF_LOCAL'];
        });


        //Load translate 
        add_action('init', function () {
            load_theme_textdomain('marweb',  MARWEB_APP_PATH . 'lang/');
        });
    }

    public function registerPostTypes()
    {
        //Register post types
        register_post_type('portfolio', array(
            'show_in_rest' => true,
            'supports' => array('title', 'editor', 'thumbnail'),
            'public' => true,
            'has_archive' => true,
            'label'  => __("Portfolio", 'marweb'),
            'labels' => array(
                'name' => __("Portfolio", 'marweb'),
                'add_new' => __('Dodaj projekt', 'marweb'),
                'edit_item' => __('Edytuj projekt', 'marweb'),
                'all_items' => __('Wszystkie projekty', 'marweb'),
                'singular_name' => __("Portfolio", 'marweb')
            ),
            'menu_icon' => 'dashicons-awards'
        ));
        register_post_type('blog', array(
            'show_in_rest' => true,
            'supports' => array('title', 'editor', 'thumbnail'),
            'public' => true,
            'has_archive' => true,
            'labels' => array(
                'name' => __("Blog", 'marweb'),
                'add_new' => __('Dodaj wpis', 'marweb'),
                'edit_item' => __('Edytuj wpis', 'marweb'),
                'all_items' => __('Wszystkie wpisy', 'marweb'),
                'singular_name' => 'blog'
            ),
            'menu_icon' => 'dashicons-awards'
        ));

        //Add Cpt archive page
        if (function_exists('acf_add_options_page')) {
            acf_add_options_sub_page(array(
                'page_title'      => __('Strona portfolio', 'marweb'), /* Use whatever title you want */

                'parent_slug'     => 'edit.php?post_type=portfolio', /* Change "services" to fit your situation */
                'capability' => 'manage_options'
            ));
            acf_add_options_sub_page(array(
                'page_title'      => __('Strona blog', 'marweb'), /* Use whatever title you want */

                'parent_slug'     => 'edit.php?post_type=blog', /* Change "services" to fit your situation */
                'capability' => 'manage_options'
            ));
        }
    }
}
