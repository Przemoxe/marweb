<?php
namespace App\Models;

use App\Core\BaseModel;
use \WP_Query;

/**
 * JobOffer class
 */
class JobOffer extends BaseModel
{
    protected $postTypeName = 'job_offers';
    protected $prefix = 'job_offers_';

    public function injectField(&$post, $fields = [])
    {
        if ($fields == null)
        {
            $fields = theme()->config()->getAllPageOptions($post->ID);
        }
        $items = array_get($fields, 'items', []);
        if (empty($items))
        {
            $items = [];
        }

        $post->city = array_get($fields, 'city');
        $post->employee_id = array_get($fields, 'employee');
        $post->employee = theme()->employeeModel()->getByIds([$post->employee_id])->post;
        $post->deactivation_date = array_get($fields, 'deactivation_date');
        $post->items = array_map('array_to_object', $items);
        $post->description = array_get($fields, 'description');
        $post->application_link = array_get($fields, 'application_link');
    }

    public function injectFields(&$posts)
    {
        $employeeIds = array_pluck($posts, 'employee_id');
        $employeeIdsQuery = theme()->employeeModel()->getByIds($employeeIds);
        $employees = [];
        if (!empty($employeeIdsQuery))
        {
            $employees = array_pluck($employeeIdsQuery->posts, null, 'ID');
        }
        array_map(function ($post) use ($employees) {
            if (!empty($post->employee_id))
            {
                $post->employee = array_get($employees, $post->employee_id);
            }
        }, $posts);
    }

    /**
    * Get all posts with joined relations
    */
    public function getAllPublished($filters = [], $perPage = -1)
    {
        $self = $this;
        $query = [
            'post_type' => $this->postTypeName,
            'posts_per_page' => $perPage,
            'orderby' => 'post_date',
            'order' => 'DESC',
            'post_status' => 'publish'
        ];

        $this->preparePostFilters($query, $filters);

        $posts = new WP_Query($query);

        wp_query_each($posts, function($post, $key, $fields) use ($self)
        {
            $self->injectField($post, $fields);
        });
        $self->injectFields($posts->posts);

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
        if (array_has($filters, 'before_deactivation_date'))
        {
            $query['meta_query'][] = [
                'relation' => 'OR',
                [
                    'key' => 'deactivation_date',
                    'value' => '',
                    'compare' => '=='
                ],
                [
                    'key' => 'deactivation_date',
                    'value' => date('Ymd'),
                    'type' => 'DATE',
                    'compare' => '>='
                ],
            ];
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
                'terms'    => array_get($filters, 'category'),
            ];
        }
    }
}