<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// Check for a local config file
if ( file_exists( dirname( __FILE__ ) . '/local-config.php' ) ) {
	include( dirname( __FILE__ ) . '/local-config.php' );
	define( 'WP_LOCAL_DEV', true );
	define( 'WP_DEBUG', true );
} else {
	define('DB_NAME', 'wordpress_4');
	define('DB_USER', 'wordpress_9');
	define('DB_PASSWORD', '#UFz019snA');
	define('DB_HOST', 'localhost:3306');
	define( 'WP_LOCAL_DEV', false );	
	define( 'WP_DEBUG', false );
}

/**
* Define type of server
*
* Depending on the type other stuff can be configured
* Note: Define them all, don't skip one if other is already defined
*/

define( 'DB_CREDENTIALS_PATH', dirname( ABSPATH . '/config/enviroments/' ) ); // cache it for multiple use
define( 'WP_LOCAL_SERVER', file_exists( DB_CREDENTIALS_PATH . 'local-config.php' ) );
define( 'WP_STABLE_SERVER', file_exists( DB_CREDENTIALS_PATH . 'stable-config.php' ) );

/**
* Load DB credentials
*/

if ( WP_LOCAL_SERVER )
    require DB_CREDENTIALS_PATH . 'local-config.php';
elseif ( WP_STABLE_SERVER )
    require DB_CREDENTIALS_PATH . 'stable-config.php';
else
    require DB_CREDENTIALS_PATH . 'production-config.php';
    
    

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
if ( ! defined( 'AUTH_KEY' ) )
	define('AUTH_KEY', 'B$nznrfFYcR08}8}0|k}0,kYc@ckY7quiH6EPEI6+DH6*.x.x+qPjmbA3T7Au6A');
if ( ! defined( 'SECURE_AUTH_KEY' ) )
	define('SECURE_AUTH_KEY', 'XeD29*9H#;_mp1+~hWepxlOS5PX6E2+*;.{qem*#+eiLmuTaP26hVdCK8KSG[:w8G');
if ( ! defined( 'LOGGED_IN_KEY' ) )
	define('LOGGED_IN_KEY', 'fYqfnQX6EUIQ3A.<SaD29_]9D#;xlt]1-~hpSt+elKS5DLTH]2+.;6*<+ei*#pemP');
if ( ! defined( 'NONCE_KEY' ) )
	define('NONCE_KEY', 'f.uXbEmuTHP;6XAE<+*<$,jXfrynQU7fnMTI{E3A^u$9H5~_w#]thpOw~dlZ9GhK');
if ( ! defined( 'AUTH_SALT' ) )
	define('AUTH_SALT', 'L{..<$fi{qeiXiqeE26E37{q{3ynrfymuTIMnQTI<~_ladSeSa9;1Z9G5-59_w-');
if ( ! defined( 'SECURE_AUTH_SALT' ) )
	define('SECURE_AUTH_SALT', '5-1wlpdiWaP;PW6];_5];_h_#+aOS@swkVZC08RYN04@8C|z!go_hoZOSG|NRG|-@');
if ( ! defined( 'LOGGED_IN_SALT' ) )
	define('LOGGED_IN_SALT', ']eiLmtXeDL;WeHP29~#6D2+_mty*iqeIPfiMT6E<PXAH];x*A.{u+bithpSW9GWKS');
if ( ! defined( 'NONCE_SALT' ) )
	define('NONCE_SALT', 'uiLAI:1-_wZht-dlZCKhlOV8:4KS18_[~#;x-elOpxaeHO1ahKS19_[K:5-_ltJ}4');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
if ( WP_LOCAL_SERVER || WP_STABLE_SERVER ) {
 
	define( 'WP_DEBUG', true );
	define( 'WP_DEBUG_LOG', true ); // Stored in wp-content/debug.log
	define( 'WP_DEBUG_DISPLAY', true );
 
	define( 'SCRIPT_DEBUG', true );
	define( 'SAVEQUERIES', true );
 
} else {
 
	define( 'WP_DEBUG', false );
}

define('FS_METHOD', 'direct');

define( 'WP_POST_REVISIONS', false );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
