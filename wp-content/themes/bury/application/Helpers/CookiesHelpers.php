<?php

if (! function_exists('set_cookie'))
{
    /**
     * Set native cookie - this function supports arrays
     *
     * @param  mixed $key
     * @param  mixed $data
     * @param  int $days
     * @return array
     */
    function set_cookie($key, $data, $days = 7)
    {
        $time = time() + 60 * 60 * 24 * $days;
        $data = is_array($data) ? json_encode($data) : $data;
        setcookie($key, $data, $time, COOKIEPATH, COOKIE_DOMAIN);
    }
}

if (! function_exists('get_cookie'))
{
    /**
     * Get native cookie value by key
     *
     * @param  mixed $key
     * @return mixed
     */
    function get_cookie($key, $default = null)
    {
        $value = !empty($_COOKIE[$key]) ? $_COOKIE[$key] : $default;

        if (is_json_string($value))
        {
            return json_decode(stripslashes($value));
        }
        else
        {
            return $value;
        }
    }
}
