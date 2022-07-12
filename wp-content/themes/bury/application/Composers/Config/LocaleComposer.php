<?php
namespace App\Composers\Config;

use App\Core\BaseOptionsPage;

/**
* Config  class
*/
class ConfigComposer extends BaseOptionsPage
{
    /**
    * Init strony ustawien
    */
    public function initOptionsPage()
    {
        acf_add_options_sub_page([
            'page_title' 	=> 'Ustawienia wielojęzyczności',
            'menu_title'	=> 'Wielojęzyczność',
            'parent_slug'	=> 'config-settings',
            'menu_slug'	=> 'config-multilanguage-settings',
        ]);
    }
}
