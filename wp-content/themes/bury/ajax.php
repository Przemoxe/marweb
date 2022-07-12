<?php
/**
* Faster ajax requests
*/
require_once __DIR__ . '/application/vendor/autoload.php';
define( 'DOING_AJAX_CUSTOM', true );
define( 'SHORTINIT', true );

if ( isset( $_REQUEST['action'] ) && !empty( $_REQUEST['action'] )) {
	define( 'DOING_AJAX', true );
}

ini_set( 'html_errors', 0 );
ini_set( 'display_errors', 0 );
ini_set( 'display_startup_errors', 0 );
error_reporting( E_ALL );

require '../../../wp-load.php';
require_once( ABSPATH . WPINC . '/l10n.php' );
require_once( ABSPATH . WPINC . '/class-wp-locale.php' );
require_once( ABSPATH . WPINC . '/class-wp-locale-switcher.php' );


// Load most of WordPress.
require( ABSPATH . WPINC . '/class-wp-walker.php' );
require( ABSPATH . WPINC . '/class-wp-ajax-response.php' );
// require( ABSPATH . WPINC . '/formatting.php' );
require( ABSPATH . WPINC . '/capabilities.php' );
require( ABSPATH . WPINC . '/class-wp-roles.php' );
require( ABSPATH . WPINC . '/class-wp-role.php' );
require( ABSPATH . WPINC . '/class-wp-user.php' );
require( ABSPATH . WPINC . '/class-wp-query.php' );
require( ABSPATH . WPINC . '/query.php' );
require( ABSPATH . WPINC . '/date.php' );
require( ABSPATH . WPINC . '/theme.php' );
require( ABSPATH . WPINC . '/class-wp-theme.php' );
require( ABSPATH . WPINC . '/template.php' );
require( ABSPATH . WPINC . '/user.php' );
require( ABSPATH . WPINC . '/class-wp-user-query.php' );
require( ABSPATH . WPINC . '/class-wp-session-tokens.php' );
require( ABSPATH . WPINC . '/class-wp-user-meta-session-tokens.php' );
// require( ABSPATH . WPINC . '/meta.php' );
// require( ABSPATH . WPINC . '/class-wp-meta-query.php' );
require( ABSPATH . WPINC . '/class-wp-metadata-lazyloader.php' );
require( ABSPATH . WPINC . '/general-template.php' );
require( ABSPATH . WPINC . '/link-template.php' );
require( ABSPATH . WPINC . '/author-template.php' );
require( ABSPATH . WPINC . '/post.php' );
require( ABSPATH . WPINC . '/class-walker-page.php' );
require( ABSPATH . WPINC . '/class-walker-page-dropdown.php' );
require( ABSPATH . WPINC . '/class-wp-post-type.php' );
require( ABSPATH . WPINC . '/class-wp-post.php' );
require( ABSPATH . WPINC . '/post-template.php' );
require( ABSPATH . WPINC . '/revision.php' );
require( ABSPATH . WPINC . '/post-formats.php' );
require( ABSPATH . WPINC . '/post-thumbnail-template.php' );
require( ABSPATH . WPINC . '/category.php' );
require( ABSPATH . WPINC . '/class-walker-category.php' );
require( ABSPATH . WPINC . '/class-walker-category-dropdown.php' );
require( ABSPATH . WPINC . '/category-template.php' );
require( ABSPATH . WPINC . '/comment.php' );
require( ABSPATH . WPINC . '/class-wp-comment.php' );
require( ABSPATH . WPINC . '/class-wp-comment-query.php' );
require( ABSPATH . WPINC . '/class-walker-comment.php' );
require( ABSPATH . WPINC . '/comment-template.php' );
require( ABSPATH . WPINC . '/rewrite.php' );
require( ABSPATH . WPINC . '/class-wp-rewrite.php' );
require( ABSPATH . WPINC . '/feed.php' );
require( ABSPATH . WPINC . '/bookmark.php' );
require( ABSPATH . WPINC . '/bookmark-template.php' );
require( ABSPATH . WPINC . '/kses.php' );
require( ABSPATH . WPINC . '/cron.php' );
require( ABSPATH . WPINC . '/deprecated.php' );
require( ABSPATH . WPINC . '/script-loader.php' );
require( ABSPATH . WPINC . '/taxonomy.php' );
require( ABSPATH . WPINC . '/class-wp-taxonomy.php' );
require( ABSPATH . WPINC . '/class-wp-term.php' );
require( ABSPATH . WPINC . '/class-wp-term-query.php' );
require( ABSPATH . WPINC . '/class-wp-tax-query.php' );
require( ABSPATH . WPINC . '/update.php' );
require( ABSPATH . WPINC . '/canonical.php' );
require( ABSPATH . WPINC . '/shortcodes.php' );
require( ABSPATH . WPINC . '/embed.php' );
require( ABSPATH . WPINC . '/class-wp-embed.php' );
require( ABSPATH . WPINC . '/class-oembed.php' );
require( ABSPATH . WPINC . '/class-wp-oembed-controller.php' );
require( ABSPATH . WPINC . '/media.php' );
require( ABSPATH . WPINC . '/http.php' );
require( ABSPATH . WPINC . '/class-http.php' );
require( ABSPATH . WPINC . '/class-wp-http-streams.php' );
require( ABSPATH . WPINC . '/class-wp-http-curl.php' );
require( ABSPATH . WPINC . '/class-wp-http-proxy.php' );
require( ABSPATH . WPINC . '/class-wp-http-cookie.php' );
require( ABSPATH . WPINC . '/class-wp-http-encoding.php' );
require( ABSPATH . WPINC . '/class-wp-http-response.php' );
require( ABSPATH . WPINC . '/class-wp-http-requests-response.php' );
require( ABSPATH . WPINC . '/class-wp-http-requests-hooks.php' );
require( ABSPATH . WPINC . '/widgets.php' );
require( ABSPATH . WPINC . '/class-wp-widget.php' );
require( ABSPATH . WPINC . '/class-wp-widget-factory.php' );
require( ABSPATH . WPINC . '/nav-menu.php' );
require( ABSPATH . WPINC . '/nav-menu-template.php' );
require( ABSPATH . WPINC . '/rest-api.php' );
require( ABSPATH . WPINC . '/rest-api/class-wp-rest-server.php' );
require( ABSPATH . WPINC . '/rest-api/class-wp-rest-response.php' );
require( ABSPATH . WPINC . '/rest-api/class-wp-rest-request.php' );
require( ABSPATH . WPINC . '/rest-api/endpoints/class-wp-rest-controller.php' );
require( ABSPATH . WPINC . '/rest-api/endpoints/class-wp-rest-posts-controller.php' );
require( ABSPATH . WPINC . '/rest-api/endpoints/class-wp-rest-attachments-controller.php' );
require( ABSPATH . WPINC . '/rest-api/endpoints/class-wp-rest-post-types-controller.php' );
require( ABSPATH . WPINC . '/rest-api/endpoints/class-wp-rest-post-statuses-controller.php' );
require( ABSPATH . WPINC . '/rest-api/endpoints/class-wp-rest-revisions-controller.php' );
require( ABSPATH . WPINC . '/rest-api/endpoints/class-wp-rest-taxonomies-controller.php' );
require( ABSPATH . WPINC . '/rest-api/endpoints/class-wp-rest-terms-controller.php' );
require( ABSPATH . WPINC . '/rest-api/endpoints/class-wp-rest-users-controller.php' );
require( ABSPATH . WPINC . '/rest-api/endpoints/class-wp-rest-comments-controller.php' );
require( ABSPATH . WPINC . '/rest-api/endpoints/class-wp-rest-settings-controller.php' );
require( ABSPATH . WPINC . '/rest-api/fields/class-wp-rest-meta-fields.php' );
require( ABSPATH . WPINC . '/rest-api/fields/class-wp-rest-comment-meta-fields.php' );
require( ABSPATH . WPINC . '/rest-api/fields/class-wp-rest-post-meta-fields.php' );
require( ABSPATH . WPINC . '/rest-api/fields/class-wp-rest-term-meta-fields.php' );
require( ABSPATH . WPINC . '/rest-api/fields/class-wp-rest-user-meta-fields.php' );


