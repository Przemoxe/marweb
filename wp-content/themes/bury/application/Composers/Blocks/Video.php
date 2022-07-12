<?php

namespace App\Composers\Blocks;

use App\Core\BaseBlock;

/**
 * Video class
 */
class Video extends BaseBlock
{
    /**
    * Rejestracja bloczka
    */
    public function register(): array
    {
        return array(
            'name'              => 'video',
            'title'             => __('Film', TEXT_DOMAIN),
            'description'       => __('Film', TEXT_DOMAIN),
            'category'          => TEXT_DOMAIN,
            'icon'              => 'admin-comments',
        );
    }

    public function renderFront( $block, $content = '', $is_preview = false, $post_id = 0 ): void
    {
        $type = get_field('video_type');
        $featured_image = wp_get_attachment_image_url(get_field('featured_image'), 'full');
        switch ($type) {
            case 'file':
                $file = wp_get_attachment_url(get_field('video_file'));
                if (empty($file))
                {
                    return;
                }
                partial('blocks/video-file', compact('featured_image', 'file'));
                return;
            case 'oembed':
                $oembed = get_field('video_oembed');
                if (empty($oembed))
                {
                    return;
                }
                if (!empty($featured_image))
                {
                    $oembed = str_replace('<iframe', '<lazyiframe class="d-none" ', $oembed);
                    $oembed = str_replace('iframe>', 'lazyiframe>', $oembed);
                }
                partial('blocks/video-oembed', compact('featured_image', 'oembed'));
                return;
            default:
                return;
        }
    }
}
