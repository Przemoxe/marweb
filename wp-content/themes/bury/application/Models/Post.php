<?php
namespace App\Models;

use App\Core\BaseModel;
use \WP_Query;

/**
 * Post class
 */
class Post extends BaseModel
{
    protected $postTypeName = 'post';
    protected $prefix = 'post_';

    public function injectField(&$post, $fields = [])
    {
    }

    /**
    * Get all posts with joined relations
    */
    public function getAllPublished($filters = [], $perPage = -1, $orderby = 'post_date', $order = 'ASC')
    {
        $self = $this;
        $query = [
            'post_type' => $this->postTypeName,
            'posts_per_page' => $perPage,
            'orderby' => $orderby,
            'order' => $order,
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
    * Extend query of filters
    * @param  array  $query
    * @param  array  $filters
    * @return array
    */
    public function preparePostFilters(array &$query, $filters)
    {
        if (array_has($filters, 'category') && !empty(array_get($filters, 'category')))
        {
            $query['tax_query'][] = [
                'taxonomy' => 'category',
                'field'    => 'term_id',
                'terms'    => array_get($filters, 'category'),
                'operator' => 'IN',
            ];
        }
    }
}