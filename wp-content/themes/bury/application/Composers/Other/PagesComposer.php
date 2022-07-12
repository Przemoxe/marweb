<?php
namespace App\Composers\Other;

use App\Core\BasePostType;

/**
* Pages  class
*/
class PagesComposer extends BasePostType
{
    protected $postTypeName = 'pages';
    protected $prefix = 'pages_';

    public function initPostType()
    {
        add_filter('acf/load_field/name=page_header', [$this, 'loadFieldPageHeader']);
    }

    public function loadFieldPageHeader($field)
    {
        foreach ($field['sub_fields'] as &$sub_field)
        {
            if ($sub_field['name'] == 'style')
            {
                $sub_field['choices'] = [
                    'full-width' => __('Zdjęcie w tle (na całą szerokość)', TEXT_DOMAIN),
                    'half-width' => __('Zdjęcie obok treści (na połowę szerokości strony)', TEXT_DOMAIN),
                ];
                continue;
            }
            if ($sub_field['name'] == 'button')
            {
                foreach ($sub_field['sub_fields'] as &$button_field)
                {
                    if ($button_field['name'] == 'icon')
                    {
                        $button_field['choices'] = [
                            'icon-button-arrow-left' => __( 'Strzałka w lewo', TEXT_DOMAIN ),
                            'icon-button-arrow-right' => __( 'Strzałka w prawo', TEXT_DOMAIN ),
                            'icon-button-arrow-up' => __( 'Strzałka w górę', TEXT_DOMAIN ),
                            'icon-button-arrow-down' => __( 'Strzałka w dół', TEXT_DOMAIN ),
                            'icon-button-arrow-download' => __( 'Pobierz', TEXT_DOMAIN ),
                        ];
                    }
                }
                continue;
            }
        }

        return $field;
    }

    public function initAdmin() 
    {
        $post_id = input_get('post') ?? input_post('post_ID');
        if( empty( $post_id ) ) return;
        $template_file = get_post_meta($post_id, '_wp_page_template', true);
        
        if($template_file == 'template-personal-training.php')
        {
            remove_post_type_support('page', 'editor');
        }
    }
}