$GLOBALS['wp_embed'] = new WP_Embed();

// Load multisite-specific files.
if ( is_multisite() ) {
	require( ABSPATH . WPINC . '/ms-functions.php' );
	require( ABSPATH . WPINC . '/ms-default-filters.php' );
	require( ABSPATH . WPINC . '/ms-deprecated.php' );
}

// Define constants that rely on the API to obtain the default value.
// Define must-use plugin directory constants, which may be overridden in the sunrise.php drop-in.
wp_plugin_directory_constants();

$GLOBALS['wp_plugin_paths'] = array();

// Load must-use plugins.
foreach ( wp_get_mu_plugins() as $mu_plugin ) {
	include_once( $mu_plugin );
}
unset( $mu_plugin );

// Load network activated plugins.
if ( is_multisite() ) {
	foreach ( wp_get_active_network_plugins() as $network_plugin ) {
		wp_register_plugin_realpath( $network_plugin );
		include_once( $network_plugin );
	}
	unset( $network_plugin );
}

/**
 * Fires once all must-use and network-activated plugins have loaded.
 *
 * @since 2.8.0
 */
do_action( 'muplugins_loaded' );

if ( is_multisite() )
	ms_cookie_constants(  );

// Define constants after multisite is loaded.
wp_cookie_constants();

