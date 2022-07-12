<?php

namespace App\Composers\Blocks;

use App\Core\BaseBlock;

/**
 * HeaderCareer class
 */
class HeaderCareer extends BaseBlock
{
    /**
    * Rejestracja bloczka
    */
    public function register(): array
    {
        return array(
            'name'              => 'header-career',
            'title'             => __('Nagłówek kariera', TEXT_DOMAIN),
            'description'       => __('Nagłówek kariera', TEXT_DOMAIN),
            'category'          => TEXT_DOMAIN,
            'icon'              => 'id-alt'
        );
    }

    public function renderFront( $block, $content = '', $is_preview = false, $post_id = 0 ): void
    {
        $title = get_field('title');
        $content = get_field('content');
        $featured_media_id = get_field('featured_media');
        $link = get_field('link');

        $featured_media = null;
        if (!empty($featured_media_id))
        {
            $featured_media = wp_get_attachment_url($featured_media_id);
        }

        partial('blocks/header-career', compact('title', 'content', 'featured_media', 'link'));
    }
}
