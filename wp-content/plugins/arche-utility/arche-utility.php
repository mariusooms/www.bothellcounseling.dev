<?php
/**
 * @package   Arche Utility
 * @author    Thijs Huijssoon <thuijssoon@googlemail.com>
 * @license   GPL-2.0+
 * @link      https://github.com/sccmain/arche-utility/
 * @copyright 2013 Thijs Huijssoon
 *
 * @wordpress-plugin
 * Plugin Name:         Arche Utility
 * Plugin URI:          https://github.com/sccmain/arche-utility/
 * GitHub Plugin URI:   https://github.com/sccmain/arche-utility
 * GitHub Branch:       master
 * GitHub Access Token: 15a4e5830725c30e82a9faa0ca49a8464d30845e
 * Description:         Utility plugin for the Arche theme, made for Seattle Christian Counselling
 * Version:             0.1.1
 * Author:              Thijs Huijssoon <thuijssoon@googlemail.com>
 * Author URI:          https://github.com/thuijssoon/
 * Text Domain:         arche
 * License:             GPL-2.0+
 * License URI:         http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:         /lang
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define('ARCHE_CACHE', false);

if ( ! defined( 'ARCHE_CACHE' ) ) {
	define('ARCHE_CACHE', true);
}

// require_once( plugin_dir_path( __FILE__ ) . 'class-th-scc-tunengo-page.php' );
require_once( plugin_dir_path( __FILE__ ) . 'class-arche-utility.php' );

// Register hooks that are fired when the plugin is activated, deactivated, and uninstalled, respectively.
register_activation_hook( __FILE__, array( 'Arche_Utility', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Arche_Utility', 'deactivate' ) );

add_action( 'plugins_loaded', array('Arche_Utility', 'get_instance'));