<?php
/************************************************************
0 Utility functions
************************************************************/

if ( !function_exists( '_arche_log' ) ) {
	function _arche_log( $var, $message = '' ) {
		if ( WP_DEBUG === true ) {
			if ( ! empty( $message ) ) {
				error_log( $message );
			}
			if ( is_array( $var ) || is_object( $var ) ) {
				error_log( print_r( $var, true ) );
			} else {
				error_log( $var );
			}
		}
	}
}

function _arche_get_counselor_profile_id( $counselor_profile_id ) {
	if ( !$counselor_profile_id ) {
		global $post;
		if ( 'counselor-profile' === get_post_type( $post ) ) {
			return $post->ID;
		}
	} else {
		if ( 'counselor-profile' === get_post_type( $counselor_profile_id ) ) {
			return $counselor_profile_id;
		}
	}

	return false;
}

function _arche_get_youtube_id_from_url( $url ) {
	parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
	return $my_array_of_vars['v'];
}

function _arche_format_telephone_number( $telephone_number ) {
	$formatted_number = "";

	if ( !empty( $telephone_number['country-code'] ) ) {
		$formatted_number .= "+" . $telephone_number['country-code'] . ' ';
	}

	$number = "" . $telephone_number['area-code'] . $telephone_number['subscriber-number'];

	$areaCode  = substr( $number, 0, 3 );
	$nextThree = substr( $number, 3, 3 );
	$lastFour  = substr( $number, 6, 4 );

	$formatted_number .= '(' . $areaCode . ') ' . $nextThree . '-' . $lastFour;

	if ( !empty( $telephone_number['extension'] ) ) {
		$formatted_number .= " x" . $telephone_number['extension'];
	}

	return $formatted_number;
}

function _arche_unformat_telephone_number( $telephone_number ) {
	$unformatted_number = "";
	if ( !empty( $telephone_number['country-code'] ) ) {
		$unformatted_number .= "+" . $telephone_number['country-code'];
	}
	$unformatted_number .= $telephone_number['area-code'];
	$unformatted_number .= $telephone_number['subscriber-number'];
	if ( !empty( $telephone_number['extension'] ) ) {
		$unformatted_number .= "," . $telephone_number['extension'];
	}

	return $unformatted_number;
}


/************************************************************
1 Front Page functions
************************************************************/


/************************************************************
1.a Front Page intro section
************************************************************/
function arche_get_front_page_intro_text() {
	$page_id = get_option( 'page_on_front' );

	if ( !empty( $page_id ) ) {
		return get_post_meta( $page_id, 'intro-text', true );
	}

	return false;
}

function arche_the_front_page_intro_text() {
	$intro_text = arche_get_front_page_intro_text();

	if ( $intro_text ) {
		echo esc_html( $intro_text );
	}
}


/************************************************************
1.b Front Page what we do section
************************************************************/
function _arche_get_front_page_what_we_do() {
	$page_id = get_option( 'page_on_front' );

	if ( !empty( $page_id ) ) {
		return get_post_meta( $page_id, 'frontpage-what-we-do', true );
	}

	return false;
}

function arche_get_front_page_what_we_do_video_image_html() {
	$what_we_do = _arche_get_front_page_what_we_do();

	if ( !empty( $what_we_do ) && isset( $what_we_do['video-image'] ) ) {
		$image_atts = wp_get_attachment_image_src( $what_we_do['video-image'], 'profile-landscape' );
		$image_alt  = trim( strip_tags( get_post_meta( $what_we_do['video-image'], '_wp_attachment_image_alt', true ) ) );
		$image_html = "<img src='" . esc_url( $image_atts[0] ) . "' alt='" . esc_attr( $image_alt ) . "' />";
		return $image_html;
	}

	return '';
}

function arche_the_front_page_what_we_do_video_image_html() {
	$image_html = arche_get_front_page_what_we_do_video_image_html();

	if ( !empty( $image_html ) ) {
		echo $image_html;
	}
}


function arche_get_front_page_what_we_do_video_html() {
	$what_we_do = _arche_get_front_page_what_we_do();

	if ( !empty( $what_we_do ) && isset( $what_we_do['video'] ) ) {
		return wp_oembed_get( $what_we_do['video'] );
	}

	return '';
}

