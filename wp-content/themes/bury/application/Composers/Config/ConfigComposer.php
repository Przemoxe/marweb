<?php
namespace App\Composers\Config;

use App\Core\BaseOptionsPage;

/**
* Config  class
*/
class ConfigComposer extends BaseOptionsPage
{
    protected $floorSizes;
    /**
    * Init strony ustawien
    */
    public function initOptionsPage()
    {
        if( function_exists('acf_add_options_page') ): 
            acf_add_options_page([
                'page_title' 	=> 'Ustawienia konfiguracjne',
                'menu_title'	=> 'Konfiguracja',
                'menu_slug' 	=> 'config-settings',
                'capability'	=> 'edit_posts',
                'redirect'		=> false
            ]);
        endif;
    }

    public function initAction()
    {
    }
}
