<?php
/**
 *
 *
 * @package   Arche Utility
 * @author    Thijs Huijssoon <thuijssoon@googlemail.com>
 * @license   GPL-2.0+
 * @link      https://github.com/sccmain/arche-utility/
 * @copyright 2013 Thijs Huijssoon
 */

/**
 * Arche Utility
 *
 * @package   TH CPT Test
 * @author    Thijs Huijssoon <thuijssoon@googlemail.com>
 */
class Arche_Utility {

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   0.1.0
	 *
	 * @var     string
	 */
	protected $version = '0.1.0';

	/**
	 * Unique identifier for your plugin.
	 *
	 * Use this value (not the variable name) as the text domain when internationalizing strings of text. It should
	 * match the Text Domain file header in the main plugin file.
	 *
	 * @since    0.1.0
	 *
	 * @var      string
	 */
	protected $plugin_slug = 'arche-utility';

	/**
	 * Instance of this class.
	 *
	 * @since    0.1.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Slug of the plugin screen.
	 *
	 * @since    0.1.0
	 *
	 * @var      string
	 */
	protected $plugin_screen_hook_suffix = null;

	/**
	 * Initialize the plugin by setting localization, filters, and administration functions.
	 *
	 * @since     0.1.0
	 */
	private function __construct() {

		// Load plugin text domain
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
		add_action( 'init', array( $this, 'upgrade' ) );

		// Activate plugin when new blog is added
		add_action( 'wpmu_new_blog', array( $this, 'activate_new_site' ) );

		// Initialize TH Framwork
		add_action( 'th_framework_loaded', array( $this, 'th_framework_init' ) );
		add_action( 'TH_Settings_API_submit_arche-settings', array( $this, 'th_framework_settings_updated' ) );


		$flush_required = get_option( 'arche-flush-required', false );
		if ( $flush_required ) {
			add_action( 'admin_init', array( $this, 'flush_rules' ) );
		}

		// Prevent updates to Taxonomy Metadata plugin
		add_filter( 'site_transient_update_plugins', array( $this, 'filter_plugin_updates' ) );

		add_action( 'save_post', array( $this, 'clear_transient_cache' ), 100 );
		add_action( 'untrashed_post', array( $this, 'clear_transient_cache' ), 100 );
		add_action( 'deleted_post', array( $this, 'clear_transient_cache' ), 100 );
		add_action( 'trashed_post', array( $this, 'clear_transient_cache' ), 100 );

		add_action( 'created_term', array( $this, 'clear_transient_cache_term' ), 100, 3 );
		add_action( 'edited_term', array( $this, 'clear_transient_cache_term' ), 100, 3 );
		add_action( 'delete_term', array( $this, 'clear_transient_cache_term' ), 100, 3 );

		// add_filter( 'pre_option_sticky_posts', array( $this, 'ensure_current_location_shown_first' ) );
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     0.1.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Fired when the plugin is activated.
	 *
	 * @since    0.1.0
	 *
	 * @param boolean $network_wide True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog.
	 */
	public static function activate( $network_wide ) {
		if ( function_exists( 'is_multisite' ) && is_multisite() ) {
			if ( $network_wide  ) {
				// Get all blog ids
				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {
					switch_to_blog( $blog_id );
					self::single_activate();
				}
				restore_current_blog();
			} else {
				self::single_activate();
			}
		} else {
			self::single_activate();
		}
	}

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @since    0.1.0
	 *
	 * @param boolean $network_wide True if WPMU superadmin uses "Network Deactivate" action, false if WPMU is disabled or plugin is deactivated on an individual blog.
	 */
	public static function deactivate( $network_wide ) {
		if ( function_exists( 'is_multisite' ) && is_multisite() ) {
			if ( $network_wide ) {
				// Get all blog ids
				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {
					switch_to_blog( $blog_id );
					self::single_deactivate();
				}
				restore_current_blog();
			} else {
				self::single_deactivate();
			}
		} else {
			self::single_deactivate();
		}
	}

	/**
	 * Fired when a new site is activated with a WPMU environment.
	 *
	 * @since    0.1.0
	 *
	 * @param int     $blog_id ID of the new blog.
	 */
	public function activate_new_site( $blog_id ) {
		if ( did_action( 'wpmu_new_blog' ) !== 1 )
			return;

		switch_to_blog( $blog_id );
		self::single_activate();
		restore_current_blog();
	}

	/**
	 * Get all blog ids of blogs in the current network that are:
	 * - not archived
	 * - not spam
	 * - not deleted
	 *
	 * @since    0.1.0
	 *
	 * @return array|false The blog ids, false if no matches.
	 */
	private static function get_blog_ids() {
		global $wpdb;

		// get an array of blog ids
		$sql = "SELECT blog_id FROM $wpdb->blogs
			WHERE archived = '0' AND spam = '0'
			AND deleted = '0'";
		return $wpdb->get_col( $sql );
	}

	/**
	 * Fired for each blog when the plugin is activated.
	 *
	 * @since    0.1.0
	 */
	private static function single_activate() {
	}

	/**
	 * Fired for each blog when the plugin is deactivated.
	 *
	 * @since    0.1.0
	 */
	private static function single_deactivate() {
		TH_CPT::deactivate( 'counselor-profile' );
	}

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    0.1.0
	 */
	public function load_plugin_textdomain() {
		$domain = $this->plugin_slug;
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );

		load_textdomain( $domain, WP_LANG_DIR . '/' . $domain . '/' . $domain . '-' . $locale . '.mo' );
		load_plugin_textdomain( $domain, FALSE, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
	}

	/**
	 * Checks if the plugin was recently updated and upgrades if necessary
	 *
	 * @since    0.1.0
	 */
	public function upgrade() {
		if ( did_action( 'init' ) !== 1 )
			return;

		$version = get_option( 'arche-utility-version', false );

		if ( !$version ) {
			TH_CPT::activate( 'counselor-profile' );
			$version = '0.1.0';
			add_option( 'arche-flush-required', true );
			update_option( 'th-scc-utility-version', $this->version );
		}

	}

	/**
	 * Init the framework.
	 *
	 * @return void
	 * @since    0.1.0
	 */
	public function th_framework_init() {
		new TH_Settings_API(
			dirname( __FILE__ ) . '/settings.php',
			array(
				'option_key' => 'arche-settings',
				'page_title' => 'Arche Settings',
				'page_name'  => 'arche-settings',
				'menu_location' => 'menu',
			)
		);
		require_once 'counselor-profile-cpt.php';
		require_once 'counselor-profile-meta.php';
		require_once 'frontpage-meta.php';
		require_once 'post-meta.php';
		require_once 'credential-tax.php';
		require_once 'service-tax.php';

		require_once 'location-cpt-tax.php';
		require_once 'location-meta.php';

		require_once 'template-functions.php';
		require_once 'location-template-functions.php';

		require_once 'class-location-meta-box.php';
	}

	/**
	 * Flush the rewrite rules if settings are updated.
	 *
	 * @return void
	 * @since    0.1.0
	 */
	public function th_framework_settings_updated() {
		add_option( 'arche-flush-required', true );
	}

	/**
	 * Flush the rewrite rules and delete the option.
	 *
	 * @return void
	 * @since    0.1.0
	 */
	public function flush_rules() {
		flush_rewrite_rules();
		delete_option( 'arche-flush-required' );
	}

	public function clear_transient_cache( $post_id ) {
		global $post;

		if ( 'counselor-profile' === $post->post_type ) {
			delete_transient( 'arche-front-page-who-we-are-cache' );
			delete_transient( 'arche-counselor-directory-json-cache' );
		} elseif ( 'location' === $post->post_type ) {
			delete_transient( 'arche-counselor-directory-json-cache' );
		}
	}

	public function clear_transient_cache_term( $term_id, $tt_id, $taxonomy ) {
		if ( 'service' === $taxonomy || 'credential' === $taxonomy ) {
			delete_transient( 'arche-counselor-directory-json-cache' );
		}
	}

	/**
	 * Remove taxonomy metadate plugin from update plugins transient.
	 *
	 * @since    1.1.1
	 * @param [type]  $value Transient
	 * @return [type]        Filtered transient
	 */
	public function filter_plugin_updates( $value ) {
		if ( !empty( $value ) && !empty( $value->response ) && isset( $value->response['taxonomy-metadata/taxonomy-metadata.php'] ) ) {
			unset( $value->response['taxonomy-metadata/taxonomy-metadata.php'] );
		}
		return $value;
	}

	public function ensure_current_location_shown_first( $sticky_posts ) {
		$arche_settings = get_option( 'arche-settings' );
		$primary_location = $arche_settings['primary-location'];

		if ( empty( $sticky_posts ) ) {
			return array( $primary_location );
		}elseif ( !is_array( $sticky_posts ) ) {
			$sticky_posts = (array) $sticky_posts;
		}

		$sticky_posts[] = $primary_location;

		return $sticky_posts;
	}
}
