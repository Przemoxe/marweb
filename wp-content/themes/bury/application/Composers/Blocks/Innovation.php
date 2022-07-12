<?php

namespace App\Composers\Blocks;

use App\Core\BaseBlock;

/**
 * Innovation class
 */
class Innovation extends BaseBlock
{
    /**
    * Rejestracja bloczka
    */
    public function register(): array
    {
        return array(
            'name'              => 'innovation',
            'title'             => __('Blok innowacji', TEXT_DOMAIN),
            'description'       => __('Blok innowacji', TEXT_DOMAIN),
            'category'          => TEXT_DOMAIN,
            'icon'              => 'tickets-alt'
        );
    }

    public function renderFront( $block, $content = '', $is_preview = false, $post_id = 0 ): void
    {
        $uniqueId = array_get($block, 'id') ?: null;
        $title = get_field('title');
        $description = get_field('description');
        $items = get_field('items') ?: null;

        partial('blocks/innovation', compact('uniqueId', 'items', 'title', 'description'));
    }
}
