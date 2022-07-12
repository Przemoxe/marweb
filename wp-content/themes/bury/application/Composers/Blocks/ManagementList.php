<?php

namespace App\Composers\Blocks;

use App\Core\BaseBlock;

/**
 * ManagementList class
 */
class ManagementList extends BaseBlock
{
    /**
    * Rejestracja bloczka
    */
    public function register(): array
    {
        return array(
            'name'              => 'management-list',
            'title'             => __('Lista zarządu', TEXT_DOMAIN),
            'description'       => __('Lista zarządu', TEXT_DOMAIN),
            'category'          => TEXT_DOMAIN,
            'icon'              => 'id-alt'
        );
    }

    public function renderFront( $block, $content = '', $is_preview = false, $post_id = 0 ): void
    {
        $title = get_field('title');
        $description = get_field('description');
        $management = theme()->managementModel();
        $items = $management->getPositionsWithPosts();
        partial('blocks/management-list', compact('items', 'title', 'description'));
    }
}
