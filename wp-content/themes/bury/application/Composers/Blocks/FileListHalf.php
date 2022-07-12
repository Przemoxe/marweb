<?php

namespace App\Composers\Blocks;

use App\Core\BaseBlock;

/**
 * FileListHalf class
 */
class FileListHalf extends BaseBlock
{
    /**
    * Rejestracja bloczka
    */
    public function register(): array
    {
        return array(
            'name'              => 'file-list-half',
            'title'             => __('Pliki do pobrania - połowa', TEXT_DOMAIN),
            'description'       => __('Pliki do pobrania - połowa', TEXT_DOMAIN),
            'category'          => TEXT_DOMAIN,
            'icon'              => 'arrow-down-alt'
        );
    }

    public function renderFront( $block, $content = '', $is_preview = false, $post_id = 0 ): void
    {
        $files = get_field('files') ?: null;
        $title = get_field('title');
        $description = get_field('description');
        $background = theme()->getColor(get_field('background')) ?: null;
        $backgroundStyle = '';
        if (!empty($background))
        {
            $backgroundStyle = 'style="background-color: '.$background.'"';
        }

        partial('blocks/files-half', compact('files', 'title', 'description', 'backgroundStyle'));
    }
}