function arche_the_front_page_what_we_do_video_html() {
	$video_html = arche_get_front_page_what_we_do_video_html();

	if ( !empty( $video_html ) ) {
		echo $video_html;
	}
}

function arche_get_front_page_what_we_do_video_id() {
	$what_we_do = _arche_get_front_page_what_we_do();

	if ( !empty( $what_we_do ) && isset( $what_we_do['video'] ) ) {
		return _arche_get_youtube_id_from_url( $what_we_do['video'] );
	}

	return '';
}

function arche_the_front_page_what_we_do_video_id() {
	$video_id = arche_get_front_page_what_we_do_video_id();

	if ( !empty( $video_id ) ) {
		echo $video_id;
	}
}

function arche_get_front_page_what_we_do_text() {
	$what_we_do = _arche_get_front_page_what_we_do();

	if ( !empty( $what_we_do ) && isset( $what_we_do['text'] ) ) {
		return apply_filters( 'the_content', $what_we_do['text'] );
	}

	return '';
}

function arche_the_front_page_what_we_do_text() {
	$text = arche_get_front_page_what_we_do_text();

	if ( !empty( $text ) ) {
		echo $text;
	}
}


/************************************************************
1.c Front Page how it works section
************************************************************/
function _arche_get_front_page_how_it_works() {
	$page_id = get_option( 'page_on_front' );

	if ( !empty( $page_id ) ) {
		return get_post_meta( $page_id, 'frontpage-how-it-works', true );
	}

	return false;
}

function arche_get_front_page_how_it_works_image_html() {
	$how_it_works = _arche_get_front_page_how_it_works();

	if ( !empty( $how_it_works ) && isset( $how_it_works['image'] ) ) {
		$image_atts = wp_get_attachment_image_src( $how_it_works['image'], 'profile-landscape' );
		$image_alt  = trim( strip_tags( get_post_meta( $how_it_works['image'], '_wp_attachment_image_alt', true ) ) );
		$image_html = "<img src='" . esc_url( $image_atts[0] ) . "' width='" . esc_attr( $image_atts[1] ) . "' height='" . esc_attr( $image_atts[2] ) . "' alt='" . esc_attr( $image_alt ) . "' />";
		return $image_html;
	}

	return '';
}

function arche_the_front_page_how_it_works_image_html() {
	$image_html = arche_get_front_page_how_it_works_image_html();

	if ( !empty( $image_html ) ) {
		echo $image_html;
	}
}

function arche_get_front_page_how_it_works_text() {
	$how_it_works = _arche_get_front_page_how_it_works();

	if ( !empty( $how_it_works ) && isset( $how_it_works['text'] ) ) {
		return apply_filters( 'the_content', $how_it_works['text'] );
	}

	return '';
}

function arche_the_front_page_how_it_works_text() {
	$text = arche_get_front_page_how_it_works_text();

	if ( !empty( $text ) ) {
		echo $text;
	}
}

function arche_get_front_page_how_it_works_button_text() {
	$how_it_works = _arche_get_front_page_how_it_works();

	if ( !empty( $how_it_works ) && isset( $how_it_works['button-text'] ) ) {
		return esc_html( $how_it_works['button-text'] );
	}

	return '';
}

function arche_the_front_page_how_it_works_button_text() {
	$text = arche_get_front_page_how_it_works_button_text();

	if ( !empty( $text ) ) {
		echo $text;
	}
}

function arche_get_front_page_how_it_works_button_link() {
	$how_it_works = _arche_get_front_page_how_it_works();

	if ( !empty( $how_it_works ) && isset( $how_it_works['button-link-page'] ) ) {
		return get_permalink( $how_it_works['button-link-page'] );
	}

	return '';
}

function arche_the_front_page_how_it_works_button_link() {
	$link = arche_get_front_page_how_it_works_button_link();

	if ( !empty( $link ) ) {
		echo $link;
	}
}


/************************************************************
1.d Front Page testimonials section
************************************************************/
function _arche_get_front_page_testimonials() {
	$page_id = get_option( 'page_on_front' );

	if ( !empty( $page_id ) ) {
		return get_post_meta( $page_id, 'frontpage-testimonials', true );
	}

	return false;
}

