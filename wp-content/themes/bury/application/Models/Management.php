<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\BaseModel;
use \WP_Query;

/**
 * JobOffer class
 */
class Management extends BaseModel
{
    protected $postTypeName = 'management';
    protected $prefix = 'management_';

    public function injectField(&$post, $fields = [])
    {
        $post->position = array_get($fields, 'positions');
        $post->post_excerpt = nl2br($post->post_excerpt ?? '');
    }

    /**
    * Get all posts with joined relations
    */
    public function getAllPublishedManagement(array $filters = [])
    {
        $self = $this;
        $query = [
            'post_type' => $this->postTypeName,
            'posts_per_page' => -1,
            'orderby' => 'post_date',
            'order' => 'ASC',
            'post_status' => 'publish',
        ];

        $posts = new WP_Query($query);
        wp_query_each($posts, function($post, $key, $fields) use ($self)
        {
            $post->positions = $self->getPositions($post->ID);
            
            $self->injectField($post, $fields);
        });

        return $posts;
    }

    /**
    * Get all posts with joined relations
    */
    public function getPositionsWithPosts(array $filters = [])
    {
        $args = array(
            'orderby'           => 'name', 
            'order'             => 'ASC',
            'hide_empty'        => true, 
            'exclude'           => array(), 
            'exclude_tree'      => array(), 
            'include'           => array(),
            'number'            => '', 
            'fields'            => 'all', 
            'slug'              => '', 
            'parent'            => 0,
            'hierarchical'      => true, 
            'child_of'          => 0, 
            'get'               => '', 
            'name__like'        => '',
            'description__like' => '',
            'pad_counts'        => false, 
            'offset'            => '', 
            'search'            => '', 
            'cache_domain'      => 'core'
        ); 
        $positions = get_terms( [$this->prefix . 'positions'], $args );

        $countries = [];

        foreach($positions as $position){
            if(get_field('kraj', $position)){
                $countries[] = $position;
            }
        }

        $management = $this->getAllPublishedManagement();

        foreach ($countries as $position) {
            $position->menagement = $this->getManagementForPositionId($management, $position->term_id);
        }

        return $countries;
    }

    public function getPositions($postId) 
    {
        return get_the_terms( $postId, $this->prefix . 'positions');
    }

    public function getPostsForPositionId(int $termId) 
    {
        return get_posts(
            array(
                'posts_per_page' => -1,
                'post_type' => 'management',
                'tax_query' => [
                    [
                      'taxonomy' => 'management_positions',
                      'field' => 'term_id',
                      'terms' => $termId,
                    ]
                ]
            )
        );
    }

    public function getManagementForPositionId(WP_Query $management, int $positionId)
    {
        $results = [];
        foreach ($management->posts as $manager) 
        {
            $managamentPositions = array_pluck($manager->positions, 'term_id');
            $found = array_search($positionId, $managamentPositions) !== false;

            if ($found) 
            {
                $results[] = $manager;
            }
        }

        return $results;
    }
}