<?php
namespace App\Extensions;

class Acf
{
    private $colorOptions;
    private $dateFormat;
    function initAction()
    {
        $this->colorOptions = theme()->getColorsForBlocks();
        $this->dateFormat = get_option( 'date_format' );

        if (!get_defined('CF_SHOW_ACF', true))
        {
            add_filter('acf/settings/show_admin', '__return_false');
        }

        $this->addReadOnlyOption('text');
        $this->addReadOnlyOption('post_object');

        $this->addDisabledOption('text');
        $this->addDisabledOption('post_object');

        add_filter( 'acf/fields/wysiwyg/toolbars' , [$this, 'tinyMceToolbars']);
        add_filter('acf/format_value/type=date_picker', [$this, 'formatDatePickerValue'], 10, 3);
        add_filter('acf/settings/show_admin', function () {
            return defined('SHOW_ACF_MENU') && SHOW_ACF_MENU;
        });
        add_filter('acf/load_field', function ($field) {
            $field['wpml_cf_preferences'] = 3;

            return $field;
        });

        $this->loadDefaultColorsValue();
        $this->loadMenuOptions();
        $this->loadFieldColors();
        $this->loadVideoOptions();
        $this->loadFieldContactForm7();
        $this->loadCategoryOptions();
    }

    public function formatDatePickerValue($value, $post_id, $field)
    {
        $date = \DateTime::createFromFormat(array_get($field, 'return_format', 'Ymd'), $value);
        if (!$date) return null;
        return (object)([
            'date'     => $date,
            'formatted' => date_i18n($this->dateFormat, $date->getTimestamp())
        ]);
    }

    private function loadCategoryOptions()
    {
        add_filter('acf/load_field/key=field_5e5d1b26a8b09', function ($field) {
            $categories = get_categories(['hide_empty' => false]);
            $field['choices'] = array_pluck($categories, 'name', 'term_id');
            return $field;
        });
    }

    private function loadVideoOptions()
    {
        add_filter('acf/load_field/name=video_type', function ($field) {
            $field['choices'] = [
                'file'      => __('Plik', TEXT_DOMAIN),
                'oembed'    => __('oEmbed', TEXT_DOMAIN),
            ];
            return $field;
        });

        add_filter('acf/load_field/name=video_oembed', function ($field) {
            $field['conditional_logic'] = [
                [
                    "field"     => "video_type",
                    "operator"  => "==",
                    "value"     => "oembed"
                ]
            ];
            return $field;
        });

        add_filter('acf/load_field/name=video_file', function ($field) {
            $field['conditional_logic'] = [
                [
                    "field"     => "video_type",
                    "operator"  => "==",
                    "value"     => "file"
                ]
            ];
            return $field;
        });
    }

    private function loadMenuOptions()
    {
        add_filter('acf/load_field/name=menu', function ($field) {
            $field['choices'] = array_pluck(wp_get_nav_menus(), 'name', 'term_id');
            return $field;
        });
    }

    private function loadFieldColors()
    {
        add_filter('acf/load_field/name=color', [$this, 'loadColorOptions']);
        add_filter('acf/load_field/name=background', [$this, 'loadColorOptions']);
        add_filter('acf/load_field/name=color_text', [$this, 'loadColorOptions']);
        add_filter('acf/load_field/name=color_background', [$this, 'loadColorOptions']);
        add_filter('acf/load_field/name=button_color', [$this, 'loadColorOptions']);
        add_filter('acf/load_field/name=button_background', [$this, 'loadColorOptions']);
        add_filter('acf/load_field/name=featured_background', [$this, 'loadColorOptions']);
    }

    private function loadFieldContactForm7()
    {
        $posts = get_posts(array(
            'post_type'     => 'wpcf7_contact_form',
            'numberposts'   => -1,
            'orderby' => 'post_date',
            'order' => 'ASC',
            'post_status' => 'publish'
        ));
        add_filter('acf/load_field/name=cf7_form', function ($field) use ($posts) {
            $field['choices'] = array_pluck($posts, 'post_title', 'ID');
            return $field;
        });
    }

    public function loadColorOptions($field)
    {
        $group = acf_get_field_group( $field['parent'] );
        if (array_get($group, 'location.0.0.value') == 'products_category')
        {
            $field['default_value'] = 'color_5';
        }
        $field['choices'] = $this->colorOptions;
        return $field;
    }

    public function tinyMceToolbars($toolbars)
    {
        $toolbars['Full'][1][] = 'template';

        return $toolbars;
    }

    private function addReadOnlyOption($type)
    {
        add_action("acf/render_field_settings/type={$type}", function ($field) {
            acf_render_field_setting( $field, array(
                'label'      => __('Read Only?','acf'),
                'instructions'  => '',
                'type'      => 'radio',
                'name'      => 'readonly',
                'default_value' => 0,
                'choices'    => array(
                    1        => __("Yes",'acf'),
                    0        => __("No",'acf'),
                ),
                'layout'  =>  'horizontal',
            ));
        });
    }

    private function addDisabledOption($type)
    {
        add_action("acf/render_field_settings/type={$type}", function ($field) {
            acf_render_field_setting( $field, array(
                'label'      => __('Disabled?','acf'),
                'instructions'  => '',
                'type'      => 'radio',
                'name'      => 'disabled',
                'default_value' => 0,
                'choices'    => array(
                    1        => __("Yes",'acf'),
                    0        => __("No",'acf'),
                ),
                'layout'  =>  'horizontal',
            ));
        });
    }

    public function loadDefaultColorsValue()
    {
        add_filter('acf/load_value/name=colors', function ($value, $post_id, $field) {
            if ($post_id === 'options')
            {
                if (false === $value || empty($value))
                {
                    $value = [];
                    $defaultColors = theme()->getDefaultColors();
                    $subFields = array_get($field, 'sub_fields', []);
                    $nameKey = null;
                    $colorKey = null;
                    foreach ($subFields as $subField)
                    {
                        $name = array_get($subField, 'name');
                        $key = array_get($subField, 'key');
                        if (are_empty([$name, $key])) continue;

                        if ($name == 'name')
                        {
                            $nameKey = $key;
                            continue;
                        }
                        if ($name == 'color')
                        {
                            $colorKey = $key;
                            continue;
                        }
                    }
                    if (!are_empty([$nameKey, $colorKey]))
                    {
                        foreach ($defaultColors as $color)
                        {
                            $name = array_get($color, 'name');
                            $color = array_get($color, 'color');
                            $value[] = [
                                $nameKey => $name,
                                $colorKey => $color,
                            ];
                        }
                    }
                }
            }
            return $value;
        }, 10, 3);
    }
}
