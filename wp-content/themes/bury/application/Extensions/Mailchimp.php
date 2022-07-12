<?php
namespace App\Extensions;

class Mailchimp
{
    /**
     * __construct
     */
    function __construct()
    {
        add_filter('mc4wp_admin_form_css_options', [$this, 'adminFormCssOptions']);
    }

    public function adminFormCssOptions($css_options)
    {
        $css_options['theme-bury'] = __('Bury', TEXT_DOMAIN);
        return $css_options;
    }
}
