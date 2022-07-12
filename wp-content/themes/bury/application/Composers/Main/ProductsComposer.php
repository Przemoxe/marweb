<?php
namespace App\Composers\Main;

use App\Core\BasePostType;

/**
*
*/
class ProductsComposer extends BasePostType
{
    protected $postTypeName = 'products';
    protected $prefix = 'products_';
    
    /**
    * Register architect zones custom post type
    */
    public function initPostType()
    {
        $labels = [
            'name'               => _x( 'Produkty', 'post type general name', TEXT_DOMAIN),
            'singular_name'      => _x( 'Produkt', 'post type singular name', TEXT_DOMAIN),
            'menu_name'          => _x( 'Produkty', 'admin menu', TEXT_DOMAIN),
            'name_admin_bar'     => _x( 'Prodult', 'add new on admin bar', TEXT_DOMAIN),
            'add_new'            => _x( 'Dodaj  produkt', TEXT_DOMAIN),
            'add_new_item'       => __( 'Dodaj nowy produkt', TEXT_DOMAIN),
            'new_item'           => __( 'Nowy produkt', TEXT_DOMAIN),
            'edit_item'          => __( 'Edytuj produkt', TEXT_DOMAIN),
            'view_item'          => __( 'Pokaż produkt', TEXT_DOMAIN),
            'all_items'          => __( 'Wszystkie produkty', TEXT_DOMAIN),
            'search_items'       => __( 'Wyszukaj produkt', TEXT_DOMAIN),
            'not_found'          => __( 'Nie znaleziono żadnych wpisów', TEXT_DOMAIN),
            'not_found_in_trash' => __( 'Nie znaleziono żadnych wpisów w koszu', TEXT_DOMAIN)
        ];
        
        $args = [
            'labels'                => $labels,
            'public'                => true,
            'publicly_queryable'    => true,
            'exclude_from_search'   => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'query_var'             => true,
            'capability_type'       => 'post',
            'has_archive'           => false,
            'rewrite'               => [
                'slug' => 'produkt'
            ],
            'hierarchical'          => false,
            'menu_position'         => null,
            'show_in_nav_menus'     => true,
            'menu_icon'             => 'dashicons-cart',
            'supports'              => ['title', 'editor', 'thumbnail', 'excerpt'],
            'capability_type'       => 'post',
        ];
        
        register_post_type( $this->postTypeName, $args);

        add_filter('acf/load_field/name=thumbnail_type', [$this, 'loadThumbnailTypeField']);
        add_filter('acf/load_field/name=size', [$this, 'loadSizeField']);
        add_filter('manage_edit-' . $this->prefix . 'category_columns', [$this, 'manageEditCategoryColumns']);

        $this->registerCategoryTaxonomy();

        $this->addColumn('is_archive', __('Produkt archiwalny', TEXT_DOMAIN), function ($post_id, $post) {
            if (get_field('is_archive', $post))
            {
                return '<span class="dashicons dashicons-yes-alt"></span>';
            }
        }, ['width' => 100, 'after' => 'taxonomy-products_category']);
    }

    public function registerCategoryTaxonomy()
    {
        $labels = [
            'name'              => _x( 'Kategoria produktu', 'taxonomy general name', TEXT_DOMAIN ),
            'singular_name'     => _x( 'Kategoria produktu', 'taxonomy singular name', TEXT_DOMAIN ),
            'search_items'      => __( 'Wyszukaj kategorie produktów', TEXT_DOMAIN ),
            'all_items'         => __( 'Wszystkie kategorie produktów', TEXT_DOMAIN ),
            'edit_item'         => __( 'Edytuj kategorie produktu', TEXT_DOMAIN ),
            'update_item'       => __( 'Zaktualizuj kategorie produktu', TEXT_DOMAIN ),
            'add_new_item'      => __( 'Dodaj nową kategorie produktu', TEXT_DOMAIN ),
            'menu_name'         => __( 'Kategorie', TEXT_DOMAIN ),
            'not_found'         => __( 'Nie znaleziono żadnych kategorii produktów', TEXT_DOMAIN )
        ];
        
        $args = [
            'hierarchical'       => true,
            'labels'             => $labels,
            'show_ui'            => true,
            'show_admin_column'  => true,
            'query_var'          => true,
            'public'             => true,
            'has_archive'        => false,
            'rewrite'            => [
                'slug' => 'produkty'
            ]
        ];
        
        register_taxonomy( $this->prefix . 'category', [$this->postTypeName], $args );
    }

    public function loadThumbnailTypeField($field)
    {
        $field['choices'] = [
            'image'         => __('Obrazek', TEXT_DOMAIN),
            'background'    => __('Tło', TEXT_DOMAIN),
        ];
        return $field;
    }

    public function loadSizeField($field)
    {
        $field['choices'] = [
            'small'         => __('Mały', TEXT_DOMAIN),
            'large'    => __('Duży', TEXT_DOMAIN),
        ];
        return $field;
    }

    public function manageEditCategoryColumns($columns)
    {
        unset($columns['description']);
        return $columns;
    }
}
