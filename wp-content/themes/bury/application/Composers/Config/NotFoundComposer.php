<?php
namespace App\Composers\Config;

use App\Core\BaseOptionsPage;

/**
* Config  class
*/
class NotFoundComposer extends BaseOptionsPage
{
    /**
    * Init strony ustawien
    */
    public function initOptionsPage()
    {
        acf_add_options_sub_page([
            'page_title' 	=> 'Ustawienia strony 404',
            'menu_title'	=> '404',
            'parent_slug'	=> 'config-settings',
            'menu_slug'	=> 'config-not-found-settings',
        ]);
    }
}
