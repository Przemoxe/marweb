<?php
namespace App\Core\Interfaces;

/**
 * Theme interface
 */
interface ITheme
{
    /**
     * __construct
     */
    public function __construct();

    /**
     * __call
     */
    public function __call($method, $params = []);

    /**
     * Init theme
     */
    public function afterSetupThemeAction();

    /**
     * Enqueue scripts and styles.
     */
    public function registerAssetsAction();

    /**
     * Zainicjowanie zdefiniowanych komponentow
     */
    public function registerComponents();

    /**
     * Akcja w momencie initu wp
     */
    public function initAction();
}
