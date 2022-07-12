<?php

namespace App\Composers\Blocks;

use App\Core\BaseBlock;

/**
 * FileListFull class
 */
class FileListFull extends BaseBlock
{
    /**
    * Rejestracja bloczka
    */
    public function register(): array
    {
        return array(
            'name'              => 'file-list-full',
            'title'             => __('Pliki do pobrania - pełne', TEXT_DOMAIN),
            'description'       => __('Pliki do pobrania - pełne', TEXT_DOMAIN),
            'category'          => TEXT_DOMAIN,
            'icon'              => 'arrow-down-alt'
        );
    }

    public function renderFront( $block, $content = '', $is_preview = false, $post_id = 0 ): void
    {
        $files = get_field('files') ?: null;
        $background = theme()->getColor(get_field('background')) ?: null;
        $backgroundStyle = '';
        if (!empty($background))
        {
            $backgroundStyle = 'style="background-color: '.$background.'"';
        }

        partial('blocks/files-full', compact('files', 'backgroundStyle'));
    }
}
