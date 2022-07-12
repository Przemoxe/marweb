<?php
namespace App\Composers\Config;

use App\Core\BaseOptionsPage;

/**
* SocialMediaComposer class
*/
class SocialMediaComposer extends BaseOptionsPage
{
    /**
    * Init strony ustawien
    */
    public function initOptionsPage()
    {
        if( function_exists('acf_add_options_sub_page') ): 
            acf_add_options_sub_page([
                'page_title' 	=> 'Ustawienia Social media',
                'menu_title'	=> 'Social media',
                'parent_slug'	=> 'config-settings',
                'menu_slug' 	=> 'config-social-media-settings',
            ]);
        endif;
    }
}
