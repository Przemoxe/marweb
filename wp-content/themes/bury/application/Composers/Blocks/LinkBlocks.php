<?php

namespace App\Composers\Blocks;

use App\Core\BaseBlock;

/**
 * LinkBlocks class
 */
class LinkBlocks extends BaseBlock
{
    /**
    * Rejestracja bloczka
    */
    public function register(): array
    {
        return array(
            'name'              => 'link-blocks',
            'title'             => __('Bloki linkujące', TEXT_DOMAIN),
            'description'       => __('Bloki linkujące', TEXT_DOMAIN),
            'category'          => TEXT_DOMAIN,
            'icon'              => 'grid-view'
        );
    }

    public function renderFront( $block, $content = '', $is_preview = false, $post_id = 0 ): void
    {
        $items = get_field('items') ?: null;
        $background = theme()->getColor(get_field('background'), '#ffffff');
        $backgroundStyle = '';
        if (!empty($background))
        {
            $backgroundStyle = 'style="background-color: '.$background.'"';
        }

        partial('blocks/link-blocks', compact('items', 'backgroundStyle'));
    }
}