function arche_get_front_page_testimonials_background_image_url( $image_size = 'full' ) {
	$testimonials = _arche_get_front_page_testimonials();

	if ( !empty( $testimonials ) && isset( $testimonials['background-image'] ) ) {
		$image_data = wp_get_attachment_image_src( $testimonials['background-image'], $image_size );
		if ( is_array( $image_data ) ) {
			return $image_data[0];
		}
	}

	return '';
}

function arche_the_front_page_testimonials_background_image_url( $image_size = 'full' ) {
	$image_url = arche_get_front_page_testimonials_background_image_url( $image_size );

	if ( !empty( $image_url ) ) {
		echo $image_url;
	}
}

/************************************************************
1.e Front Page articles section
************************************************************/
function _arche_get_front_page_articles() {
	$page_id = get_option( 'page_on_front' );

	if ( !empty( $page_id ) ) {
		return get_post_meta( $page_id, 'frontpage-articles', true );
	}

	return false;
}

function arche_get_front_page_articles_excerpt_length() {
	$articles = _arche_get_front_page_articles();

	if ( !empty( $articles ) && isset( $articles['excerpt-length'] ) ) {
		return intval( $articles['excerpt-length'] );
	}

	return '';
}

function arche_the_front_page_articles_excerpt_length() {
	$length = arche_get_front_page_articles_excerpt_length();

	if ( !empty( $length ) ) {
		echo $length;
	}
}

function arche_get_front_page_articles_max_tags() {
	$articles = _arche_get_front_page_articles();

	if ( !empty( $articles ) && isset( $articles['max-tags'] ) ) {
		return intval( $articles['max-tags'] );
	}

	return '';
}

function arche_the_front_page_articles_max_tags() {
	$max_tags = arche_get_front_page_articles_max_tags();

	if ( !empty( $max_tags ) ) {
		echo $max_tags;
	}
}

/************************************************************
2 Counselor Profile functions
************************************************************/
function arche_get_counselor_profile_name( $counselor_profile_id ) {
	return get_the_title( $counselor_profile_id );
}

function arche_the_counselor_profile_name( $counselor_profile_id ) {
	$name = arche_get_counselor_profile_name( $counselor_profile_id );

	if ( !empty( $name ) ) {
		echo $name;
	}
}

function arche_get_counselor_profile_permalink_name_anchor( $counselor_profile_id ) {
	$counselor_profile_id = _arche_get_counselor_profile_id( $counselor_profile_id );
	if ( !$counselor_profile_id ) {
		return '';
	}

	$permalink = get_permalink( $counselor_profile_id );
	$name      = arche_get_counselor_profile_name( $counselor_profile_id );

	if ( !empty( $permalink ) && !empty( $name ) ) {
		return sprintf( __( '<a href="%1$s" title="View %2$s\'s profile">%3$s</a>', 'arche' ), esc_url( $permalink ), esc_attr( $name ), esc_html( $name ) );
	}

	return '';
}

function arche_the_counselor_profile_permalink_name_anchor( $counselor_profile_id ) {
	$name_link = arche_get_counselor_profile_permalink_name_anchor( $counselor_profile_id );

	if ( !empty( $name_link ) ) {
		echo $name_link;
	}
}

function arche_get_counselor_profile_credentials( $counselor_profile_id ) {
	$creds = wp_get_object_terms( $counselor_profile_id, 'credential', array( 'orderby' => 'term_order', 'order' => 'ASC', 'fields' => 'names' ) );

	if ( !empty( $creds ) && !is_wp_error( $creds ) ) {
		return implode( ', ', $creds );
	}

	return '';
}

function arche_the_counselor_profile_credentials( $counselor_profile_id ) {
	$creds = arche_get_counselor_profile_credentials( $counselor_profile_id );

	if ( !empty( $creds ) ) {
		echo $creds;
	}
}

function arche_get_counselor_profile_name_credentials( $counselor_profile_id, $glue = ', ' ) {
	$name = arche_get_counselor_profile_name( $counselor_profile_id );
	$cred = arche_get_counselor_profile_credentials( $counselor_profile_id );

	if ( !empty( $cred ) ) {
		$name = $name . $glue . $cred;
	}

	return $name;
}

function arche_the_counselor_profile_name_credentials( $counselor_profile_id, $glue = ', ' ) {
	$name = arche_get_counselor_profile_name_credentials( $counselor_profile_id, $glue );

	if ( !empty( $name ) ) {
		echo $name;
	}
}

