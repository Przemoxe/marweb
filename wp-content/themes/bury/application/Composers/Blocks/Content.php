<?php

namespace App\Composers\Blocks;

use App\Core\BaseBlock;

/**
 * Content class
 */
class Content extends BaseBlock
{
    /**
    * Rejestracja bloczka
    */
    public function register(): array
    {
        return array(
            'name'              => 'content',
            'title'             => __('Blok opisowy', TEXT_DOMAIN),
            'description'       => __('Blok opisowy', TEXT_DOMAIN),
            'category'          => TEXT_DOMAIN,
            'icon'              => 'screenoptions'
        );
    }

    public function renderFront( $block, $content = '', $is_preview = false, $post_id = 0 ): void
    {
        $type = get_field('content_display');
        $title = get_field('title');
        $subtitle = get_field('subtitle');
        $content = get_field('content');
        $image = get_field('image');
        $button = get_field('button');
        $alerts = get_field('alerts');
        $html = get_field('html');
        $rightColumnType = get_field('right_column_type') ?? 'image';

        if (!empty($image) && $rightColumnType === 'image')
        {
            $image = wp_get_attachment_url($image);
        }
        else
        {
            $image = '';
        }

        if ($rightColumnType === 'html' && $type === 'image_right')
        {
            $type = 'html_right';
        }

        switch ($type) 
        {
            case 'html_right':
                $rowClass = 'flex-row-reverse';
                $class = 'content-html-right';
                $containerOpen = '<div class="container"><div class="row">';
                $containerClose = '</div></div>';
                partial('blocks/content-html', compact('title', 'subtitle', 'content', 'html', 'button', 'alerts', 'rowClass', 'class', 'containerOpen', 'containerClose'));
                break;
            case 'image_left':
                $rowClass = '';
                $class = 'content-image-left';
                $containerOpen = '';
                $containerClose = '';
                partial('blocks/content-image', compact('title', 'subtitle', 'content', 'image', 'button', 'alerts', 'rowClass', 'class', 'containerOpen', 'containerClose'));
                break;
            case 'image_right':
                $rowClass = 'flex-row-reverse';
                $class = 'content-image-right';
                $containerOpen = '<div class="container"><div class="row">';
                $containerClose = '</div></div>';
                partial('blocks/content-image', compact('title', 'subtitle', 'content', 'image', 'button', 'alerts', 'rowClass', 'class', 'containerOpen', 'containerClose'));
                break;
            case 'image_top':
                $rowClass = '';
                $class = 'content-image-top';
                $containerOpen = '';
                $containerClose = '';
                partial('blocks/content-image-top', compact('title', 'subtitle', 'content', 'image', 'button', 'alerts', 'rowClass', 'class', 'containerOpen', 'containerClose'));
                break;
        }
    }
}
