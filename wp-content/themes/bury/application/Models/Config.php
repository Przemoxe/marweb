<?php
namespace App\Models;

use App\Models\Transient;

/**
 * Config class
 */
class Config
{
    private $transient;
    private $options;
    private $pageOptions;
    private $termOptions;

    const OPTION_PAGE_PREFIX = 'cf_page_options_';
    const OPTION_TERM_PREFIX = 'cf_term_options_';
    const OPTION_PREFIX = 'cf_options_';

    public function __construct()
    {
        $this->transient = new Transient();
        $this->initGlobalOptions();
        $this->initPageOptions();
        $this->initTermOptions();
    }

    private function initGlobalOptions()
    {
        if (is_admin()) return;

        $this->options = $this->transient->remember(self::OPTION_PREFIX . ICL_LANGUAGE_CODE, WEEK_IN_SECONDS, function () {
            return get_fields('options');
        });
    }

    private function initPageOptions()
    {
        if (is_admin()) return;
        global $post;
        if (empty($post)) return;

        $this->pageOptions[$post->ID] = $this->transient->remember(self::OPTION_PAGE_PREFIX . ICL_LANGUAGE_CODE . '_' . $post->ID, WEEK_IN_SECONDS, function () use ($post) {
            return get_fields( $post->ID );
        });
    }

    private function initTermOptions()
    {
        if (is_admin()) return;
        $object = get_queried_object();
        if (! \is_a($object, \WP_Term::class)) return;
        if (empty($object)) return;

        $this->termOptions[$object->term_id] = $this->transient->remember( self::OPTION_TERM_PREFIX . ICL_LANGUAGE_CODE . '_' . $object->ID, WEEK_IN_SECONDS, function () use ($object) {
            return get_fields( 'term_' . $object->term_id );
        });
    }

    public function getAllOptions()
    {
        return $this->options;
    }

    public function options()
    {
        $config = $this->getAllOptions();
        $headerOptions = array_get($config, 'page_header');

        $options = [
            'google_maps_api_key' => array_get($config, 'google_maps_api_key', false),
            'link_block' => array_get($config, 'link_block', []),
            'link_aplikuj_do_bazy' => array_get($config, 'link_aplikuj_do_bazy', []),
            'link_aplikuj_na_staz' => array_get($config, 'link_aplikuj_na_staz', []),
            'link_aplikuj_na_produkcji' => array_get($config, 'link_aplikuj_na_produkcji', []),
            'not_found' => [
                'title' => array_get($config, 'not_found_title'),
                'parallax_title' => array_get($config, 'not_found_parallax_title'),
                'content' => array_get($config, 'not_found_content'),
                'link' => array_get($config, 'not_found_link'),
                'icon' => array_get($config, 'not_found_icon'),
            ],
            'logo' => [
                'header' => array_get($config, 'logo.header'),
                'footer' => array_get($config, 'logo.footer'),
            ],
            'color' => [
                'text'      => array_get($config, 'color_text'),
                'background' => array_get($config, 'color_background'),
            ],
            'header' => [
                'show' => array_get($headerOptions, 'show', false),
                'show_title' => array_get($headerOptions, 'show_title', false),
                'show_second_title' => array_get($headerOptions, 'show_second_title', false),
                'show_image' => array_get($headerOptions, 'show_image', false),
                'second_title' => array_get($headerOptions, 'second_title'),
                'description' => array_get($headerOptions, 'description', false),
                'button' => array_get($headerOptions, 'button', false),
                'view' => array_get($headerOptions, 'view', 'full-width'),
                'style' => 'dark'
            ],
            'footer' => [
                'google_play' => array_get($config, 'footer.google_play'),
                'apple_app_store' => array_get($config, 'footer.apple_app_store'),
                'use_packages_images' => array_get($config, 'footer.use_packages_images', []),
                'logo' => array_get($config, 'footer.logo'),
                'title' => array_get($config, 'title'),
                'addres1' => array_get($config, 'addres1'),
                'addres2' => array_get($config, 'addres2'),
                'e_mail' => array_get($config, 'e_mail'),
                'phone_number' => array_get($config, 'phone_number'),
            ],
            'script' => [
                'head_script' => array_get($config, 'scripts.head_script'),
                'body_start_script' => array_get($config, 'scripts.body_start_script'),
                'body_end_script' => array_get($config, 'scripts.body_end_script'),
            ],
            'social_media' => [
                'profiles' => [
                    'instagram' => array_get($config, 'instagram_profile'),
                    'youtube' => array_get($config, 'youtube_profile'),
                    'twitter' => array_get($config, 'twitter_profile'),
                    'facebook' => array_get($config, 'facebook_profile'),
                    'linkedin' => array_get($config, 'linkedin_profile'),
                ],
                'share' => [
                    'instagram' => array_get($config, 'show_instagram_share'),
                    'youtube' => array_get($config, 'show_youtube_share'),
                    'twitter' => array_get($config, 'show_twitter_share'),
                    'facebook' => array_get($config, 'show_facebook_share'),
                    'linkedin' => array_get($config, 'show_linkedin_share'),
                ],
            ],
            'sites' => [
                'post' => [
                    'header' => [
                        'show' => array_get($config, 'header_posts.show', false),
                        'featured_media' => array_get($config, 'header_posts.featured_media')
                    ]
                ],
                'fairs' => [
                    'header' => [
                        'show' => array_get($config, 'header_fairs.show', false),
                        'featured_media' => array_get($config, 'header_fairs.featured_media')
                    ]
                ],
                'job_offers' => [
                    'header' => [
                        'show' => array_get($config, 'header_job_offers.show', false),
                        'featured_media' => array_get($config, 'header_job_offers.featured_media')
                    ]
                ],
            ],
            'cookie_info' => [
                'content' => array_get($config, 'cookies_info_content'),
                'buttons' => [
                    [
                        'url' => array_get($config, 'cookies_info_url_1'),
                        'label' => array_get($config, 'cookies_info_label_1')
                    ],
                    [
                        'label' => array_get($config, 'cookies_info_label_2')
                    ]
                ]
            ]
        ];

        return array_to_object($options);
    }

