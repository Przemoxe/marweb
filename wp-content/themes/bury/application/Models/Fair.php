<?php
namespace App\Models;

use App\Core\BaseModel;
use \WP_Query;

/**
 * Fair class
 */
class Fair extends BaseModel
{
    protected $postTypeName = 'fairs';
    protected $prefix = 'fairs_';

    public function injectField(&$post, $fields = [])
    {
        if ($fields == null)
        {
            $fields = theme()->config()->getAllPageOptions($post->ID);
        }
        
        $post->dateFrom = array_get($fields, 'fair_date_from');
        $post->dateTo = array_get($fields, 'fair_date_to');
        $post->icon = array_get($fields, 'fair_icon');
        $post->address = array_get($fields, 'fair_address');
        $post->mapCode = array_get($fields, 'fair_map_code');
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

        $posts = new WP_Query($query);

        wp_query_each($posts, function($post, $key, $fields) use ($self)
        {
            $self->injectField($post, $fields);
        });

        return $posts;
    }
}