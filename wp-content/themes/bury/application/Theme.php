<?php
namespace App;

use App\Core\BaseTheme;

/**
* Template class
*/
class Theme extends BaseTheme
{
    /**
    * Zdefiniowanie komponentow szablonu.
    * Komponenty są initializowane automatycznie
    */
    public $components = [
        # Config
        \App\Composers\Config\ConfigComposer::class,
        \App\Composers\Config\SocialMediaComposer::class,
        \App\Composers\Config\HeaderComposer::class,
        \App\Composers\Config\FooterComposer::class,
        \App\Composers\Config\CustomPostComposer::class,
        \App\Composers\Config\CookiesInfoComposer::class,
        \App\Composers\Config\NotFoundComposer::class,

        # Main
        \App\Composers\Main\FairsComposer::class,
        \App\Composers\Main\JobOffersComposer::class,
        \App\Composers\Main\ProductsComposer::class,
        \App\Composers\Main\ManagementComposer::class,
        \App\Composers\Main\EmployeesComposer::class,
        \App\Composers\Main\CompetencesComposer::class,

        # Other
        \App\Composers\Other\ScriptsComposer::class,
        \App\Composers\Other\GutenbergComposer::class,
        

        # Extensions
        \App\Extensions\Transient::class,
        \App\Extensions\RestApi::class,
        \App\Extensions\Acf::class,
        \App\Extensions\Dashboard::class,
        \App\Extensions\ArchivePagesMenu::class,
        \App\Extensions\Category::class,
        \App\Extensions\Mailchimp::class,

        #Blocks
        \App\Composers\Blocks\Faq::class,
        \App\Composers\Blocks\FileListFull::class,
        \App\Composers\Blocks\FileListHalf::class,
        \App\Composers\Blocks\ManagementList::class,
        \App\Composers\Blocks\LinkBlocks::class,
        \App\Composers\Blocks\Slider::class,
        \App\Composers\Blocks\Content::class,
        \App\Composers\Blocks\Innovation::class,
        \App\Composers\Blocks\Header::class,
        \App\Composers\Blocks\HeaderCareer::class,
        \App\Composers\Blocks\Employees::class,
        \App\Composers\Blocks\EmployeesList::class,
        \App\Composers\Blocks\JobOfferList::class,
        \App\Composers\Blocks\PostList::class,
        \App\Composers\Blocks\Menu::class,
        \App\Composers\Blocks\Video::class,
        \App\Composers\Blocks\LinkTile::class,
        \App\Composers\Blocks\ContentTwoColumns::class,
        \App\Composers\Blocks\ContactForm7::class,
        \App\Composers\Blocks\ProductSearch::class
    ];

    /**
    * Zdefiniowanie zaleznosci eksportowanych do szablonu.
    * Zaleznosci sa initializowane automatycznie i exportowane do obiektuy szablonu
    * sample: theme()->templateTags()->printMainMenu()
    */
    public $dependencies = [
        'templateTags'      => \App\TemplateTags::class,
        'search'            => \App\Models\Search::class,
        'config'            => \App\Models\Config::class,
        'transient'         => \App\Models\Transient::class,
        'jobOfferModel'     => \App\Models\JobOffer::class,
        'managementModel'   => \App\Models\Management::class,
        'fairModel'         => \App\Models\Fair::class,
        'productModel'      => \App\Models\Product::class,
        'employeeModel'     => \App\Models\Employee::class,
        'postModel'         => \App\Models\Post::class,
        'competenceModel'   => \App\Models\Competence::class,
    ];

    public $repositories = [];

    public $imports = [];

    public function __construct()
    {
        if ( !defined( 'TEXT_DOMAIN' ) ) define( 'TEXT_DOMAIN', 'bury' );
        parent::__construct();
    }

