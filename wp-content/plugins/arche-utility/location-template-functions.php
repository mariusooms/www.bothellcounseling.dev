<?php
function _arche_get_location_id( $location_id ) {
	if ( !$location_id ) {
		global $post;
		if ( 'location' === get_post_type( $post ) ) {
			return $post->ID;
		}
	} else {
		if ( 'location' === get_post_type( $location_id ) ) {
			return $location_id;
		}
	}

	return false;
}

function arche_get_location_name( $location_id ) {
	return get_the_title( $location_id );
}

function arche_the_location_name( $location_id ) {
	$name = arche_get_location_name( $location_id );

	if ( !empty( $name ) ) {
		echo $name;
	}
}

function arche_get_location_image_link_html( $location_id = null, $image_size = 'location-landscape', $image_class = 'lazyOwl' ) {
	$location_id = _arche_get_location_id( $location_id );
	if ( !$location_id ) {
		return '';
	}

	$link   = get_permalink( $location_id );
	$title  = arche_get_location_name( $location_id );

	$image_id   = get_post_thumbnail_id( $location_id );
	$image_atts = wp_get_attachment_image_src( $image_id, $image_size );
	$image_alt  = sprintf( __( 'Photo of the %s office', 'arche' ), $title );
	$link_title = sprintf( __( 'View %s office details', 'arche' ), $title );
	$image_class = empty($image_class) ? '' : " class='" . $image_class . "'";
	$image_html = "<img src='" . esc_url( $image_atts[0] ) . "'" . $image_class . " width='" . esc_attr( $image_atts[1] ) . "' height='" . esc_attr( $image_atts[2] ) . "' alt='" . esc_attr( $image_alt ) . "' />";

	$output = '<a href="' . esc_url( $link ) . '" title="' . esc_attr( $link_title ) . '" class="location-image" >' . $image_html . '</a>';

	return $output;
}

function arche_the_location_image_link_html( $location_id = null, $image_size = 'location-landscape', $image_class = 'lazyOwl'  ) {
	$location_image_link_html = arche_get_location_image_link_html( $location_id, $image_size, $image_class );

	if ( !empty( $location_image_link_html ) ) {
		echo $location_image_link_html;
	}
}

function arche_get_location_permalink_name_anchor( $location_id = null ) {
	$location_id = _arche_get_location_id( $location_id );
	if ( !$location_id ) {
		return '';
	}

	$permalink = get_permalink( $location_id );
	$name      = arche_get_location_name( $location_id );

	if ( !empty( $permalink ) && !empty( $name ) ) {
		return sprintf( __( '<a href="%1$s" title="View %2$s office details">%3$s</a>', 'arche' ), esc_url( $permalink ), esc_attr( $name ), esc_html( $name ) );
	}

	return '';
}

function arche_the_location_permalink_name_anchor( $location_id = null ) {
	$name_link = arche_get_location_permalink_name_anchor( $location_id );

	if ( !empty( $name_link ) ) {
		echo $name_link;
	}
}

function _arche_get_location_address( $location_id = null ) {
	$location_id = _arche_get_location_id( $location_id );
	if ( !$location_id ) {
		return '';
	}

	return get_post_meta( $location_id, '_lmb_address', true );

	return false;
}

function _arche_get_location_general_info( $location_id ) {
	$location_id = _arche_get_location_id( $location_id );
	if ( !$location_id ) {
		return '';
	}
	return get_post_meta( $location_id, 'general-info', true );
}

function arche_get_location_state( $location_id = null ) {
	$address = _arche_get_location_address( $location_id );

	if ( !empty( $address ) && isset( $address['state'] ) ) {
		return $address['state'];
	}

	return '';

}

function arche_the_location_state( $location_id = null ) {
	$state = arche_get_location_state( $location_id );

	if ( !empty( $state ) ) {
		echo $state;
	}
}

function arche_get_location_street_number( $location_id = null ) {
	$address = _arche_get_location_address( $location_id );

	if ( !empty( $address ) && isset( $address['streetnumber'] ) ) {
		return $address['streetnumber'];
	}

	return '';	
}

function arche_the_location_street_number( $location_id = null ) {
	$number = arche_get_location_street_number( $location_id );

	if ( !empty( $number ) ) {
		echo $number;
	}
}

function arche_get_location_city( $location_id = null ) {
	$address = _arche_get_location_address( $location_id );

	if ( !empty( $address ) && isset( $address['city'] ) ) {
		return $address['city'];
	}

	return '';	
}

function arche_the_location_city( $location_id = null ) {
	$city = arche_get_location_city( $location_id );

	if ( !empty( $city ) ) {
		echo $city;
	}
}

function arche_get_location_state_short( $location_id = null ) {
	$address = _arche_get_location_address( $location_id );

	if ( !empty( $address ) && isset( $address['state_short'] ) ) {
		return $address['state_short'];
	}

	return '';	
}

function arche_the_location_state_short( $location_id = null ) {
	$state_short = arche_get_location_state_short( $location_id );

	if ( !empty( $state_short ) ) {
		echo $state_short;
	}
}

function arche_get_location_postal( $location_id = null ) {
	$address = _arche_get_location_address( $location_id );

	if ( !empty( $address ) && isset( $address['postal'] ) ) {
		return $address['postal'];
	}

	return '';	
}

function arche_the_location_postal( $location_id = null ) {
	$postal = arche_get_location_postal( $location_id );

	if ( !empty( $postal ) ) {
		echo $postal;
	}
}


function arche_get_location_street_address( $location_id = null ) {
	$address = _arche_get_location_address( $location_id );

	if ( !empty( $address ) && isset( $address['street'] ) ) {
		return $address['street'];
	}

	return '';	
}


function arche_the_location_street_address( $location_id = null ) {
	$street = arche_get_location_street_address( $location_id );

	if ( !empty( $street ) ) {
		echo $street;
	}
}

function arche_get_location_phone( $location_id = null ) {
	$general_info = _arche_get_location_general_info( $location_id );

	if ( !empty( $general_info ) && isset( $general_info['phone-number'] ) ) {
		return $general_info['phone-number'];
	}

	return '';
}

function arche_the_location_phone( $location_id = null ) {
	$tel = arche_get_location_phone( $location_id );

	if ( !empty( $tel ) ) {
		echo $tel;
	}
}

/**
 *
 *
 * @todo   need to format phone number. Maybe split up into parts.
 */
function arche_get_location_phone_link( $location_id = null ) {
	$name  = arche_get_location_name( $location_id );
	$phone = arche_get_location_phone( $location_id );

	if ( !empty( $name ) && !empty( $phone ) ) {
		return sprintf( __( '<a href="tel:%1$s" title="Contact our %2$s office ">%3$s</a>', 'arche' ), $phone, $name, $phone );
	}

	return '';
}

function arche_the_location_phone_link( $location_id = null ) {
	$link = arche_get_location_phone_link( $location_id );

	if ( !empty( $link ) ) {
		echo $link;
	}
}

function arche_get_location_lat_lng( $location_id = null ) {
	$location_id = _arche_get_location_id( $location_id );
	if ( !$location_id ) {
		return '';
	}
	
	$lat = get_post_meta( $location_id, '_lmb_lat', true );
	$lng = get_post_meta( $location_id, '_lmb_lng', true );

	if(false !== $lat && false !== $lng ) {
		return array(
			'lat' => $lat,
			'lng' => $lng
		);
	}

	return false;
}