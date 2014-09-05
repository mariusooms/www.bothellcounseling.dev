<?php
/**********************************************************
Create Meta
**********************************************************/

// Testimonial counsellor fields
$fields_counsellor = array(
	'counselor-profile' => array(
		'type'        => 'postselect',
		'class'       => 'text_large',
		'label'       => 'Counselor',
		'required'    => true,
		'multiple'    => false,
		'sortable'    => false,
		'select2'     => true,
		'post_type'   => 'counselor-profile',
		'id_or_slug'  => 'id',
		'placeholder' => 'Select counselor',
		'description' => 'Select the counselor to which this applies.',
		'show_column' => true
	),
);
// Testimonial info  metabox
new TH_Post_Meta(
	array(
		'id'         => 'counselor-profile',
		'title'      => 'Counselor Profile',
		'post_types' => array( 'post' ),      // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => false,                // Show field names on the left
		'save_mode'  => 'individual',         // single or individual
		'fields'     => $fields_counsellor,
	)
);

// Featured checkbox
$arche_featured_field = array(
	'featured' => array(
		'type'        => 'checkbox',
		'label'       => 'Feature this ',
		'required'    => false,
		'description' => 'Check this to feature this.',
		'show_column' => false
	),
);
function arche_feature_box_fields( $fields ) {
	global $post;
	$obj = get_post_type_object( get_post_type( $post ) );
	if ( $obj ) {
		$label = strtolower( $obj->labels->singular_name );
	} else {
		$label = '';
	}

	$fields['featured'] = array(
		'type'        => 'checkbox',
		'label'       => 'Feature this ' . $label,
		'required'    => false,
		'description' => 'Feature this ' . $label,
		'show_column' => false
	);
	return $fields;
}
add_filter( 'th-meta-arche_feature_box-fields', 'arche_feature_box_fields' );
new TH_Post_Meta(
	array(
		'id'         => 'arche_feature_box',
		'title'      => 'Feature this!',
		'post_types' => array( 'post' ),   // Post type
		'context'    => 'side',
		'priority'   => 'core',
		'show_names' => false, // Show field names on the left
		'save_mode'  => 'individual',
		'fields'     => $arche_featured_field,
	)
);
