<?php
namespace App\Composers\Other;

use App\Core\BaseOptionsPage;

/**
* Menu  class
*/
class GutenbergComposer extends BaseOptionsPage
{
    public function initOptionsPage() {
        $this->set_gutenberg_custom_colors();
    }

    public function set_gutenberg_custom_colors()
    {
        $colors = theme()->getColors();
        add_theme_support( 'editor-color-palette', $colors);
    }
}