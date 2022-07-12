<?php

namespace App\Composers\Blocks;

use App\Core\BaseBlock;

/**
 * Slider class
 */
class Slider extends BaseBlock
{
    /**
    * Rejestracja bloczka
    */
    public function register(): array
    {
        return array(
            'name'              => 'slider',
            'title'             => __('Slider', TEXT_DOMAIN),
            'description'       => __('Slider', TEXT_DOMAIN),
            'category'          => TEXT_DOMAIN,
            'icon'              => 'images-alt2'
        );
    }

    public function renderFront( $block, $content = '', $is_preview = false, $post_id = 0 ): void
    {
        $uniqueId = array_get($block, 'id') ?: null;
        $slides = get_field('slides') ?: null;
        $sliderTime = intval(get_field('interval')) * 1000;

        partial('blocks/slider', compact('uniqueId', 'slides', 'sliderTime'));
    }
}
