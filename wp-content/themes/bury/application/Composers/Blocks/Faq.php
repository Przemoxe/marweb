<?php

namespace App\Composers\Blocks;

use App\Core\BaseBlock;

/**
 * Faq class
 */
class Faq extends BaseBlock
{
    /**
    * Rejestracja bloczka
    */
    public function register(): array
    {
        return array(
            'name'              => 'faq',
            'title'             => __('FAQ', TEXT_DOMAIN),
            'description'       => __('FAQ', TEXT_DOMAIN),
            'category'          => TEXT_DOMAIN,
            'icon'              => 'list-view'
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

        partial('blocks/faq', compact('items'));
    }
}
