<?php
namespace App\Models;

use App\Core\BaseModel;
use \WP_Query;

/**
 * Product class
 */
class Product extends BaseModel
{
    protected $postTypeName = 'products';
    protected $prefix = 'products_';

    public function injectField(&$post, $fields = [])
    {
        if ($fields == null)
        {
            $fields = theme()->config()->getAllPageOptions($post->ID);
        }

        $post->is_archive = array_get($fields, 'is_archive', false);
        
        // Header featured image
        $featured_media = array_get($fields, 'featured_media');
        $post->featured_media = wp_get_attachment_url($featured_media);

        // Advantages
        $post->advantage = array_to_object([
            'title'         => array_get($fields, 'advantage_title'),
            'description'   => array_get($fields, 'advantage_description'),
            'media'         => array_get($fields, 'advantage_media'),
            'media_url'     => wp_get_attachment_url(array_get($fields, 'advantage_media')),
        ]);
        // Description
        $post->description = array_get($fields, 'description');
        // Fact sheet
        $post->fact = array_to_object([
            'title'         => array_get($fields, 'fact_title'),
            'subtitle'      => array_get($fields, 'fact_subtitle'),
            'description'   => array_get($fields, 'fact_description'),
            'button'        => page_link(array_get($fields, 'fact_button')),
            'image'         => array_get($fields, 'fact_image'),
        ]);
        // Gallery
        $gallery = array_filter((array) array_get($fields, 'gallery', []));
        $gallery = array_map(function ($item) {
            $images = array_get($item, 'images', []);
            $item['images'] = array_pluck(is_array($images) ? $images : [], 'image');
            return $item;
        }, $gallery);
        $post->gallery = array_map('array_to_object', $gallery);
    }

    public function injectCategoryField(&$term, $fields = [])
    {
        if ($fields == null)
        {
            $fields = theme()->config()->getAllTermOptions($term->term_id);
        }

        $term->show = array_get($fields, 'show');
        $term->image = array_get($fields, 'image');
        $term->header_image = array_get($fields, 'header_image');
        $term->color = array_get($fields, 'color');
    }

    /**
    * Get all posts with joined relations
    */
    public function getAllPublished($filters = [])
    {
        $self = $this;
        $query = [
            'post_type' => $this->postTypeName,
            'posts_per_page' => -1,
            'orderby' => 'post_date',
            'order' => 'ASC',
            'post_status' => 'publish'
        ];

        $this->preparePostFilters($query, $filters);

        $posts = new WP_Query($query);

        wp_query_each($posts, function($post, $key, $fields) use ($self)
        {
            $self->injectField($post, $fields);
        });

        return $posts;
    }

    /**
    * Get all posts with joined relations
    */
    public function getAll($filters = [])
    {
        $self = $this;
        $query = [
            'post_type' => $this->postTypeName,
            'posts_per_page' => -1,
            'orderby' => 'post_date',
            'order' => 'ASC',
        ];

        $this->preparePostFilters($query, $filters);

        $posts = new WP_Query($query);

        wp_query_each($posts, function($post, $key, $fields) use ($self)
        {
            $self->injectField($post, $fields);
        });

        return $posts;
    }

    public function getAllShowInMenuCategories(array $categories, array $result = [])
    {
        foreach ($categories as $category)
        {
            if ($category->show)
            {
                $childrens = $category->childrens;
                unset($category->childrens);
                $result[] = $category;
                $result = $this->getAllShowInMenuCategories($childrens, $result);
            }
        }
        return $result;
    }

    /**
     * Gets all categories that have products with field is_archive=1
     */
    public function getAllCategoriesWithArchivedProducts($level)
    {
        global $wpdb;
        $sql = "SELECT t.* from {$wpdb->prefix}terms t
        INNER JOIN {$wpdb->prefix}term_taxonomy AS tt ON (t.term_id = tt.term_id)
        INNER JOIN {$wpdb->prefix}term_relationships AS tr ON tr.term_taxonomy_id = tt.term_taxonomy_id
        RIGHT JOIN {$wpdb->prefix}posts as p ON p.ID = tr.object_id
        RIGHT JOIN {$wpdb->prefix}postmeta as pm ON pm.post_id = p.ID and pm.meta_key = 'is_archive'
        WHERE tt.taxonomy = 'products_category'and pm.meta_value = 1 AND tt.parent = $level
        GROUP by t.term_id, t.name, t.slug, t.term_group, t.term_order";

        $terms = $wpdb->get_results($sql);

        foreach ($terms as &$term)
        {
            $this->injectField($term, null);
        }

        return $terms;
    }

    /**
    * Extend query of filters
    * @param  array  $query
    * @param  array  $filters
    * @return array
    */
    public function preparePostFilters(array &$query, $filters)
    {
        $is_archive = intval(array_get($filters, 'is_archive', false));
        $include_archive = intval(array_get($filters, 'include_archive', false));
        if (false == $include_archive)
        {
            if ($is_archive)
            {
                $query['meta_query'] = [
                    [
                        'key'     => 'is_archive',
                        'value'   => $is_archive,
                        'compare' => '='
                    ],
                ];
            }
            else
            {
                $query['meta_query'] = [
                    'relation'    => 'OR',
                    [
                        'key'     => 'is_archive',
                        'value'   => '0',
                        'compare' => '='
                    ],
                    [
                        'key'     => 'is_archive',
                        'compare' => 'NOT EXISTS'
                    ],
                ];
            }
        }
        if (array_has($filters, 'post__not_in') && !empty(array_get($filters, 'post__not_in')))
        {
            $query['post__not_in'] = (array) array_get($filters, 'post__not_in', []);
        }
        if (array_has($filters, 'category') && !empty(array_get($filters, 'category')))
        {
            $query['tax_query'][] = [
                'taxonomy' => $this->prefix . 'category',
                'field'    => 'term_id',
                'terms'    => array_get($filters, 'category')
            ];
        }
        if (array_has($filters, 'category_without_children') && !empty(array_get($filters, 'category_without_children')))
        {
            $query['tax_query'][] = [
                'taxonomy'         => $this->prefix . 'category',
                'field'            => 'term_id',
                'terms'            => array_get($filters, 'category_without_children'),
                'include_children' => false
            ];
        }
        if (array_has($filters, 'category__not_in') && !empty(array_get($filters, 'category__not_in')))
        {
            $query['tax_query'][] = [
                'taxonomy' => $this->prefix . 'category',
                'field'    => 'term_id',
                'operator' => 'NOT IN',
                'terms'    => (array)array_get($filters, 'category__not_in'),
            ];
        }
    }
}