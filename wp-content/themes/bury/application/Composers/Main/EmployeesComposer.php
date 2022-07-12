<?php
namespace App\Composers\Main;

use App\Core\BasePostType;

/**
*
*/
class EmployeesComposer extends BasePostType
{
    protected $postTypeName = 'employees';
    protected $prefix = 'employees_';

    /**
    * Register architect zones custom post type
    */
    public function initPostType()
    {
        $labels = [
            'name'               => _x( 'Pracownicy', 'post type general name', TEXT_DOMAIN),
            'singular_name'      => _x( 'Pracownik', 'post type singular name', TEXT_DOMAIN),
            'menu_name'          => _x( 'Pracownicy', 'admin menu', TEXT_DOMAIN),
            'name_admin_bar'     => _x( 'Pracownicy', 'add new on admin bar', TEXT_DOMAIN),
            'add_new'            => _x( 'Dodaj nowego', 'book', TEXT_DOMAIN),
            'add_new_item'       => __( 'Dodaj nowego pracownika', TEXT_DOMAIN),
            'new_item'           => __( 'Nowy pracownik', TEXT_DOMAIN),
            'edit_item'          => __( 'Edytuj pracownika', TEXT_DOMAIN),
            'view_item'          => __( 'Pokaż pracownika', TEXT_DOMAIN),
            'all_items'          => __( 'Wszyscy pracownicy', TEXT_DOMAIN),
            'search_items'       => __( 'Wyszukaj pracownika', TEXT_DOMAIN),
            'not_found'          => __( 'Nie znaleziono żadnych wpisów', TEXT_DOMAIN),
            'not_found_in_trash' => __( 'Nie znaleziono żadnych wpisów w koszu', TEXT_DOMAIN)
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
            'has_archive'        => false,
            'hierarchical'       => false,
            'menu_position'      => null,
            'show_in_nav_menus' => false,
            'menu_icon'          => 'dashicons-groups',
            'supports'           => ['title', 'editor', 'thumbnail', 'excerpt'],
            'menu_icon'          => 'dashicons-groups',
        ];

        register_post_type( $this->postTypeName, $args);

        $this->addColumn('image', __('Obrazek wyróżniający', TEXT_DOMAIN), function ($post_id, $post) {
            return \get_the_post_thumbnail($post, array( 100, 100 ));
        }, ['width' => 200]);
    }

    public function initAdmin()
    {
    }
}
