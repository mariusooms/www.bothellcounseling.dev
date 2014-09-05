<?php
/**
 * Arche childtheme functions.php 
 *
 * Child theme modifications in addition to the Genesis framework.
 *
 * @package Arche\Framework
 * @license GPL-2.0+
 */
 
/* Table of Contents

	- Base settings
		- Start the engine
		- Child theme
		- Add Viewport meta tag
	- Wordpress functions
		- Register additional header image sizes
		- Register additional profile image sizes
	- Theme support settings
		- Add HTML5 markup structure
		- Add support for custom header
		- Add genesis wraps
		- Add support for footer widgets
		- Remove support for inpost/archive layouts
	- Responsive header code
		- Create responsive header markup
		- Load responsive header markup
	- Genesis customizations
		- Remove widget-header-right
		- Reposition the primary navigation menu inside the header
		- Reposition the footer widgets inside the footer
		- Filter the Genesis title
		- Customize header to show new genesis_site_title
		- Add menu descriptions
		- Add custom item to WP menu
		- Add footer content
		- Customize the copyright footer
		- Add custom body class
	- Enqueue scripts and styles
		- Enqueue jquery scripts
	- General cleanup of unwanted stuff
		- Remove comment feed
		- Remove comment reply script

*/


/* Base settings
--------------------------------------------- */

/**
 * Start the engine.
 */
require_once( get_template_directory() . '/lib/init.php' );

/**
 * Child theme (do not remove).
 */
define( 'CHILD_THEME_NAME', 'Arche' );
define( 'CHILD_THEME_URL', 'https://github.com/sccmain/arche' );

/**
 * Add Viewport meta tag.
 */
function arche_viewport_meta_tag() {
	echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />';
}

add_action( 'genesis_meta', 'arche_viewport_meta_tag' );

/**
 * Setup Arche textdomain.
 *
 * Declare textdomain for this child theme.
 * Translations can be filed in the /languages/ directory.
 */
function arche_theme_textdomain() {
	load_child_theme_textdomain( 'arche', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'arche_theme_textdomain' );


/* Wordpress functions
--------------------------------------------- */

//* Register additional header image sizes
add_image_size('header_medium', 1024, 960, false);
add_image_size('header_minimal', 480, 960, false);

//* Register additional profile image sizes
add_image_size('profile-portrait-small', 150, 225, true);
add_image_size('profile-portrait', 270, 405, true);
add_image_size('profile-landscape-small', 267, 150, true);
add_image_size('profile-landscape', 480, 270, true);
add_image_size('square-small', 100, 100, array( 'center', 'center' ));
add_image_size('square-medium', 150, 150, array( 'center', 'center' ));
add_image_size('square-large', 250, 250, array( 'center', 'center' ));

//* Register additional image sizes
add_image_size('location-landscape', 200, 100, true);


/* Theme support settings
--------------------------------------------- */

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

//* Add support for custom header
add_theme_support( 'genesis-custom-header', array(
	'width' => 1600,
	'height' => 960
) );

//* Add genesis wraps
add_theme_support( 'genesis-structural-wraps', array() );

//* Add support for footer widgets
add_theme_support( 'genesis-footer-widgets', 2 );

//* Remove support for inpost/archive layouts
//remove_theme_support( 'genesis-inpost-layouts' );
//remove_theme_support( 'genesis-archive-layouts' );

//* Register new sidebar
genesis_register_sidebar( array(
    'id' => 'profile-sidebar',
    'name' => 'Profile Sidebar',
    'description' => 'This is the profile sidebar.',
) );

//* Swap in profile sidebar.
function arche_profile_sidebar_logic() {
    if ( is_singular( 'counselor-profile' ) ) {
        remove_action( 'genesis_after_content', 'genesis_get_sidebar' );
        add_action( 'genesis_after_content', 'arche_profile_get_profile_sidebar' );
    }
}
add_action( 'get_header', 'arche_profile_sidebar_logic' );

//* Retrieve profile sidebar
function arche_profile_get_profile_sidebar() {
    get_sidebar( 'profile' );
}

/* Genesis customizations
--------------------------------------------- */

//* Remove widget-header-right
unregister_sidebar( 'header-right' );

//* Reposition the primary navigation menu inside the header
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 6 );

//* Reposition the footer widgets inside the footer
remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );
add_action( 'genesis_footer', 'genesis_footer_widget_areas' );

function arche_open_site_header_wrap() {
	echo '<div class="wrap">';
}
add_action( 'genesis_header', 'arche_open_site_header_wrap', 5);

function arche_close_site_header_wrap() {
	echo '</div><!-- .wrap -->';
}
add_action( 'genesis_header', 'arche_close_site_header_wrap', 11);

/**
 * Filter the Genesis title.
 *
 * Filter the genesis_seo_site_title function to use an image for the logo, instead of a background image.
 * 
 * @link http://blackhillswebworks.com/?p=4144
 */
