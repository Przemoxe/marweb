<?php
namespace App\Composers\Main;

use App\Core\BasePostType;

/**
*
*/
class JobOffersComposer extends BasePostType
{
    protected $postTypeName = 'job_offers';
    protected $prefix = 'job_offers_';

    /**
    * Register architect zones custom post type
    */
    public function initPostType()
    {
        $labels = [
            'name'               => _x( 'Oferty pracy', 'post type general name', TEXT_DOMAIN),
            'singular_name'      => _x( 'Oferta pracy', 'post type singular name', TEXT_DOMAIN),
            'menu_name'          => _x( 'Oferty pracy', 'admin menu', TEXT_DOMAIN),
            'name_admin_bar'     => _x( 'Oferty pracy', 'add new on admin bar', TEXT_DOMAIN),
            'add_new'            => _x( 'Dodaj nową', 'book', TEXT_DOMAIN),
            'add_new_item'       => __( 'Dodaj nową ofertę pracy', TEXT_DOMAIN),
            'new_item'           => __( 'Nowa oferta pracy', TEXT_DOMAIN),
            'edit_item'          => __( 'Edytuj ofertę pracy', TEXT_DOMAIN),
            'view_item'          => __( 'Pokaż ofertę pracy', TEXT_DOMAIN),
            'all_items'          => __( 'Wszystkie oferty pracy', TEXT_DOMAIN),
            'search_items'       => __( 'Wyszukaj oferty pracy', TEXT_DOMAIN),
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
            'has_archive'        => true,
            'rewrite'            => [
                'slug' => 'oferty-pracy'
            ],
            'hierarchical'       => false,
            'menu_position'      => null,
            'show_in_nav_menus'  => true,
            'menu_icon'          => 'dashicons-cart',
            'supports'           => ['title', 'excerpt'],
            'menu_icon'          => 'dashicons-id-alt',
        ];

        register_post_type( $this->postTypeName, $args);

        $this->addColumn('employee', __('Pracownik', TEXT_DOMAIN), function ($post_id, $post) {
            $employee = get_post(get_field('employee', $post));
            if (empty($employee)) return;
            echo \get_the_post_thumbnail($employee, array( 50, 50 ));
            echo '<strong>'.$employee->post_title.'</strong>';
        }, ['width' => 200, 'after' => 'title']);

        $this->addColumn('city', __('Miasto', TEXT_DOMAIN), function ($post_id, $post) {
            return get_field('city', $post);
        }, ['width' => 200, 'after' => 'title']);
    }

    public function initAdmin()
    {
    }
}
