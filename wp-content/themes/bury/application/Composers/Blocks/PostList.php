<?php

namespace App\Composers\Blocks;

use App\Core\BaseBlock;

/**
 * PostList class
 */
class PostList extends BaseBlock
{
    /**
    * Rejestracja bloczka
    */
    public function register(): array
    {
        return array(
            'name'              => 'post-list',
            'title'             => __('Wpisy', TEXT_DOMAIN),
            'description'       => __('Wpisy', TEXT_DOMAIN),
            'category'          => TEXT_DOMAIN,
            'icon'              => 'admin-comments',
            'mode'              => 'preview',
            'align'             => false,
        );
    }

    public function renderFront( $block, $content = '', $is_preview = false, $post_id = 0 ): void
    {
        $title = get_field('header_title');
        $link = get_field('header_link');
        $category = get_field('category');
        $limit = get_field('limit');

        $filters = [];
        if (!empty($category))
        {
            $filters['category'] = $category;
        }

        $items = theme()->postModel()->getAllPublished($filters, $limit)->posts;
        partial('blocks/post-list', compact('items', 'title', 'link', 'is_preview'));
    }
}
