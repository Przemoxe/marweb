<?php
namespace App\Core;

use App\Core\Interfaces\IOptionsPage;

/**
*
*/
abstract class BaseOptionsPage implements IOptionsPage
{
    /**
     * __construct
     */
    function __construct()
    {
        add_action( 'init', [$this, 'initOptionsPage']);
    }
}
