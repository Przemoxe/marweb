<?php
namespace App\Composers\Main;

use App\Core\BasePostType;

/**
*
*/
class FairsComposer extends BasePostType
{
    protected $postTypeName = 'fairs';
    protected $prefix = 'fairs_';

    /**
    * Register architect zones custom post type
    */
    public function initPostType()
    {
        $labels = [
            'name'               => _x( 'Targi', 'post type general name', TEXT_DOMAIN),
            'singular_name'      => _x( 'Targi', 'post type singular name', TEXT_DOMAIN),
            'menu_name'          => _x( 'Targi', 'admin menu', TEXT_DOMAIN),
            'name_admin_bar'     => _x( 'Targi', 'add new on admin bar', TEXT_DOMAIN),
            'add_new'            => _x( 'Dodaj nowy', 'book', TEXT_DOMAIN),
            'add_new_item'       => __( 'Dodaj nowy', TEXT_DOMAIN),
            'new_item'           => __( 'Nowy targ', TEXT_DOMAIN),
            'edit_item'          => __( 'Edytuj targ', TEXT_DOMAIN),
            'view_item'          => __( 'Pokaż', TEXT_DOMAIN),
            'all_items'          => __( 'Wszystkie targi', TEXT_DOMAIN),
            'search_items'       => __( 'Szukaj w targach', TEXT_DOMAIN),
            'parent_item_colon'  => __( 'Rodzic targu:', TEXT_DOMAIN),
            'not_found'          => __( 'Nie mozna znaleźć targu', TEXT_DOMAIN),
            'not_found_in_trash' => __( 'Nie można znaleźć targu w koszu.', TEXT_DOMAIN)
        ];

        $args = [
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'exclude_from_search' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'capability_type'    => 'post',
            'has_archive'        => true,
            'rewrite'            => null,
            'hierarchical'       => false,
            'menu_position'      => null,
            'show_in_nav_menus'  => true,
            'rewrite'            => [
                'slug' => 'targi'
            ],
            'supports'           => ['title', 'editor', 'thumbnail', 'excerpt'],
            'menu_icon'          => 'dashicons-calendar',
            'show_in_menu'       => true,
            'show_in_nav_menus'  => true
        ];

        register_post_type( $this->postTypeName, $args);
    }
}
