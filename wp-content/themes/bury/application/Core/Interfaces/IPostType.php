<?php
namespace App\Core\Interfaces;

/**
 * Post type interface
 */
interface IPostType
{
    /**
     * __construct
     */
    public function __construct();

    /**
     * Function to init post type
     */
    public function initPostType();
    public function initAdmin();
}
