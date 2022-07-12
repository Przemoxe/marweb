<?php
namespace App\Composers\Other;

use App\Core\BaseOptionsPage;

/**
*
*/
class ScriptsComposer extends BaseOptionsPage
{
    public function initOptionsPage()
    {
        acf_add_options_sub_page([
            'page_title' 	=> __('Globalne skrypty', TEXT_DOMAIN),
            'menu_title'	=> __('Globalne skrypty', TEXT_DOMAIN),
            'parent_slug'	=> 'config-settings',
            'menu_slug'	=> 'config-scripts',
        ]);
    }
}
