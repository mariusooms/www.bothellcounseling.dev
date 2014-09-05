<?php
/**********************************************************
Create Meta
**********************************************************/

// Location general info fields
$location_fields_general = array(
	'phone-number' => array(
		'type'        => 'text',
		'label'       => 'Phone',
		'placeholder' => '999-999-9999',
		'validation'  => 'tel',
		'required'    => true,
		'description' => 'Please enter your phone number.',
		'show_column' => false
	)
);
// Counselor Profile general info metabox
new TH_Post_Meta(
	array(
		'id'         => 'general-info',
		'title'      => 'General Location Info',
		'post_types' => array( 'location' ),   // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,                               // Show field names on the left
		'save_mode'  => 'single',                           // single or individual
		'fields'     => $location_fields_general,
	)
);
