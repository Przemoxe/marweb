<?php

if (! function_exists('is_json_string'))
{
    /**
    * Check if string is json string
    *
    * @param  String $string
    * @return array
    */
    function is_json_string($string)
    {
        return is_string($string) && is_array(json_decode(stripslashes($string), true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
    }
}

if (! function_exists('text_excerpt'))
{
    /**
    * Text excerpt by limit
    *
    * @param  int $limit
    * @param  String $text
    * @return String
    */
    function text_excerpt($limit, $text)
    {
        if(strlen($text) < $limit) return $text;
        
        $excerpt = preg_replace(" (\[.*?\])",'',$text);
        $excerpt = strip_shortcodes($excerpt);
        $excerpt = strip_tags($excerpt);
        $excerpt = substr($excerpt, 0, $limit);
        $excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
        $excerpt = !empty($excerpt) ? $excerpt . ' [...]' : $excerpt;
        return $excerpt;
    }
}

if (! function_exists('the_content_excerpt'))
{
    /**
    * Excerpt post content by limit
    *
    * @param  int $limit
    * @return String
    */
    function the_content_excerpt($limit)
    {
        echo text_excerpt($limit, get_the_content());
    }
}

if ( ! function_exists('str_slug'))
{
    /**
    * Generate a URL friendly "slug" from a given string.
    *
    * @param  string  $title
    * @param  string  $separator
    * @return string
    */
    function str_slug($title, $separator = '-')
    {
        $title = ascii($title);
        // Convert all dashes/underscores into separator
        $flip = $separator == '-' ? '_' : '-';
        $title = preg_replace('!['.preg_quote($flip).']+!u', $separator, $title);
        // Remove all characters that are not the separator, letters, numbers, or whitespace.
        $title = preg_replace('![^'.preg_quote($separator).'\pL\pN\s]+!u', '', mb_strtolower($title));
        // Replace all separator characters and whitespace by a single separator
        $title = preg_replace('!['.preg_quote($separator).'\s]+!u', $separator, $title);
        return trim($title, $separator);
    }
}
