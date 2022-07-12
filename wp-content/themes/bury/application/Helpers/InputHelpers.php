<?php

if (! function_exists('get_url'))
{
    /**
     * Get current url with all params
     *
     * @return String
     */
    function get_url()
    {
        global $wp;
        $query = !empty($_GET) ? '?' . http_build_query($_GET) : null;
        return home_url( $wp->request ) . $query;
    }
}

if (! function_exists('get_url_extended_of_params'))
{
    /**
     * Get current url with all params
     *
     * @param  array $params
     * @return String
     */
    function get_url_extended_of_params(array $params)
    {
        global $wp;
        $queryParams = array_merge($_GET, $params);
        $query = !empty($queryParams) ? '?' . http_build_query($queryParams) : null;
        return home_url( $wp->request ) . $query;
    }
}

if (! function_exists('input_get'))
{
    /**
     * Get data from $_GET by key
     *
     * @param  mixed $key
     * @return String
     */
    function input_get($key = null, $default = null)
    {
        if ($key === null)
        {
            return $_GET;
        }
        else
        {
            return array_get($_GET, $key, $default);
        }
    }
}

if (! function_exists('input_post'))
{
    /**
     * Get data from $_POST by key
     *
     * @param  mixed $key
     * @return String
     */
    function input_post($key = null, $default = null)
    {
        if ($key === null)
        {
            return $_POST;
        }
        else
        {
            return array_get($_POST, $key, $default);
        }
    }
}

if (! function_exists('input_file'))
{
    /**
     * Get data from $_FILES by key
     *
     * @param  mixed $key
     * @return String
     */
    function input_file($key = null, $default = null)
    {
        if ($key === null)
        {
            return $_FILES;
        }
        else
        {
            return array_get($_FILES, $key, $default);
        }
    }
}

if (! function_exists('is_post'))
{
    /**
     * Check if request is post
     *
     * @param  mixed $key
     * @return String
     */
    function is_post()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }
}

if (! function_exists('input_has'))
{
    function input_has($key) 
    {
        return array_has($_GET, $key);
    }
}
