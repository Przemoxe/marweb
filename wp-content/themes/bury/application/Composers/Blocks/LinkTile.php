<?php

namespace App\Composers\Blocks;

use App\Core\BaseBlock;

/**
 * LinkTile class
 */
class LinkTile extends BaseBlock
{
    /**
    * Rejestracja bloczka
    */
    public function register(): array
    {
        return array(
            'name'              => 'link-tile',
            'title'             => __('Kafelek linkujący', TEXT_DOMAIN),
            'description'       => __('Kafelek linkujący', TEXT_DOMAIN),
            'category'          => TEXT_DOMAIN,
            'icon'              => 'grid-view'
        );
    }

    public function renderFront( $block, $content = '', $is_preview = false, $post_id = 0 ): void
    {
        $title = get_field('title');
        $description = get_field('description');
        $link = get_field('link');

        $colorBackground = theme()->getColor(get_field('color_background'));
        $colorText = theme()->getColor(get_field('color_text'));
        $style = 'style="';

        if (!empty($colorBackground))
        {
            $style .= 'background-color: '.$colorBackground .';';
        }
        if (!empty($colorText))
        {
            $style .= 'color: '.$colorText.';';
        }
        $style .= '"';

        partial('blocks/link-tile', compact('title', 'description', 'link', 'style'));
    }
}
