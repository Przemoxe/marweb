<?php

namespace App\Composers\Blocks;

use App\Core\BaseBlock;

/**
 * Employees class
 */
class Employees extends BaseBlock
{
    /**
    * Rejestracja bloczka
    */
    public function register(): array
    {
        return array(
            'name'              => 'employees',
            'title'             => __('Zarząd - 4 elementy', TEXT_DOMAIN),
            'description'       => __('Zarząd - 4 elementy', TEXT_DOMAIN),
            'category'          => TEXT_DOMAIN,
            'icon'              => 'id',
            'mode'              => 'preview',
            'align'             => false,
        );
    }

    public function renderFront( $block, $content = '', $is_preview = false, $post_id = 0 ): void
    {
        $items = get_field('items');

        partial('blocks/employees', compact('items', 'is_preview'));
    }
}