    public function getAllPageOptions($post_id = null)
    {
        if (empty($post_id))
        {

            global $post;
            if (empty($post)) return [];
            $post_id = $post->ID;
        }
        $options = array_get($this->pageOptions, $post_id, false);
        if (false === $options)
        {
            $options = $this->pageOptions[$post_id] = $this->transient->remember( self::OPTION_PAGE_PREFIX . ICL_LANGUAGE_CODE . '_' . $post_id, WEEK_IN_SECONDS, function () use ($post_id) {
                return get_fields( $post_id );
            });
        }
        return $options;
    }

    public function pageOptions()
    {
        $config = $this->getAllPageOptions();

        $options = [
            'header' => [
                'show' => array_get($config, 'header.show', false),
                'featured_media' => array_get($config, 'header.featured_media'),
            ],
            'script' => [
                'head_script' => array_get($config, 'scripts.head_script'),
                'body_start_script' => array_get($config, 'scripts.body_start_script'),
                'body_end_script' => array_get($config, 'scripts.body_end_script'),
            ]
        ];

        return array_to_object($options);
    }

    public function headerOptions()
    {
        $options = null;
        $header = null;
        if (is_archive() || is_single())
        {
            $queriedObject = get_queried_object();
            $post_type = null;

            if ($queriedObject instanceof \WP_Term && ends_with($queriedObject->taxonomy, '_tag'))
            {
                $post_type = get_post_type_from_taxonomy($queriedObject->taxonomy);
            }
            elseif($queriedObject instanceof \WP_Post_Type)
            {
                $post_type = $queriedObject->name;
            }
            elseif($queriedObject instanceof \WP_Post)
            {
                $post_type = $queriedObject->post_type;
            }
            if (empty($post_type)) return;

            $model = theme()->getModelByPostType($post_type);
            if (empty($model)) return;
            $options = $model->getOptions();
            if (empty($options)) return;
            $header = is_single() ? $options->header->post : $options->header->archive;
        }
        else
        {
            $options = theme()->config()->pageOptions();
            $header = $options->header;
            if (empty($options)) return;
        }
        return $header;
    }

    public function customPostOptions($postType)
    {
        $config = $this->getAllOptions();
        return array_get($config, 'page_' . $postType, []);
    }

    public function getAllTermOptions($term_id)
    {
        $options = array_get($this->termOptions, $term_id, false);
        if (false === $options)
        {
            $options = $this->termOptions[$term_id] = $this->transient->remember( self::OPTION_TERM_PREFIX . $term_id, WEEK_IN_SECONDS, function () use ($term_id) {
                return get_fields( 'term_' . $term_id );
            });
        }
        return $options;
    }

    public function getLogo($type = 'header')
    {
        $id = $this->options()->logo->$type;
        print_svg($id);
    }

    public function getLogoSrc($type = 'header')
    {

        $id = $this->options()->logo->$type;
        return wp_get_attachment_image_url($id);
    }

    public function getWpbakeryLogo()
    {
        return get_template_directory_uri() . '/assets/dist/images/logo-wpbakery.png';
    }
}