function arche_get_counselor_profile_image_html( $counselor_profile_id, $image_size = 'profile-landscape' ) {
	$counselor_profile_id = _arche_get_counselor_profile_id( $counselor_profile_id );
	if ( !$counselor_profile_id ) {
		return '';
	}

	$title  = arche_get_counselor_profile_name( $counselor_profile_id );

	$image_id   = get_post_thumbnail_id( $counselor_profile_id );
	$image_atts = wp_get_attachment_image_src( $image_id, $image_size );
	$image_alt  = sprintf( __( 'Photo of %s', 'arche' ), $title );

	if(is_array($image_size)){
		$image_size = implode('x', $image_size);
	}

	$image_html = "<img class='" . esc_attr( $image_size ) . "' src='" . esc_url( $image_atts[0] ) . "' width='" . esc_attr( $image_atts[1] ) . "' height='" . esc_attr( $image_atts[2] ) . "' alt='" . esc_attr( $image_alt ) . "' />";

	return $image_html;
}

function arche_the_counselor_profile_image_html( $counselor_profile_id, $image_size = 'profile-landscape', $glue = ', ' ) {
	$counselor_profile_image_html = arche_get_counselor_profile_image_html( $counselor_profile_id, $image_size, $glue );

	if ( !empty( $counselor_profile_image_html ) ) {
		echo $counselor_profile_image_html;
	}
}

function arche_get_counselor_profile_image_link_html( $counselor_profile_id, $image_size = 'profile-landscape' ) {
	$counselor_profile_id = _arche_get_counselor_profile_id( $counselor_profile_id );
	if ( !$counselor_profile_id ) {
		return '';
	}

	$link   = get_permalink( $counselor_profile_id );
	$title  = arche_get_counselor_profile_name( $counselor_profile_id );
	$link_title = sprintf( __( 'View %s\'s profile', 'arche' ), $title );
	$image_html = arche_get_counselor_profile_image_html( $counselor_profile_id, $image_size );

	$output = '<a href="' . esc_url( $link ) . '" title="' . esc_attr( $link_title ) . '">' . $image_html . '</a>';

	return $output;
}

function arche_the_counselor_profile_image_link_html( $counselor_profile_id, $image_size = 'profile-landscape', $glue = ', ' ) {
	$counselor_profile_image_link_html = arche_get_counselor_profile_image_link_html( $counselor_profile_id, $image_size, $glue );

	if ( !empty( $counselor_profile_image_link_html ) ) {
		echo $counselor_profile_image_link_html;
	}
}

function _arche_get_counselor_profile_extended_info( $counselor_profile_id ) {
	if ( !empty( $counselor_profile_id ) ) {
		return get_post_meta( $counselor_profile_id, 'extended-info', true );
	}

	return false;
}

function _arche_get_counselor_profile_general_info( $counselor_profile_id ) {
	if ( !empty( $counselor_profile_id ) ) {
		return get_post_meta( $counselor_profile_id, 'general-info', true );
	}

	return false;
}

function _arche_get_counselor_profile_scheduling_info( $counselor_profile_id ) {
	if ( !empty( $counselor_profile_id ) ) {
		return get_post_meta( $counselor_profile_id, 'scheduling-info', true );
	}

	return false;
}

function arche_get_counselor_profile_job_title( $counselor_profile_id ) {
	$extended_info = _arche_get_counselor_profile_extended_info( $counselor_profile_id );

	if ( !empty( $extended_info ) && isset( $extended_info['job-title'] ) ) {
		return $extended_info['job-title'];
	}

	return '';
}

function arche_the_counselor_profile_job_title( $counselor_profile_id ) {
	$job_title = arche_get_counselor_profile_job_title( $counselor_profile_id );

	if ( !empty( $job_title ) ) {
		echo $job_title;
	}
}

function arche_get_counselor_profile_phone( $counselor_profile_id, $formatted = true ) {
	$general_info = _arche_get_counselor_profile_general_info( $counselor_profile_id );

	if ( !empty( $general_info ) && isset( $general_info['phone-number'] ) ) {
		if ( $formatted ) {
			return _arche_format_telephone_number( $general_info['phone-number'] );
		} else {
			return _arche_unformat_telephone_number( $general_info['phone-number'] );
		}
	}

	return '';
}

