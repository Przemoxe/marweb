<?php

namespace App\Composers\Blocks;

use App\Core\BaseBlock;

/**
 * ManagementSlider class
 */
class ManagementSlider extends BaseBlock
{
    /**
    * Rejestracja bloczka
    */
    public function register(): array
    {
        return array(
            'name'              => 'management-slider',
            'title'             => __('Zarząd slider', TEXT_DOMAIN),
            'description'       => __('Zarząd slider', TEXT_DOMAIN),
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

        partial('blocks/management-list', compact('items'));
    }
}
