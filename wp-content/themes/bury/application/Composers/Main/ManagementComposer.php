<?php
namespace App\Composers\Main;

use App\Core\BasePostType;

/**
*
*/
class ManagementComposer extends BasePostType
{
    protected $postTypeName = 'management';
    protected $prefix = 'management_';

    /**
    * Register architect zones custom post type
    */
    public function initPostType()
    {
        $labels = [
            'name'               => _x( 'Zarząd', 'post type general name', TEXT_DOMAIN),
            'singular_name'      => _x( 'Zarząd', 'post type singular name', TEXT_DOMAIN),
            'menu_name'          => _x( 'Zarząd', 'admin menu', TEXT_DOMAIN),
            'name_admin_bar'     => _x( 'Zarząd', 'add new on admin bar', TEXT_DOMAIN),
            'add_new'            => _x( 'Dodaj nowy', 'book', TEXT_DOMAIN),
            'add_new_item'       => __( 'Dodaj nowy', TEXT_DOMAIN),
            'new_item'           => __( 'Nowy zarząd', TEXT_DOMAIN),
            'edit_item'          => __( 'Edytuj zarząd', TEXT_DOMAIN),
            'view_item'          => __( 'Pokaż', TEXT_DOMAIN),
            'all_items'          => __( 'Cały zarząd', TEXT_DOMAIN),
            'search_items'       => __( 'Szukaj w zarządzie', TEXT_DOMAIN),
            'parent_item_colon'  => __( 'Rodzic zarządu:', TEXT_DOMAIN),
            'not_found'          => __( 'Nie mozna znaleźć zarządu', TEXT_DOMAIN),
            'not_found_in_trash' => __( 'Nie można znaleźć zarządu w koszu.', TEXT_DOMAIN)
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
            'show_in_nav_menus'  => false,
            'supports'           => ['title', 'thumbnail', 'excerpt'],
            'menu_icon'          => 'dashicons-businessman',
        ];

        register_post_type( $this->postTypeName, $args);

        $this->registerPositionsTaxonomy();
    }

    public function registerPositionsTaxonomy()
    {
        $labels = [
            'name'              => _x( 'Stanowisko', 'taxonomy general name', TEXT_DOMAIN ),
            'singular_name'     => _x( 'Stanowisko', 'taxonomy singular name', TEXT_DOMAIN ),
            'search_items'      => __( 'Stanowiska', TEXT_DOMAIN ),
            'all_items'         => __( 'Wszystkie stanowiska', TEXT_DOMAIN ),
            'edit_item'         => __( 'Edytuj stanowisko', TEXT_DOMAIN ),
            'update_item'       => __( 'Zaktualizuj stanowisko', TEXT_DOMAIN ),
            'add_new_item'      => __( 'Dodaj nowe stanowisko', TEXT_DOMAIN ),
            'menu_name'         => __( 'Stanowiska', TEXT_DOMAIN ),
            'not_found'         => __( 'Nie znaleziono żadnych stanowisk', TEXT_DOMAIN )
        ];
        
        $args = [
            'hierarchical'       => true,
            'labels'             => $labels,
            'show_ui'            => true,
            'show_admin_column'  => true,
            'query_var'          => true,
            'public'             => true,
            'show_in_nav_menus'  => false,
        ];
        

        register_taxonomy( $this->prefix . 'positions', [$this->postTypeName], $args );
    }
}
