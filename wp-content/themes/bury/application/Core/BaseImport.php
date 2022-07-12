<?php
namespace App\Core;

use GuzzleHttp\Client;

/**
*
*/
abstract class BaseImport
{
    private $data = [];

    public function set($name, $value = null)
    {
        array_set($this->data, $name, $value);
    }

    public function get($name, $default = null)
    {
        return array_get($this->data, $name, $default);
    }

    public function getApiBaseDir()
    {
        return 'cf_api';
    }

    protected function getApiResourcesDir()
    {
        return WP_CONTENT_DIR . DIRECTORY_SEPARATOR . 'cf_api';
    }

    protected function getApiResourcesUrl()
    {
        return WP_CONTENT_URL . '/cf_api';
    }

    public function downloadFile($url, $path)
    {
        $client = new Client([
            'verify' => false
        ]);
        $client->request('GET', $url, ['sink' => $path]);
    }
}
