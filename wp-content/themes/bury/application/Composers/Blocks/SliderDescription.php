<?php

namespace App\Composers\Blocks;

use App\Core\BaseBlock;

/**
 * SliderDescription class
 */
class SliderDescription extends BaseBlock
{
    /**
    * Rejestracja bloczka
    */
    public function register(): array
    {
        return array(
            'name'              => 'slider-description',
            'title'             => __('Slider - opis', TEXT_DOMAIN),
            'description'       => __('Slider - opis', TEXT_DOMAIN),
            'category'          => TEXT_DOMAIN,
            'icon'              => 'admin-comments'
        );
    }

    public function renderFront( $block, $content = '', $is_preview = false, $post_id = 0 ): void
    {
        $items = get_field('items') ?: null;
        if (is_array($items))
        {
            $items = array_filter($items, function ($item) {
                return !empty(array_get($item, 'question')) && !empty(array_get($item, 'answer'));
            });
        }

        partial('blocks/slider-description', compact('items'));
    }
}