function arche_the_counselor_profile_phone( $counselor_profile_id, $formatted = true ) {
	$tel = arche_get_counselor_profile_phone( $counselor_profile_id, $formatted );

	if ( !empty( $tel ) ) {
		echo $tel;
	}
}

function arche_get_counselor_profile_phone_link( $counselor_profile_id ) {
	$name              = arche_get_counselor_profile_name( $counselor_profile_id );
	$formatted_phone   = arche_get_counselor_profile_phone( $counselor_profile_id, true );
	$unformatted_phone = arche_get_counselor_profile_phone( $counselor_profile_id, false );

	if ( !empty( $name ) && !empty( $unformatted_phone ) ) {
		return sprintf( __( '<a href="tel:%1$s" title="Contact %2$s">%3$s</a>', 'arche' ), $unformatted_phone, $name, $formatted_phone );
	}

	return '';
}

function arche_the_counselor_profile_phone_link( $counselor_profile_id ) {
	$link = arche_get_counselor_profile_phone_link( $counselor_profile_id );

	if ( !empty( $link ) ) {
		echo $link;
	}
}

function arche_get_counselor_profile_twitter_id( $counselor_profile_id ) {
	$general_info = _arche_get_counselor_profile_general_info( $counselor_profile_id );

	if ( !empty( $general_info ) && isset( $general_info['twitter'] ) ) {
		return $general_info['twitter'];
	}

	return '';
}

function arche_the_counselor_profile_twitter_id( $counselor_profile_id ) {
	$twitter = arche_get_counselor_profile_twitter_id( $counselor_profile_id );

	if ( !empty( $twitter ) ) {
		echo $twitter;
	}
}

function arche_get_counselor_profile_twitter_link( $counselor_profile_id, $target = '_blank' ) {
	$name    = arche_get_counselor_profile_name( $counselor_profile_id );
	$twitter = arche_get_counselor_profile_twitter_id( $counselor_profile_id );

	if ( !empty( $name ) && !empty( $twitter ) ) {
		$link   = esc_url( 'http://twitter.com/' . strtolower( $twitter ) );
		$title  = esc_attr( sprintf( __( 'Follow %1$s on Twitter', 'arche' ), $name ) );
		$target = empty( $target ) ? '' : 'target="' . esc_attr( $target ) . '"';
		return sprintf( '<a href="%1$s" title="%2$s" %3$s>@%4$s</a>', $link, $title, $target, $twitter );
	}

	return '';
}

function arche_the_counselor_profile_twitter_link( $counselor_profile_id, $target = '_blank' ) {
	$twitter_link = arche_get_counselor_profile_twitter_link( $counselor_profile_id, $target );

	if ( !empty( $twitter_link ) ) {
		echo $twitter_link;
	}
}

function arche_get_counselor_profile_short_biography( $counselor_profile_id ) {
	$counselor_profile_id = _arche_get_counselor_profile_id( $counselor_profile_id );
	if ( !$counselor_profile_id ) {
		return '';
	}

	$extended_info = _arche_get_counselor_profile_extended_info( $counselor_profile_id );

	if ( !empty( $extended_info ) && isset( $extended_info['short-biography'] ) ) {
		return $extended_info['short-biography'];
	}

	return '';
}

function arche_the_counselor_profile_short_biography( $counselor_profile_id ) {
	$short_biography = arche_get_counselor_profile_short_biography( $counselor_profile_id );

	if ( !empty( $short_biography ) ) {
		echo $short_biography;
	}
}

function arche_get_counselor_profile_id_from_post( $post_id ) {
	if ( !empty( $post_id ) ) {
		$profile_id =  get_post_meta( $post_id, 'counselor-profile', true );
		return $profile_id;
	}

	return false;
}

function arche_the_counselor_profile_id_from_post( $post_id ) {
	$counselor_profile_id = arche_get_counselor_profile_id_from_post( $post_id );

	if ( !empty( $counselor_profile_id ) ) {
		echo $counselor_profile_id;
	}
}

