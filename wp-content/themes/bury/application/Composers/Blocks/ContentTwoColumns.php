<?php

namespace App\Composers\Blocks;

use App\Core\BaseBlock;

/**
 * ContentTwoColumns class
 */
class ContentTwoColumns extends BaseBlock
{
    /**
    * Rejestracja bloczka
    */
    public function register(): array
    {
        return array(
            'name'              => 'content-two-columns',
            'title'             => __('Blok opisowy (dwie kolumny)', TEXT_DOMAIN),
            'description'       => __('Blok opisowy (dwie kolumny)', TEXT_DOMAIN),
            'category'          => TEXT_DOMAIN,
            'icon'              => 'screenoptions'
        );
    }

    public function renderFront( $block, $content = '', $is_preview = false, $post_id = 0 ): void
    {
        $title = get_field('title');
        $subtitle = get_field('subtitle');
        $contentLeft = get_field('content_left');
        $contentRight = get_field('content_right');
        $image = get_field('image');

        if (!empty($image))
        {
            $image = wp_get_attachment_url($image);
        }

        partial('blocks/content-two-columns', compact('title', 'subtitle', 'contentLeft', 'contentRight', 'image'));
    }
}
