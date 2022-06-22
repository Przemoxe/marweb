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
        add_action('wp_enqueue_scripts', [$this, 'registerAssetsAction']);
        add_action('after_setup_theme', [$this, 'SetupTheme']);
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

        wp_enqueue_script('vendors-script', get_template_directory_uri() . '/assets/dist/js/build-vendor.js', array(), '20151215', true);
        wp_enqueue_script('theme-script', get_template_directory_uri() . '/assets/dist/js/build.js', array(), '20151215', true);
    }

    public function SetupTheme()
    {
        //Register nav menus
        register_nav_menus(array(
            'main-menu' => esc_html__('Menu głowne', TEXT_DOMAIN),
            'footer-menu' => esc_html__('Menu stopka', TEXT_DOMAIN),
        ));

        //Register post types
        register_post_type('portfolio', array(
            'show_in_rest' => true,
            'supports' => array('title', 'editor', 'thumbnail'),
            'public' => true,
            'has_archive' => true,
            'labels' => array(
                'name' => __("Portfolio", TEXT_DOMAIN),
                'add_new' => __('Dodaj projekt', TEXT_DOMAIN),
                'edit_item' => __('Edytuj projekt', TEXT_DOMAIN),
                'all_items' => __('Wszystkie projekty', TEXT_DOMAIN),
                'singular_name' => 'Portfolio'
            ),
            'menu_icon' => 'dashicons-awards'
        ));
        register_post_type('blog', array(
            'show_in_rest' => true,
            'supports' => array('title', 'editor', 'thumbnail'),
            'public' => true,
            'has_archive' => true,
            'labels' => array(
                'name' => __("Blog", TEXT_DOMAIN),
                'add_new' => __('Dodaj wpis', TEXT_DOMAIN),
                'edit_item' => __('Edytuj wpis', TEXT_DOMAIN),
                'all_items' => __('Wszystkie wpisy', TEXT_DOMAIN),
                'singular_name' => 'blog'
            ),
            'menu_icon' => 'dashicons-awards'
        ));

        ///////////
        add_theme_support('post-thumbnails');
    }
}
