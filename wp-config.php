<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'hiendb' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
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
define( 'AUTH_KEY',         'e0udnOfEaWcbsHNAyCIqjMjghBIJriR97JLdhLElr7P9e2lp4UTXc0si7VGQN5TI' );
define( 'SECURE_AUTH_KEY',  'SuYS0h1xN5Uq77PUFPiYG5glkbeX3N1Fq7r8sQo5SpAXeH4YPNCskpp5gKc5mdrN' );
define( 'LOGGED_IN_KEY',    '0SlH9ZDTLlTvwS5Jmaf7iRa0m8necQ8uOFEOSEPmhr6Vfbf8lvzhvk7BvohPFFmm' );
define( 'NONCE_KEY',        '3jDFlVaI7JasG2v5FCyM9bZGoq0yVtfBeorkzcWcFbl4fvWOB1KnJTwSMQV7LrDm' );
define( 'AUTH_SALT',        'YzfIWvxLuMPZCnb3pupP9np5AQIt7j2s5CqlEFfa4h8JGAuCOmzXSPDvjJb0wXi1' );
define( 'SECURE_AUTH_SALT', '4YA7xk8Q07svoP28pn3JSVMJCYbgy00WXgqWHQvJsavhbur3IYCVAzbU5MyaJ5TN' );
define( 'LOGGED_IN_SALT',   'iwCR9oUZ5I413o2kFjrtlR6GuLxYg1B3Vkr9JIKTRPuGMdL3iOVgR8b54Z19mOqI' );
define( 'NONCE_SALT',       'tqYsV02IT1Ri9vzi2qJuv3dV2ilv4sJG5q4hYHAOgMqWxpkO1YWDiXNxxkewC6bn' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