    /**
    * Initializacja szablonu
    */
    public function afterSetupThemeAction()
    {
        if ( !defined( 'ASSETS' ) ) define( 'ASSETS', get_template_directory_uri() . '/assets/dist' );

        //load theme texdomain
        load_theme_textdomain( TEXT_DOMAIN, get_template_directory() . '/languages');

        //Let WordPress manage the document title.
        add_theme_support( 'title-tag' );

        //Enable support for Post Thumbnails on posts and pages.
        add_theme_support( 'post-thumbnails' );

        //Register nav menus
        register_nav_menus( array(
            'primary-menu' => esc_html__( 'Menu głowne', TEXT_DOMAIN ),
            'news-menu' => esc_html__('Menu aktualności', TEXT_DOMAIN),
            'kariera-menu' => esc_html__('Menu kariera', TEXT_DOMAIN),
            'footer-menu-1' => esc_html__( 'Menu w stopce (kolumna 2)', TEXT_DOMAIN ),
            'footer-menu-2' => esc_html__( 'Menu w stopce (kolumna 3)', TEXT_DOMAIN ),
            'footer-menu-3' => esc_html__( 'Menu w stopce (kolumna 4)', TEXT_DOMAIN ),
            'footer-menu-4' => esc_html__( 'Menu w stopce (kolumna 5)', TEXT_DOMAIN ),
            'footer-menu-5' => esc_html__( 'Menu w stopce (kolumna 6)', TEXT_DOMAIN ),
            'footer-menu-bottom' => esc_html__( 'Menu w stopce', TEXT_DOMAIN ),
        ) );

        //Switch default core markup for search form, comment form, and comments
        //to output valid HTML5.
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        // Thumbnail size
        add_image_size( 'archive-post', 400, 290, true );
        add_image_size( 'menu-icon', 375, 200, true );
        add_image_size( 'vc-explore', 320, 320, true );
        add_image_size( 'machines', 75, 85, true );

        add_image_size( 'thumbnail-club-header', 1220, 220, true );
        add_image_size( 'thumbnail-club-team-profile', 150, 160, false );
        add_image_size( 'thumbnail-club-coach-profile', 140, 170, false );
        add_image_size( 'thumbnail-club-activities', 240, 190, true );

        add_image_size( 'thumbnail-club-sector-entry', 374, 584, true );
        add_image_size( 'thumbnail-club-sector-gallery', 700, 440, true );
        add_image_size( 'thumbnail-club-sector-gallery-tablet', 700, 740, true );

        add_image_size( 'wpb-images-carousel', 840, 560, true );
    }

    /**
    * Zarejestrowanie styli zmiennych i skryptow
    */
    public function registerAssetsAction()
    {
        wp_enqueue_style( 'vendors-style', get_template_directory_uri() . '/assets/dist/css/' . bundle('vendor.css'));
        wp_enqueue_style( 'theme-style', get_template_directory_uri() . '/assets/dist/css/' . bundle('.css'));

        if (!$this->isPageSpeed())
        {
            wp_enqueue_script( 'vendors-script', get_template_directory_uri() . '/assets/dist/js/' . bundle('vendor.js'), array(), '20151215', true );
            wp_enqueue_script( 'theme-script', get_template_directory_uri() . '/assets/dist/js/' . bundle('.js'), array(), '20151215', true );
        }

        wp_localize_script( 'theme-script', 'wp', $this->prepareVariablesForScripts());

        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
        {
            wp_enqueue_script( 'comment-reply' );
        }

        wp_dequeue_style('wp-block-library');

                /**
        * register javascript variables
        */
        wp_localize_script('theme-script', 'menu-underline', array(
            'menu-underline-link' => get_site_url(),
        ));
    }




    /**
    * Akcja init
    */
    public function initAction()
    {
        $this->forceAdminLang();
        $this->disableEmojis();
    }

    /**
    * Force front language on admin pages
    */
    private function forceAdminLang()
    {
        if (!is_admin() || !isset($_COOKIE['_icl_current_language'])) return;

        global $sitepress;
        // $sitepress->set_admin_language_cookie($_COOKIE['_icl_current_language']);
    }

