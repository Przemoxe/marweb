<?php
namespace App\Extensions;

class Category
{
    /**
     * __construct
     */
    function initAction()
    {
        add_filter('wp_terms_checklist_args', [$this, 'termsChecklistArgs'], 10, 2);
    }

    public function termsChecklistArgs($args, $post_id)
    {
        $type = get_post_type($post_id);
        $object = get_post_type_object($type);
        $args['checked_ontop'] = data_get($object, 'category_checked_ontop', false);
        return $args;
    }
}
