<?php
namespace App\Core\Interfaces;

/**
 * Options page interface
 */
interface IOptionsPage
{
    /**
     * __construct
     */
    public function __construct();

    /**
     * Function to init option page metaboxes
     */
    public function initOptionsPage();
}
