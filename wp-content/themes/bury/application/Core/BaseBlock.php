<?php
namespace App\Core;

use App\Core\Interfaces\IBlock;

/**
* Bazowe funkcjonalnosci szablonu
*/
abstract class BaseBlock implements IBlock
{
    public function initAction()
    {
        $args = $this->register();
        $args['render_callback'] = [$this, 'renderCallback'];
        acf_register_block($args);
    }

    public function renderCallback( $block, $content = '', $is_preview = false, $post_id = 0 )
    {
        return $this->renderFront($block, $content, $is_preview, $post_id);
    }
}