function arche_get_counselor_profile_limited_slots_available($counselor_profile_id = null ) {
	$counselor_profile_id = _arche_get_counselor_profile_id( $counselor_profile_id );
	if ( !$counselor_profile_id ) {
		return '';
	}

	$scheduling_info = _arche_get_counselor_profile_scheduling_info( $counselor_profile_id );

	if ( !empty( $scheduling_info ) && isset( $scheduling_info['limited-slots-available'] ) ) {
		return $scheduling_info['limited-slots-available'];
	}

	return false;
}

function arche_get_counselor_directory_json() {

	if (ARCHE_CACHE) {
		$json_cache = get_transient( 'arche-counselor-directory-json-cache' );
	} else {
		$json_cache = false;		
	}

	if ( !empty( $json_cache ) ) {
		return $json_cache;
	}

	$counselor_profiles = get_posts( array(
			'posts_per_page'   => -1,
			'offset'           => 0,
			'orderby'          => 'post_date',
			'order'            => 'DESC',
			'post_type'        => 'counselor-profile',
			'post_status'      => 'publish',
			'suppress_filters' => true
		)
	);

	$counselor_profiles_json = array();

	foreach ( $counselor_profiles as $cp ) {
		$image_id   = get_post_thumbnail_id( $cp->ID );
		$image_atts = wp_get_attachment_image_src( $image_id, 'profile-landscape' );

		$data = array(
			'id'                      => $cp->ID,
			'name'                    => arche_get_counselor_profile_name( $cp->ID ),
			'url'                     => get_permalink( $cp->ID ),
			'image_url'               => esc_url( $image_atts[0] ),
			'bio'                     => arche_get_counselor_profile_short_biography( $cp->ID ),
			'schedule_url'            => '#',
			'limited_slots_available' => true,
			'telephone'               => arche_get_counselor_profile_phone_link( $cp->ID ),
			'services'                => wp_get_object_terms( $cp->ID, 'service', array( 'orderby' => 'term_order', 'order' => 'ASC', 'fields' => 'slugs' ) ),
			'credentials'             => wp_get_object_terms( $cp->ID, 'credential', array( 'orderby' => 'term_order', 'order' => 'ASC', 'fields' => 'slugs' ) ),
			'locations'               => wp_get_object_terms( $cp->ID, 'location', array( 'fields' => 'slug' ) )
		);

		$counselor_profiles_json[] = $data;
	}

	$services_json = array();

	$services = get_terms( 'service', array( 'hide_empty' => false ) );
	if ( !empty( $services ) && !is_wp_error( $services ) ) {
		foreach ( $services as $service ) {
			$services_json[$service->slug] = $service->name;
		}
	}

	$locations_json = array();
	$locations_order_json = array();

	require_once 'class-arche-location-query.php';

	$locations = get_posts( array( 'post_type' => 'location', 'posts_per_page' => -1, 'orderby' => 'title' ) );
	if ( !empty( $locations ) && !is_wp_error( $locations ) ) {

		global $post;

		foreach ( $locations as $location ) {
			$locations_json[$location->post_name] = $location->post_title;

			$get_posts_args = array(
				'posts_per_page'   => -1,
				'offset'           => 0,
				'orderby'          => 'distance',
				'order'            => 'ASC',
				'post_type'        => 'location',
				'post_status'      => 'publish',
				'suppress_filters' => false,
				'latlng'           => arche_get_location_lat_lng($location->ID),
				'distance'         => '100',
				'distance_unit'    => 'mi'
			);

			$location_query    = new Arche_Location_Query( $get_posts_args );
			$location_list     = array();

			// The Loop
			if ( $location_query->have_posts() ) {
				while ( $location_query->have_posts() ) {
					$location_query->the_post();
					$location_list[$post->post_name] = get_the_title() . ' (' . round( $post->distance, 2) . ' Miles)';
				}
			}
			/* Restore original Post Data */
			wp_reset_postdata();
			
			$locations_order_json[$location->post_name] = $location_list;
		}
	}

	$return_string  = 'var Counselors = ' . json_encode( $counselor_profiles_json );
	$return_string .= ', Services = ' . json_encode( $services_json );
	$return_string .= ', Locations = ' . json_encode( $locations_json );
	$return_string .= ', LocationProximity = ' . json_encode($locations_order_json) . ';';


	// Cache the results for one week
	if (ARCHE_CACHE) {
		set_transient( 'arche-counselor-directory-json-cache', $return_string, WEEK_IN_SECONDS );
	}

	return $return_string;
}
