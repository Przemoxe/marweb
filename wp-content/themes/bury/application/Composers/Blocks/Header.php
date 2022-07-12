<?php

namespace App\Composers\Blocks;

use App\Core\BaseBlock;

/**
 * Header class
 */
class Header extends BaseBlock
{
    /**
    * Rejestracja bloczka
    */
    public function register(): array
    {
        return array(
            'name'              => 'header',
            'title'             => __('Nagłówek', TEXT_DOMAIN),
            'description'       => __('Nagłówek', TEXT_DOMAIN),
            'category'          => TEXT_DOMAIN,
            'icon'              => 'editor-ltr'
        );
    }

    public function renderFront( $block, $content = '', $is_preview = false, $post_id = 0 ): void
    {
        $title = get_field('title');
        $link = get_field('link');

        partial('blocks/header', compact('title', 'link'));
    }
}