function arche_filter_genesis_seo_site_title( $title, $inside ){

	if (is_page_template('landing-page.php')) {
		$logo = 'logo-landing.png';
	} else {
		$logo = 'logo.png';
	}

	$child_inside = sprintf( '<a href="%s" title="%s"><img src="'. get_stylesheet_directory_uri() .'/images/%s" title="%s" alt="%s"/></a>', trailingslashit( home_url() ), esc_attr( get_bloginfo( 'name' ) ), $logo, esc_attr( get_bloginfo( 'name' ) ), esc_attr( get_bloginfo( 'name' ) ) );
	$title = str_replace( $inside, $child_inside, $title );
	return $title;
}

add_filter( 'genesis_seo_title', 'arche_filter_genesis_seo_site_title', 10, 2 );

/**
 * Customize header to show new genesis_site_title.
 *
 * Additionally we also include the phone number which will display on mobile devices.
 *
 * @see arche_filter_genesis_seo_site_title()
 */
function arche_do_header() {
	do_action( 'genesis_site_title' );
	if (!is_page_template('landing-page.php') ) {
		echo '<div class="call-link-tablet">Call Us Today <a href="tel:+4259397959">(425)-939-7959</a></div>';
	}
}
remove_action( 'genesis_header', 'genesis_do_header' ); 
add_action( 'genesis_header', 'arche_do_header', 9 );

/**
 * Add menu descriptions.
 *
 * @link http://www.wpstuffs.com/add-menu-description-in-genesis/
 */
function arche_add_description( $item_output, $item ) {
	$description = $item->post_content;
	if (' ' !== $description ) 
	return preg_replace( '/(<a.*?>[^<]*?)</', '$1' . '<span class="menu-description">' . $description . '</span><', $item_output);
	else
	return $item_output;
}

add_filter( 'walker_nav_menu_start_el', 'arche_add_description', 10, 2 );

/**
 * Add custom item to WP menu.
 *
 * Adding phone-number menu item to primary nav.
 *
 * @link http://www.wpbeginner.com/wp-themes/how-to-add-custom-items-to-specific-wordpress-menus/
 */
function arche_add_call_menu_item( $items, $args ) {
    if($args->theme_location == 'primary') {
        $items .= '<li id="menu-item-call" class="call-link menu-item menu-item-type-custom menu-item-object-custom menu-item-call"><a href="tel:+4259397959">Call Us Today<span class="menu-description">(425)-939-7959</span></a></li>';
    }
    return $items;
}

add_filter( 'wp_nav_menu_items', 'arche_add_call_menu_item', 10, 2);

/* Responsive header code
--------------------------------------------- */

/**
 * Create responsive header markup.
 *
 * Uses the figure tag with data-media variable to load responsive images.
 *
 * @link http://www.webdesignerdepot.com/2012/09/creating-a-responsive-header-in-wordpress-3-4/
 */
function arche_header_image_markup(){
	
	//* get full-size image
	$custom_header = get_custom_header();
	$large = esc_url($custom_header->url);
	$minimal = $medium = '';
	    
	//* get smaller sizes of image
	if(isset($custom_header->attachment_id)) { //uploaded image

		$medium_src = wp_get_attachment_image_src(intval($custom_header->attachment_id), 'header_medium', false);
		if(isset($medium_src[0]))
		    $medium = esc_url($medium_src[0]);

		$minimal_src = wp_get_attachment_image_src(intval($custom_header->attachment_id), 'header_minimal', false);
		if(isset($minimal_src[0]))
		    $minimal = esc_url($minimal_src[0]);
	    
	} else { //default image

		$medium = esc_url(str_replace('-large', '-small', $custom_header->url));
		$minimal = esc_url(str_replace('-large', '-thumb', $custom_header->url));
	}

	//* fallback for some unexpected errors
	if(empty($medium))
	    $medium = $large;

	if(empty($minimal))
	    $minimal = $large;
	
	//* Create markup
	?>
	<figure id="header-image" data-media="<?php echo $minimal;?>" data-media481="<?php echo $medium;?>" data-media1025="<?php echo $large;?>">
	    <noscript>
	        <img src="<?php echo $large;?>">
	    </noscript>
	</figure>
	<?php
}

/**
 * Load responsive header markup.
 *
 * Resposible for showing alternate responsive header image depending on viewed page.
 *
 * @see arche_header_image_markup()
 */
function arche_do_header_image() {

	if (is_page_template('landing-page.php')) {
		?>
		<figure id="header-image" data-media="<?php echo get_stylesheet_directory_uri(); ?>/images/landing/young-girls-minimal.jpg" data-media481="<?php echo get_stylesheet_directory_uri(); ?>/images/landing/young-girls-medium.jpg" data-media1025="<?php echo get_stylesheet_directory_uri(); ?>/images/landing/young-girls-large.jpg">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/landing/young-girls-large.jpg">
		</figure>
		<?php
		
	} else {
		echo '<div id="site-header-image">';
		arche_header_image_markup();
		echo '<title>';
			wp_title('');
		echo '</title>';
		echo '</div>';
	}
}

add_action( 'genesis_header', 'arche_do_header_image', 12 );

