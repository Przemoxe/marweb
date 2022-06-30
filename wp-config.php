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
define( 'DB_NAME', 'example-w1' );

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
define( 'AUTH_KEY',         'Fy5UBx54tQaL2NDTDsqlYlbleiBLWBofe6RLbRQpwRoIVjDRKSxsAaAPrFzX8k3y' );
define( 'SECURE_AUTH_KEY',  'I0dVI1ORZSZyOQkuGESkeTe3jIm72sGIOu6W2zXNs5p6W16SN3zSIp1SGHtoIWpO' );
define( 'LOGGED_IN_KEY',    'OR8PR4hmUd3suk1ocEJd6dC5n4I6vdXp1lcDZ7ixkyNjsKfiHJ04tMLjyLM8HSce' );
define( 'NONCE_KEY',        'iXcj3aSEKrerLq2NHvwI25eX8ErtVVSCVufZ4QLS9TL8DcTkSrKI1SLEwbI4Ylg5' );
define( 'AUTH_SALT',        'ozfIFOnGfM9d0TLLosXWvtWcvfPopJqUGhjEJfJTQvOMu1Z5MLPup3spHznc31jh' );
define( 'SECURE_AUTH_SALT', 'S9nX6dZenZK9MZicti4BKnIHUtzgjXZUpTPv9V3mAp8ikZAgWhGXLyppO0tQlk12' );
define( 'LOGGED_IN_SALT',   'xFzCTvF3Q9JD2pfogAsuRv2liw1BWoyfApzsVftyltxfGysaJTqgAevxokheL12w' );
define( 'NONCE_SALT',       'CZccTciBZPOShFdGU04bT1Y8RlAsttN20eY8QMrj9aKCr4IDHyBLgCxha80S754d' );

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