// Define and enforce our SSL constants
wp_ssl_constants();

// Create common globals.
require( ABSPATH . WPINC . '/vars.php' );

// Make taxonomies and posts available to plugins and themes.
// @plugin authors: warning: these get registered again on the init hook.
create_initial_taxonomies();
create_initial_post_types();

wp_start_scraping_edited_file_errors();

// Register the default theme directory root
register_theme_directory( get_theme_root() );

/** Only customs cripts */
$plugins = [
	WP_PLUGIN_DIR . '/advanced-custom-fields-pro/acf.php',
	WP_PLUGIN_DIR . '/js_composer/js_composer.php',
	WP_PLUGIN_DIR . '/sitepress-multilingual-cms/sitepress.php',
	WP_PLUGIN_DIR . '/wpml-string-translation/plugin.php',
];

// Load active plugins.
foreach ( $plugins as &$plugin )
{
	$plugin = str_replace('\\', '/', $plugin);
	wp_register_plugin_realpath( $plugin );
	include_once( $plugin );
}
unset( $plugin );

// Load pluggable functions.
require( ABSPATH . WPINC . '/pluggable.php' );
require( ABSPATH . WPINC . '/pluggable-deprecated.php' );

// Set internal encoding.
wp_set_internal_encoding();

// Run wp_cache_postload() if object cache is enabled and the function exists.
if ( WP_CACHE && function_exists( 'wp_cache_postload' ) )
	wp_cache_postload();

/**
 * Fires once activated plugins have loaded.
 *
 * Pluggable functions are also available at this point in the loading order.
 *
 * @since 1.5.0
 */
do_action( 'plugins_loaded' );

// Define constants which affect functionality if not already defined.
wp_functionality_constants();

// Add magic quotes and set up $_REQUEST ( $_GET + $_POST )
wp_magic_quotes();

/**
 * Fires when comment cookies are sanitized.
 *
 * @since 2.0.11
 */
do_action( 'sanitize_comment_cookies' );

/**
 * WordPress Query object
 * @global WP_Query $wp_the_query
 * @since 2.0.0
 */
$GLOBALS['wp_the_query'] = new WP_Query();

