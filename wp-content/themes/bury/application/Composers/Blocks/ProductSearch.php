<?php

namespace App\Composers\Blocks;

use App\Core\BaseBlock;

/**
 * Search class
 */
class ProductSearch extends BaseBlock
{
    /**
    * Rejestracja bloczka
    */
    public function register(): array
    {
        return array(
            'name'              => 'product-search',
            'title'             => __('Wyszukiwarka produktów', TEXT_DOMAIN),
            'description'       => __('Wyszukiwarka produktów', TEXT_DOMAIN),
            'category'          => TEXT_DOMAIN,
            'icon'              => 'search',
            'mode'              => 'preview'
        );
    }

    public function renderFront( $block, $content = '', $is_preview = false, $post_id = 0 ): void
    {
        partial('blocks/product-search', ['is_preview' => $is_preview]);
    }
}
