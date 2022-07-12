<?php
namespace App\Composers\Config;

use App\Core\BaseOptionsPage;

/**
* Config  class
*/
class CookiesInfoComposer extends BaseOptionsPage
{
    /**
    * Init strony ustawien
    */
    public function initOptionsPage()
    {
        acf_add_options_sub_page([
            'page_title' 	=> 'Ustawienia komunikatu o ciasteczkach',
            'menu_title'	=> 'Pasek Cookies',
            'parent_slug'	=> 'config-settings',
            'menu_slug'	=> 'config-cookies-info-settings',
        ]);
    }
}