/**
 * Holds the reference to @see $wp_the_query
 * Use this global for WordPress queries
 * @global WP_Query $wp_query
 * @since 1.5.0
 */
$GLOBALS['wp_query'] = $GLOBALS['wp_the_query'];

/**
 * Holds the WordPress Rewrite object for creating pretty URLs
 * @global WP_Rewrite $wp_rewrite
 * @since 1.5.0
 */
$GLOBALS['wp_rewrite'] = new WP_Rewrite();

/**
 * WordPress Object
 * @global WP $wp
 * @since 2.0.0
 */
$GLOBALS['wp'] = new WP();

/**
 * WordPress Widget Factory Object
 * @global WP_Widget_Factory $wp_widget_factory
 * @since 2.8.0
 */
$GLOBALS['wp_widget_factory'] = new WP_Widget_Factory();

/**
 * WordPress User Roles
 * @global WP_Roles $wp_roles
 * @since 2.0.0
 */
$GLOBALS['wp_roles'] = new WP_Roles();

/**
 * Fires before the theme is loaded.
 *
 * @since 2.6.0
 */
do_action( 'setup_theme' );

// Define the template related constants.
wp_templating_constants(  );

// Load the default text localization domain.
load_default_textdomain();

$locale = get_locale();
$locale_file = WP_LANG_DIR . "/$locale.php";
if ( ( 0 === validate_file( $locale ) ) && is_readable( $locale_file ) )
	require( $locale_file );
unset( $locale_file );

/**
 * WordPress Locale object for loading locale domain date and various strings.
 * @global WP_Locale $wp_locale
 * @since 2.1.0
 */
$GLOBALS['wp_locale'] = new WP_Locale();

/**
 *  WordPress Locale Switcher object for switching locales.
 *
 * @since 4.7.0
 *
 * @global WP_Locale_Switcher $wp_locale_switcher WordPress locale switcher object.
 */
$GLOBALS['wp_locale_switcher'] = new WP_Locale_Switcher();
$GLOBALS['wp_locale_switcher']->init();

// Load the functions for the active theme, for both parent and child theme if applicable.
if ( ! wp_installing() || 'wp-activate.php' === $pagenow ) {
	if ( TEMPLATEPATH !== STYLESHEETPATH && file_exists( STYLESHEETPATH . '/functions.php' ) )
		include( STYLESHEETPATH . '/functions.php' );
	if ( file_exists( TEMPLATEPATH . '/functions.php' ) )
		include( TEMPLATEPATH . '/functions.php' );
}

/**
 * Fires after the theme is loaded.
 *
 * @since 3.0.0
 */

do_action( 'after_setup_theme' );

// Set up current user.
$GLOBALS['wp']->init();

/**
 * Fires after WordPress has finished loading but before any headers are sent.
 *
 * Most of WP is loaded at this stage, and the user is authenticated. WP continues
 * to load on the {@see 'init'} hook that follows (e.g. widgets), and many plugins instantiate
 * themselves on it for all sorts of reasons (e.g. they need a user, a taxonomy, etc.).
 *
 * If you wish to plug an action once WP is loaded, use the {@see 'wp_loaded'} hook below.
 *
 * @since 1.5.0
 */
do_action( 'init' );


// Check site status
if ( is_multisite() ) {
	if ( true !== ( $file = ms_site_check() ) ) {
		require( $file );
		die();
	}
	unset($file);
}

/**
 * This hook is fired once WP, all plugins, and the theme are fully loaded and instantiated.
 *
 * Ajax requests should use wp-admin/admin-ajax.php. admin-ajax.php can handle requests for
 * users not logged in.
 *
 * @link https://codex.wordpress.org/AJAX_in_Plugins
 *
 * @since 3.0.0
 */
do_action( 'wp_loaded' );

if ( isset( $_REQUEST['action'] ) && !empty( $_REQUEST['action'] )) {
	do_action( 'wp_ajax_' . $_REQUEST['action'] );
}