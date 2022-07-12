<?php
namespace App\Core;

use \WP_Query;

/**
*
*/
abstract class BaseModel
{
    /**
    * Wpdb database object
    */
    protected $wpdb = null;

    public function getPostTypeName()
    {
        return $this->postTypeName;
    }

    public function getAllGrouped()
    {
        return group_by_tax($this->postTypeName, $this->prefix . 'category');
    }

    public function injectField(&$post, $fields = [])
    {
        
    }

    public function injectFields(&$posts)
    {
        
    }

    public function injectCategoryField(&$term, $fields = [])
    {
        
    }

    public function extendArchiveQuery(\WP_Query &$query)
    {
    }

    /**
    * Get post by ids
    */
    public function getByIds($ids, $filters = [])
    {
        $ids = is_string($ids) ? explode(', ', $ids) : $ids;
        if (empty($ids)) return [];

        $self = $this;

        $query = [
            'post_type' => $this->postTypeName,
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'post__in' => $ids
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
     * Get random posts
     */
    public function getRandom($limit = 3, $filters = array())
    {
        $self = $this;
        $query = [
            'post_type' => $this->postTypeName,
            'posts_per_page' => $limit,
            'orderby'   => 'rand',
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
    * Get not empty collections
    */
    public function getAllCategories($post_id = null, $buildTree = true, $filters = [], $parent = null)
    {
        $self = $this;
        if (empty($post_id))
        {
            $args = [
                'taxonomy' => $this->prefix . 'category',
                'orderby'  => 'term_order',
                'order'    => 'ASC',
            ];
            if (array_has($filters, 'only_shown_menu'))
            {
                $args['meta_query'] = [
                    [
                        'key' => 'show',
                        'value' => 1
                    ]
                ];
            }
            if ($parent !== null)
            {
                $args['parent'] = $parent;
            }
            $this->prepareTermFilters($args, $filters);
            $terms = (new \WP_Term_Query($args))->get_terms();
        }
        else 
        {
            $args = [
                'taxonomy' => $this->prefix . 'category',
                'orderby'  => 'term_order',
                'order'    => 'ASC',
            ];
            if (array_has($filters, 'only_shown_menu'))
            {
                $args['meta_query'] = [
                    [
                        'key' => 'show',
                        'value' => 1
                    ]
                ];
            }
            if ($parent !== null)
            {
                $args['parent'] = $parent;
            }
            $this->prepareTermFilters($args, $filters);
            $terms = (new \WP_Term_Query($args))->get_terms();
        }

        if (!$terms || is_wp_error( $terms ) || empty($terms)) return [];

        array_each($terms, function($term) use ($self) {
            $self->injectCategoryField($term);
        });

        if ($buildTree)
        {
            return array_build_tree(object_to_array($terms), 'term_id', 'parent', 0, true);
        }
        return $terms;
    }

    public function getParentCategories($term_id)
    {
        $ancestorsIds = get_ancestors($term_id, $this->prefix . 'category');
        if (empty($ancestorsIds)) return [];
        return get_terms($this->prefix . 'category', array(
            'include' => $ancestorsIds,
        ));
    }

    public function getCategory($term_id)
    {
        return get_term($term_id, $this->prefix . 'category');
    }

    public function getPostCategory($post_id)
    {
        $terms = get_the_terms( $post_id, $this->prefix . 'category');
        if (empty($terms)) return null;
        return array_get_last($terms);
    }

    public function setCategory($post_id, $term_ids)
    {
        if (empty($post_id) || empty($term_ids)) return null;
        if (!is_array($term_ids))
        {
            $term_ids = [$term_ids];
        }
        wp_set_post_terms( $post_id, $term_ids, $this->prefix . 'category');
    }

    public function addCategory($name, $desciption = '')
    {
        if (empty($name)) return null;
        $result = wp_insert_term(
            $name,
            $this->prefix . 'category',
            array(
                'description'=> $desciption,
                'slug' => sanitize_title($name),
            )
        );
        if (is_wp_error($result))
        {
            if ($result->get_error_code() == 'term_exists')
            {
                return $result->get_error_data();
            }
            return null;
        }
        return array_get($result, 'term_id');
    }

    public function hasCategory($name)
    {
        return term_exists($name, $this->prefix . 'category');
    }

    public function getRecent($post_ids = null, $perPage = 2)
    {
        $self = $this;
        $query = [
            'post_type'         => $this->postTypeName,
            'posts_per_page'    => $perPage,
            'post_status'       => 'publish',
            'orderby'           => 'post_date',
            'order'             => 'DESC',
            'post__not_in'      => is_array($post_ids) ? $post_ids : [$post_ids]
        ];

        $posts = new WP_Query($query);

        return $posts;
    }

    public function deleteAllExcept(array $post_ids)
    {
        $posts = $this->getAllPublished()->posts;
        foreach($posts as $post)
        {
            if (in_array($post->ID, $post_ids)) continue;
            wp_delete_post($post->ID);
        }
    }

    /**
    * Extend query of filters
    * @param  array  $query
    * @param  array  $filters
    * @return array
    */
    public function prepareTermFilters(array &$query, $filters)
    {
        if (array_has($filters, 'hide_empty'))
        {
            $query['hide_empty'] = array_get($filters, 'hide_empty');
        }
        if (array_has($filters, 'parent'))
        {
            $query['parent'] = array_get($filters, 'parent');
        }
    }

    /**
    * Extend query of filters
    * @param  array  $query
    * @param  array  $filters
    * @return array
    */
    public function preparePostFilters(array &$query, $filters)
    {
    }

    /**
    * __construct
    */
    function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
    }
}
