<?php
/**
*  Functions and definitions
*
* @link https://developer.wordpress.org/themes/basics/theme-functions/
*
* @package CityFit
*/
require_once ABSPATH . 'wp-admin/includes/plugin.php';

/**
* Sprawdzenie wymagań szablonu
*/
if (!is_plugin_active( 'advanced-custom-fields-pro/acf.php' ))
{
    if (!is_admin())  throw new Exception('This theme require Advanced Custom Fields and Ideo Helpers plugins.');
}

require_once get_template_directory() . '/application/Init.php';