<?php
namespace App\Composers\Config;

use App\Core\BaseOptionsPage;

/**
* CustomPostComposer class
*/
class CustomPostComposer extends BaseOptionsPage
{
    /**
    * Init strony ustawien
    */
    public function initOptionsPage()
    {
        acf_add_options_page([
            'page_title' 	=> 'Ustawienia stron',
            'menu_title'	=> 'Strony',
            'parent_slug'	=> 'config-settings',
            'menu_slug' 	=> 'config-custom-posts-settings',
        ]);
    }
}
