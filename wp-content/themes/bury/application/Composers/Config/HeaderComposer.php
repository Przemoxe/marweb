<?php
namespace App\Composers\Config;

use App\Core\BaseOptionsPage;

/**
* HeaderComposer class
*/
class HeaderComposer extends BaseOptionsPage
{
    /**
    * Init strony ustawien
    */
    public function initOptionsPage()
    {
        if( function_exists('acf_add_options_sub_page') ): 
            acf_add_options_sub_page([
                'page_title' 	=> 'Ustawienia nagłówka',
                'menu_title'	=> 'Nagłówek',
                'parent_slug'	=> 'config-settings',
                'menu_slug'	=> 'config-header-settings',
            ]);
        endif;
    }
}
