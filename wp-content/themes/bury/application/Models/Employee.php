<?php
namespace App\Models;

use App\Core\BaseModel;
use \WP_Query;

/**
 * Employee class
 */
class Employee extends BaseModel
{
    protected $postTypeName = 'employees';
    protected $prefix = 'employees_';

    public function injectField(&$post, $fields = [])
    {
        $post->position = array_get($fields, 'position');
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
            'order' => 'ASC',
            'post_status' => 'publish'
        ];

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
    public function getAll()
    {
        $self = $this;
        $query = [
            'post_type' => $this->postTypeName,
            'posts_per_page' => -1,
            'orderby' => 'post_date',
            'order' => 'ASC',
        ];

        $posts = new WP_Query($query);

        wp_query_each($posts, function($post, $key, $fields) use ($self)
        {
            $self->injectField($post, $fields);
        });

        return $posts;
    }
}