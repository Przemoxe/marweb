<?php
namespace App\Extensions;

use App\Models\Config;
use App\Models\Transient as TransientModel;

class Transient
{
    private $config;
    private $transient;

    public function __construct()
    {
        $this->config = new Config();
        $this->transient = new TransientModel();
        add_action('updated_option', [$this, 'updatedOptions'], 10, 3);
    }

    function initAction()
    {
        add_filter('acf/update_value', [$this, 'updateValue'], 10, 3);
    }

    public function updatedOptions($option_name, $old_value, $new_value)
    {
        $keys = $this->transient->getKeys();
        $this->transient->forget( $keys );
    }

    public function updateValue($value, $post_id, $field)
    {
        if (substr($post_id, 0, 8 ) === 'options_' || $post_id === 'options')
        {
            $langCodes = icl_get_languages();
            $optionKeys = array_map(function ($lang) {
                return 'cf_options_' . array_get($lang, 'code');
            }, $langCodes);
            
            $this->transient->forget( $optionKeys );
        }
        return $value;
    }

    public function savePostAction($post_id, $post, $update)
    {
        $keys = $this->transient->findByPostId($post_id);
        $this->transient->forget( $keys );
    }

    public function saveTermAction($term_id, $tt_id, $taxonomy)
    {
        $keys = $this->transient->findByTermId($term_id);
        $this->transient->forget( $keys );
    }
}
