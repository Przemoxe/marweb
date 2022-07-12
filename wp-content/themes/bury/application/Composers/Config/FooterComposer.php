<?php
namespace App\Composers\Config;

use App\Core\BaseOptionsPage;

/**
* FooterComposer class
*/
class FooterComposer extends BaseOptionsPage
{
    /**
    * Init strony ustawien
    */
    public function initOptionsPage()
    {
        if( function_exists('acf_add_options_sub_page') ): 
            acf_add_options_sub_page([
                'page_title' 	=> 'Ustawienia stopki',
                'menu_title'	=> 'Stopka',
                'parent_slug'	=> 'config-settings',
                'menu_slug'	=> 'config-footer-settings',
            ]);
        endif;
    }
}
