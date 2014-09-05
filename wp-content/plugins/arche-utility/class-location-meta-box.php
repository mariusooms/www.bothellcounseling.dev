<?php

/**
 * Calls the class on the post edit screen.
 */
function call_Location_Meta_Box() {
    new Location_Meta_Box();
}

if ( is_admin() ) {
    add_action( 'load-post.php', 'call_Location_Meta_Box' );
    add_action( 'load-post-new.php', 'call_Location_Meta_Box' );
}

/** 
 * The Class.
 */
class Location_Meta_Box {

	/**
	 * Hook into the appropriate actions when the class is constructed.
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save' ), 10, 2 );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_js' ) );
	    add_action( 'admin_head', array( $this, 'inline_style'));
	}

	/**
	 * Adds the meta box container.
	 */
	public function add_meta_box( $post_type ) {
            $post_types = array('location');
            if ( in_array( $post_type, $post_types )) {
				add_meta_box(
					'location_meta_box',
					__( 'GeoLocation Details', 'arche' ),
					array( $this, 'render_meta_box_content' ),
					$post_type,
					'advanced',
					'high'
				);
            }
	}

	/**
	 * Save the meta when the post is saved.
	 *
	 * @param int $post_id The ID of the post being saved.
	 */
	public function save( $post_id, $post ) {
	
		/*
		 * We need to verify this came from the our screen and with proper authorization,
		 * because save_post can be triggered at other times.
		 */

		// Check if our nonce is set.
		if ( ! isset( $_POST['location_meta_box_nonce'] ) )
			return $post_id;

		$nonce = $_POST['location_meta_box_nonce'];

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, 'location_meta_box_' . $post->ID ) )
			return $post_id;

		// If this is an autosave, our form has not been submitted,
                //     so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			return $post_id;

		$post_type_object = get_post_type_object( $post->post_type );

		if ( ! current_user_can( $post_type_object->cap->edit_post, $post_id ) )
			return $post_id;

		/* OK, its safe for us to save the data now. */

		// Sanitize the user input.
		$lat     = floatval( $_POST['lmb_lat'] );
		$lng     = floatval( $_POST['lmb_lng'] );
		$address = array_map('sanitize_text_field', $_POST['lmb_address'] );

		// Update the meta field.
		update_post_meta( $post_id, '_lmb_lat', $lat );
		update_post_meta( $post_id, '_lmb_lng', $lng );
		update_post_meta( $post_id, '_lmb_address', $address );
	}


	/**
	 * Render Meta Box content.
	 *
	 * @param WP_Post $post The post object.
	 */
	public function render_meta_box_content( $post ) {
	
		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'location_meta_box_' . $post->ID, 'location_meta_box_nonce' );
		$lat      = get_post_meta( $post->ID, '_lmb_lat', true );
		$lng      = get_post_meta( $post->ID, '_lmb_lng', true );
		$address  = get_post_meta( $post->ID, '_lmb_address', true );
		$defaults = array(
			'raw'          => '',
			'formatted'    => '',
			'street'       => '',
			'streetnumber' => '',
			'postal'       => '',
			'city'         => '',
			'state'        => '',
			'state_short'  => '',
			'country'      => ''
		);

		$lat     = empty($lat) ? '' : floatval( $lat );
		$lng     = empty($lng) ? '' : floatval( $lng );
		$address = wp_parse_args( $address, $defaults );
		require_once 'location-meta-box-content.php';
	}

	public function enqueue_js() {
			wp_enqueue_script( 'lmb-google-maps', '//maps.googleapis.com/maps/api/js?sensor=false&libraries=places', array( ), '3', true );
			wp_enqueue_script( 'lmb-script', plugins_url( 'javascript/jquery.geocomplete.js' , __FILE__ ), array( 'lmb-google-maps', 'jquery' ), '1.0.0', true );		
	}

	public function inline_style() {
		?>
<style type="text/css">
.map-container {
    position: relative;
    padding-bottom: 30%;
    width: 99%;
    /*padding-top: 30px;*/
    height: 0;
    overflow: hidden;
}
.map-container>div {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}	
</style>
		<?php
	}
}