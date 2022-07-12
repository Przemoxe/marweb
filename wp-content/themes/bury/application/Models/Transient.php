<?php
namespace App\Models;

/**
 * Transient class
 */
class Transient
{
    public function findByPostId($post_id)
    {
        global $wpdb;
        $optionName = 'transient_cf_page_options_' . ICL_LANGUAGE_CODE . '_' . $post_id;
        $sql = "SELECT `option_name` AS `name`, `option_value` AS `value`
                FROM  $wpdb->options
                WHERE `option_name` LIKE '%".$optionName."'
                ORDER BY `option_name`";

        $results = $wpdb->get_results( $sql );
        $keys = [];
        foreach($results as $result)
        {
            $keys[] = str_replace('_transient_', '', $result->name);
        }
        return $keys;
    }

    public function findByTermId($term_id)
    {
        global $wpdb;
        $optionName = 'transient_cf_term_options_' . ICL_LANGUAGE_CODE . '_' . $term_id;
        $sql = "SELECT `option_name` AS `name`, `option_value` AS `value`
                FROM  $wpdb->options
                WHERE `option_name` LIKE '%".$optionName."'
                ORDER BY `option_name`";

        $results = $wpdb->get_results( $sql );
        $keys = [];
        foreach($results as $result)
        {
            $keys[] = str_replace('_transient_', '', $result->name);
        }
        return $keys;
    }

    public function getKeys()
    {
        $keys = wp_cache_get( 'cf_transient_keys' );
        if ( false === $keys ) 
        {
            global $wpdb;
            $sql = "SELECT `option_name` AS `name`, `option_value` AS `value`
                    FROM  $wpdb->options
                    WHERE `option_name` LIKE '%transient_cf_%'
                    ORDER BY `option_name`";

            $results = $wpdb->get_results( $sql );
            $keys = [];
            foreach($results as $result)
            {
                $keys[] = str_replace('_transient_', '', $result->name);
            }
            wp_cache_set( 'cf_transient_keys', $keys );
        }
        return $keys;
    }

    public function remember($key, $seconds, $callback)
    {
        $value = get_transient( $key );
        if ( false ===  $value || (defined('TRANSIENT_CACHE_DISABLED') && TRANSIENT_CACHE_DISABLED)) 
        {
            $value = $callback();
            set_transient( $key, $value, $seconds );
        }
        return $value;
    }

    public function forget($transients)
    {
        if (!is_array($transients))
        {
            $transients = [$transients];
        }
        
        foreach($transients as $transient)
        {
            delete_transient( $transient );
        }
    }
}
