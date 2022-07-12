<?php
namespace App\Core\Interfaces;

/**
 * Block interface
 */
interface IBlock
{
    public function register() : array;

    /**
     * Function to front view of block
     */
    public function renderFront( $block, $content = '', $is_preview = false, $post_id = 0 ): void;
}
