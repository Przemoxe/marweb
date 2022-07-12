<?php

namespace App\Composers\Blocks;

use App\Core\BaseBlock;

/**
 * Menu class
 */
class Menu extends BaseBlock
{
    /**
    * Rejestracja bloczka
    */
    public function register(): array
    {
        return array(
            'name'              => 'menu',
            'title'             => __('Menu', TEXT_DOMAIN),
            'description'       => __('Menu', TEXT_DOMAIN),
            'category'          => TEXT_DOMAIN,
            'icon'              => 'admin-comments',
        );
    }

    public function renderFront( $block, $content = '', $is_preview = false, $post_id = 0 ): void
    {
        $menu_id = get_field('menu');

        partial('blocks/menu', compact('menu_id', 'is_preview'));
    }
}
