<?php
namespace App\Composers\Main;

use App\Core\BasePostType;

/**
*
*/
class CompetencesComposer extends BasePostType
{
    protected $postTypeName = 'competences';
    protected $prefix = 'competences_';
    
    /**
    * Register architect zones custom post type
    */
    public function initPostType()
    {
        $labels = [
            'name'               => _x( 'Kompetencje', 'post type general name', TEXT_DOMAIN),
            'singular_name'      => _x( 'Kompetencja', 'post type singular name', TEXT_DOMAIN),
            'menu_name'          => _x( 'Kompetencje', 'admin menu', TEXT_DOMAIN),
            'name_admin_bar'     => _x( 'Kompetencja', 'add new on admin bar', TEXT_DOMAIN),
            'add_new'            => _x( 'Dodaj kompetencje', TEXT_DOMAIN),
            'add_new_item'       => __( 'Dodaj nową kompetencje', TEXT_DOMAIN),
            'new_item'           => __( 'Nowa kompetencja', TEXT_DOMAIN),
            'edit_item'          => __( 'Edytuj kompetencje', TEXT_DOMAIN),
            'view_item'          => __( 'Pokaż kompetencje', TEXT_DOMAIN),
            'all_items'          => __( 'Wszystkie kompetencje', TEXT_DOMAIN),
            'search_items'       => __( 'Wyszukaj kompetencje', TEXT_DOMAIN),
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
                'slug' => 'kompetencja'
            ],
            'hierarchical'          => false,
            'menu_position'         => null,
            'show_in_nav_menus'     => true,
            'menu_icon'             => 'dashicons-cart',
            'show_in_rest'          => true,
            'supports'              => ['title', 'editor', 'thumbnail', 'excerpt'],
            'capability_type'       => 'post',
        ];
        
        register_post_type( $this->postTypeName, $args);

        add_filter('acf/load_field/name=thumbnail_type', [$this, 'loadThumbnailTypeField']);
        add_filter('acf/load_field/name=size', [$this, 'loadSizeField']);
        add_filter('manage_edit-' . $this->prefix . 'category_columns', [$this, 'manageEditCategoryColumns']);

        $this->registerCategoryTaxonomy();
    }

    public function registerCategoryTaxonomy()
    {
        $labels = [
            'name'              => _x( 'Kategoria kompetencji', 'taxonomy general name', TEXT_DOMAIN ),
            'singular_name'     => _x( 'Kategoria kompetencji', 'taxonomy singular name', TEXT_DOMAIN ),
            'search_items'      => __( 'Wyszukaj kategorie kompetencji', TEXT_DOMAIN ),
            'all_items'         => __( 'Wszystkie kategorie kompetencji', TEXT_DOMAIN ),
            'edit_item'         => __( 'Edytuj kategorie kompetencji', TEXT_DOMAIN ),
            'update_item'       => __( 'Zaktualizuj kategorie kompetencji', TEXT_DOMAIN ),
            'add_new_item'      => __( 'Dodaj nową kategorie kompetencji', TEXT_DOMAIN ),
            'menu_name'         => __( 'Kategorie', TEXT_DOMAIN ),
            'not_found'         => __( 'Nie znaleziono żadnych kategorii kompetencji', TEXT_DOMAIN )
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
                'slug' => 'kompetencje'
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