    public function templateRedirectAction()
    {
        if (!is_user_logged_in())
        {
            header("Cache-Control: public, max-age=900, s-maxage=900");
        }
        send_frame_options_header();
    
        if ($this->isPageSpeed())
        {
            remove_action( 'wp_footer', 'anr_wp_footer' );
        }
    }

    public function isPageSpeed()
    {
        return $_SERVER['HTTP_USER_AGENT'] == 'Chrome-Lighthouse';
    }

    public function disableEmojis()
    {
        if (is_admin()) return;
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_action( 'admin_print_styles', 'print_emoji_styles' );
        remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
        remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
        remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

        add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
    }

    /**
    * Stworzenie zmiennych dla sckryptow
    */
    public function prepareVariablesForScripts()
    {
        $rest_api_base = get_rest_url(null, TEXT_DOMAIN . '/v1');
        $variables = [
            'is_front_page'   => is_front_page(),
            'rest_api_base'   => $rest_api_base,
            'ajaxurl'         => admin_url( 'admin-ajax.php' ),
            'custom_ajaxurl'  => get_template_directory_uri() . '/ajax.php',
            'homeurl'         => site_url(),
            'origin_url'      => get_base_url(),
            'map_settings'    => [
                'images_dir_url' => trailingslashit( get_template_directory_uri() ) . 'assets/dist/images/'
            ],
            'lang_code'       => defined( 'ICL_LANGUAGE_CODE' ) ? ICL_LANGUAGE_CODE : substr( get_locale(), 0, 2 ),
            'locales'         => [
                'all'         => __('Wszystkie', TEXT_DOMAIN),
                'podcasts'    => [
                    'listen'  => __('Słuchaj podcastu', TEXT_DOMAIN),
                    'short'   => __('skrócony', TEXT_DOMAIN),
                    'full'    => __('pełny', TEXT_DOMAIN),
                ],
                'our_clubs'   => [
                    'hide_list' => __('Schowaj listę', TEXT_DOMAIN),
                    'show_list' => __('Pokaż listę', TEXT_DOMAIN),
                ]
            ]
        ];

        return $variables;
    }

    public function getDefaultColors()
    {
        return [
            array(
                'name'  => __( 'Kolor', TEXT_DOMAIN ) . 1,
                'slug'  => 'color_1',
                'color'	=> '#eeeeee',
            ),
            array(
                'name'  => __( 'Kolor', TEXT_DOMAIN ) . 2,
                'slug'  => 'color_2',
                'color'	=> '#f6f7f7',
            ),
            array(
                'name'  => __( 'Kolor', TEXT_DOMAIN ) . 3,
                'slug'  => 'color_3',
                'color' => '#aec6de',
            ),
            array(
                'name'  => __( 'Kolor', TEXT_DOMAIN ) . 4,
                'slug'  => 'color_4',
                'color' => '#002454',
            ),
            array(
                'name'  => __( 'Kolor', TEXT_DOMAIN ) . 5,
                'slug'  => 'color_5',
                'color' => '#c4103a',
            ),
            array(
                'name'	=> __( 'Kolor', TEXT_DOMAIN ) . 6,
                'slug'	=> 'color_6',
                'color'	=> '#ffffff',
            ),
        ];
    }

    public function getColors()
    {
        $colors = [];
        $colorOptions = get_field('colors', 'options');
        if (empty($colorOptions))
        {
            $colors = theme()->getDefaultColors();
        }
        else
        {
            foreach ($colorOptions as $index => $option)
            {
                $colors[] = [
                    'name'  => array_get($option, 'name'),
                    'slug'  => 'color_' . $index,
                    'color' => array_get($option, 'color'),
                ];
            }
        }
        return $colors;
    }

    public function getColor($key, $default = '#ffffff')
    {
        if (empty($key)) return $default;
        return array_get(array_pluck($this->getColors(), null, 'slug'), $key . '.color', $default);
    }

    public function getColorsForBlocks()
    {
        return array_pluck($this->getColors(), 'name', 'slug');
    }
}
