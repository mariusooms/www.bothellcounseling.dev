<?php
// ===================================================
// Load database info and local development parameters
// ===================================================

define( 'DB_CREDENTIALS_PATH', dirname( __FILE__ ) . '/config/enviroments/' );
define( 'WP_LOCAL_SERVER', file_exists( DB_CREDENTIALS_PATH . 'local-config.php' ) );
define( 'WP_STABLE_SERVER', file_exists( DB_CREDENTIALS_PATH . 'stable-config.php' ) );

// ========================================
// Select enviroment based on existing file
// ========================================

if ( WP_LOCAL_SERVER )
    require DB_CREDENTIALS_PATH . 'local-config.php';
elseif ( WP_STABLE_SERVER )
    require DB_CREDENTIALS_PATH . 'stable-config.php';
else
    require DB_CREDENTIALS_PATH . 'production-config.php';
    
// ========================
// Custom Content Directory
// ========================
define( 'WP_CONTENT_DIR', dirname( __FILE__ ) . '/content' );
define( 'WP_CONTENT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/content' );    

// ================================================
// You almost certainly do not want to change these
// ================================================
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

// ==============================================================
// Salts, for security
// Grab these from: https://api.wordpress.org/secret-key/1.1/salt
// ==============================================================
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

// ==============================================================
// Table prefix
// Change this if you have multiple installs in the same database
// ==============================================================
$table_prefix  = 'wp_';

// ================================
// Language
// Leave blank for American English
// ================================
define('WPLANG', '');

// ==========================================================
// Debug mode
// This conditional will check wether Debug mode should be on
// ==========================================================
if ( WP_LOCAL_SERVER ) {
 
	define( 'WP_DEBUG', true );
	define( 'WP_DEBUG_LOG', true ); // Stored in wp-content/debug.log
	define( 'WP_DEBUG_DISPLAY', true );
 
	define( 'SCRIPT_DEBUG', true );
	define( 'SAVEQUERIES', true );
 
} else {
 
	define( 'WP_DEBUG', false );
	define( 'DISALLOW_FILE_MODS', true );
}

// ======================
// Disable post revisions
// ======================
define( 'WP_POST_REVISIONS', false );

// ===================
// Bootstrap WordPress
// ===================
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/wp/');
require_once(ABSPATH . 'wp-settings.php');