/**
 * Add footer content.
 *
 * This content can be customized from WP-Admin screen under 'Arche Settings'.
 */
function arche_footer_content() { 
?>
<div class="footer-about-us">

	<div class="footer-area m-footer-logo">
		<a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-shadow-white.png" title="<?php bloginfo('name'); ?>" alt="<?php bloginfo('name'); ?>" />
		</a>
	</div>

	<div class="footer-area m-footer-text">
		<h1>Welcome to <?php bloginfo('name'); ?></h1>
		<h2><?php bloginfo('description'); ?></h2>
		<?php
			$arche_settings = get_option('arche-settings');
			echo $arche_settings['footer-text'];
		?>
	</div>

</div>
<? }

add_action( 'genesis_footer', 'arche_footer_content' );

/**
 * Customize the copyright footer.
 *
 * @link http://my.studiopress.com/snippets/footer/
 */
function arche_do_footer() {
?>	
	<div class="copyright">
		<div class="inner">&copy <?php echo date('Y'); ?> <a href="<?php bloginfo('url'); ?>">Integrity Christian Counseling</a></div>	
	</div>
<? }

remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action( 'genesis_footer', 'arche_do_footer' );

/**
 * Add custom body class.
 *
 * Add landing page class to body element.
 *
 * @link http://my.studiopress.com/snippets/custom-body-class/
 */
function arche_body_class( $classes ) {
	if ( is_page( 'start' ))
		$classes[] = 'start';
		return $classes;
}

add_filter( 'body_class', 'arche_body_class' );


/* Enqueue scripts and styles
--------------------------------------------- */

/**
 * Enqueue jquery scripts.
 */
function arche_enqueue_scripts_styles() {
	
	//* Enqueue Scripts
	wp_enqueue_script( 'modernizr', get_bloginfo( 'stylesheet_directory' ) . '/js/min/modernizr-min.js', array( 'jquery' ), '2.8.3', true );
	wp_enqueue_script( 'arche-responsive-menu', get_bloginfo( 'stylesheet_directory' ) . '/js/min/responsive-menu-ck.js', array( 'jquery' ), true );
	wp_enqueue_script( 'jquery-picture', get_bloginfo( 'stylesheet_directory' ) . '/js/min/jquery-picture-min.js', array( 'jquery' ), '0.9', true );
	wp_enqueue_script( 'owl-carousel', get_bloginfo( 'stylesheet_directory' ) . '/js/min/owl.carousel.min.js', array( 'jquery' ), '1.3.3', true );
	wp_enqueue_script( 'icheck', get_bloginfo( 'stylesheet_directory' ) . '/js/min/icheck.min.js', array( 'jquery' ), '1.0.2', true );
	//wp_enqueue_script( 'contenthover', get_bloginfo( 'stylesheet_directory' ) . '/js/min/jquery.contenthover.min.js', array( 'jquery' ), '0.1', true );
	wp_enqueue_script( 'enquire', get_bloginfo( 'stylesheet_directory' ) . '/js/min/enquire.min.js', array( 'jquery', 'readmore' ), '2.1.2', true );
	wp_enqueue_script( 'readmore', get_bloginfo( 'stylesheet_directory' ) . '/js/min/readmore.min.js', array( 'jquery' ), true );
	wp_enqueue_script( 'arche-scripts', get_bloginfo( 'stylesheet_directory' ) . '/js/min/scripts-min.js', array( 'jquery', 'jquery-picture', 'owl-carousel', 'icheck', 'enquire', 'readmore' ), true );	
		
	//* Enqueue Styles
	wp_enqueue_style( 'icheck-flat', get_bloginfo( 'stylesheet_directory' ) . '/css/icheck/skins/minimal/grey.css' );
	wp_enqueue_style( 'dashicons' );
}

add_action( 'wp_enqueue_scripts', 'arche_enqueue_scripts_styles' );

/**
 * Enqueue ie style sheets.
 */
function ie_style_sheets () {

	//* Add supporting style sheet ie8
	wp_register_style( 'ie8', get_bloginfo( 'stylesheet_directory' ) . '/css/ie8.css'  );
	$GLOBALS['wp_styles']->add_data( 'ie8', 'conditional', 'lte IE 8' );
	wp_enqueue_style( 'ie8' );
}

add_action ('wp_enqueue_scripts','ie_style_sheets');

/* General cleanup of unwanted stuff
--------------------------------------------- */

/**
 * Remove RSD link.
 */
remove_action( 'wp_head', 'rsd_link' );

/**
 * Remove comment feed.
 *
 * After we remove all feeds, we add the post feed back in.
 */
function arche_add_post_feed_link() {
    echo '<link rel="alternate" type="application/rss+xml" title="RSS 2.0 Feed" href="'.get_bloginfo('rss2_url').'" />'; 
}

remove_action('wp_head', 'feed_links', 2 );
add_action('wp_head', 'arche_add_post_feed_link');

/**
 * Remove comment reply script.
 */
function arche_remove_comment_reply(){
	wp_deregister_script( 'comment-reply' );
}

add_action('init','arche_remove_comment_reply');