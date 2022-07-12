<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'example-w1-test' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

if ( !defined('WP_CLI') ) {
    define( 'WP_SITEURL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
    define( 'WP_HOME',    $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
}



/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'aVqh5G8m8A9ms4xLdaORuPrScXvOYuN24Qz0PVx1uoJEPbzwoSftcjUe4pFgZieq' );
define( 'SECURE_AUTH_KEY',  'cM6JjUZq1XIFLTWHDZ89YqzvNYrDC88aEQDPzOOZA7yZ75d6vy9PLoICLGAuPsXg' );
define( 'LOGGED_IN_KEY',    'zLwWVg8OuzBxy9Ut2hwu5CbxevYPgYNiMbVbF3diHK7DXmvXVA0plt6T0IlodzV2' );
define( 'NONCE_KEY',        'QOQc8mIivcTGGIFmtnXypaRpuZ9O3HPrTB9veud7TKMPTPdkyeZKn5rrFh4dvE7Z' );
define( 'AUTH_SALT',        'k2LcOSg4MqdNgPCIPg0IIW96UkPgtot4fOdUCl3aRX5cKeV1Ji7PgnvslnCIHoT3' );
define( 'SECURE_AUTH_SALT', 'BkscctYSf4FC0o1Kbh5CCGD1tY7BJGIaiyPFUwaEFNp12krck4aapXFkALc7aNfu' );
define( 'LOGGED_IN_SALT',   '6xnbTZwCwgZJIvY7wagMVsVGTjN4anlMELT4hnZIE1HmRJaTu8hfigJlgRMBmx3y' );
define( 'NONCE_SALT',       'YYPQ1d4nL2RxEsuAjkXVrD2794EvYdiCaK7E9n9uzq8RNBejR35iQHIChJA6wxuF' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
