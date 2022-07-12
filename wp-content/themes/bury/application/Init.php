<?php
require_once get_template_directory() . '/application/vendor/autoload.php';

foreach (scandir(dirname(__FILE__). DIRECTORY_SEPARATOR . 'Helpers') as $filename) 
{
    $path = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Helpers' . DIRECTORY_SEPARATOR . $filename;
	
    if (!is_dir($path)) 
	{
        require_once $path;
    }
}

/**
* Run theme
*/
$app_theme = new \App\Theme();

/**
* Template tag to return theme object
*/
if(!function_exists('theme'))
{
    function theme()
    {
        global $app_theme;
        return $app_theme;
    }
}

$app_theme->register();

/**
 * Extract dependencies to theme
 */
if (!empty($app_theme->dependeciesObjects))
{
    extract($app_theme->dependeciesObjects);
}
