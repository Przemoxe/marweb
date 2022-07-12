<?php
namespace App\Composers\Other;

use App\Core\BasePostType;

/**
*
*/
class StylesComposer extends BasePostType
{
    protected $postTypeName = 'styles';
    protected $prefix = 'styles_';

    /**
    * Zarejestrowanie post type dla punktów sprzedaży
    */
    public function initPostType()
    {
        $labels = [
            'name'               => _x( 'Style', 'post type general name', TEXT_DOMAIN),
            'singular_name'      => _x( 'Styl', 'post type singular name', TEXT_DOMAIN),
            'menu_name'          => _x( 'Style', 'admin menu', TEXT_DOMAIN),
            'name_admin_bar'     => _x( 'Style', 'add new on admin bar', TEXT_DOMAIN),
            'add_new'            => _x( 'Dodaj nowy', 'add new', TEXT_DOMAIN),
            'add_new_item'       => __( 'Dodaj nowy styl', TEXT_DOMAIN),
            'new_item'           => __( 'Nowy styl', TEXT_DOMAIN),
            'edit_item'          => __( 'Edytuj styl', TEXT_DOMAIN),
            'view_item'          => __( 'Pokaż styl', TEXT_DOMAIN),
            'all_items'          => __( 'Wszystkie style', TEXT_DOMAIN),
            'search_items'       => __( 'Wyszukaj styl', TEXT_DOMAIN),
            'parent_item_colon'  => __( 'Rodzice wpisu:', TEXT_DOMAIN),
            'not_found'          => __( 'Nie znaleziono stylu.'), TEXT_DOMAIN,
            'not_found_in_trash' => __( 'Nie znaleziono stylu w koszu.', TEXT_DOMAIN)
        ];

        $args = [
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'capability_type'    => 'post',
            'has_archive'        => true,
            'rewrite'            => [
                'slug' => 'inspiracje/style'
            ],
            'hierarchical'       => false,
            'menu_position'      => null,
            'menu_icon'          => 'dashicons-admin-appearance',
            'supports'           => ['title', 'thumbnail', 'editor']
        ];

        register_post_type( $this->postTypeName, $args);
    }
}
