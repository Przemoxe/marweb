<?php

if (! function_exists('wp_query_each'))
{
    /**
     * Map WP_Query object
     *
     * @param  WP_Query $wpQueryObject
     * @param  callable $callback
     */
    function wp_query_each(&$wpQueryObject, callable $callback)
    {
        $info = new ReflectionFunction($callback);
        $paramNum = $info->getNumberOfParameters();
        if (empty($wpQueryObject)) return;
        foreach ($wpQueryObject->posts as $key => $post)
        {
            $fields = null;
            if ($paramNum == 3)
            {
                $fields = theme()->config()->getAllPageOptions($post->ID);
            }
            call_user_func_array($callback, [$post, $key, $fields]);
        }
    }
}

if (! function_exists('wp_query_to_array'))
{
    /**
     * Cast WP_Query object to array
     *
     * @param  WP_Query $wpQueryObject
     * @return array
     */
    function wp_query_to_array(WP_Query $wpQueryObject)
    {
        return array_get(object_to_array($wpQueryObject), 'posts');
    }
}
