<?php
namespace App\Models;

use App\Core\BaseModel;
use App\Core\Interfaces\ISearchable;
use \WP_Query;

/**
* Search class
*/
class Search extends BaseModel
{
    public function standardSearch($query, $paged = 1, $postTypes = ['post'])
    {
        $postTypes = is_array($postTypes) ? $postTypes : array( $postTypes );
        
        return new WP_Query([
            's' => $query,
            'post_status' => 'publish',
            'paged' => $paged,
            'post_type' => $postTypes,
        ]);
    }

    public function categorySearch($postType, $category, $paged = 1)
    {
        return new WP_Query([
            'post_status' => 'publish',
            'paged' => $paged,
            'post_type' => $postType,
            'tax_query' => array(
                array(
                    'taxonomy' => $postType . '_category',
                    'field' => 'slug',
                    'terms' => $category,
                )
            )
        ]);
    }

    public function __call($name, $arguments)
    {
        if (method_exists($this, $name)) return $this->{$name}();
        if (ends_with($name, 'Search'))
        {
            $model = str_replace('Search', '', $name) . 'Model';
            if (theme()->hasDependency($model))
            {
                if (theme()->{$model}() instanceof ISearchable)
                {
                    return theme()->{$model}()->search(array_get($arguments, 0), array_get($arguments, 1, -1));
                }
            }
        }
        throw new \Exception( $name . ' - Called search dependency not exists in theme!');
    }
}
