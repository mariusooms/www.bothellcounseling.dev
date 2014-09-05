<?php
/**********************************************************
Create Meta
**********************************************************/

// Counselor Profile general info fields
$counselor_profile_fields_general = array(
	'email-address' => array(
		'type'        => 'text',
		'label'       => 'Email',
		'placeholder' => 'your.name@domain.com',
		'validation'  => 'email',
		'required'    => true,
		'description' => 'Please enter your email address.',
		'show_column' => false
	),
	'phone-number' => array(
		'type'        => 'telephonenumber',
		'label'       => 'Phone',
		'hide-country-code' => true,
		'hide-extension' => true,
		'required'    => true,
		'description' => 'Please enter your phone number.',
		'show_column' => false
	),
	'twitter' => array(
		'type'        => 'text',
		'label'       => 'Twitter',
		'placeholder' => 'twitterid',
		'validation'  => 'twitter',
		'required'    => false,
		'description' => 'Please enter your twitter id - if you have one.',
		'show_column' => false
	),
	'website' => array(
		'type'        => 'text',
		'label'       => 'Website',
		'placeholder' => get_site_url(),
		'default'     => get_site_url(),
		'validation'  => 'url',
		'required'    => true,
		'description' => 'Please enter your your website url.',
		'show_column' => false
	),
	// 'tax-location' => array(
	// 	'type'        => 'taxonomyselect',
	// 	'label'       => 'Locations',
	// 	'required'    => true,
	// 	'multiple'    => true,
	// 	'sortable'    => true,
	// 	'taxonomy'    => 'th_location',
	// 	'placeholder' => 'Add your work locations',
	// 	'description' => 'Please add your locations in priority order. (you can drag & drop items to order them)'
	// ),
	// 'primary-location' => array(
	// 	'type'        => 'taxonomyselect',
	// 	'label'       => 'Primary Location',
	// 	'required'    => true,
	// 	'multiple'    => false,
	// 	'sortable'    => false,
	// 	'taxonomy'    => 'th_location',
	// 	'save_as_meta'=> true,
	// 	'placeholder' => 'Add your primary work locations',
	// 	'description' => 'Please add your primary work location.'
	// )
);
// Counselor Profile general info metabox
new TH_Post_Meta(
	array(
		'id'         => 'general-info',
		'title'      => 'General Profile Info',
		'post_types' => array( 'counselor-profile' ),   // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,                               // Show field names on the left
		'save_mode'  => 'single',                           // single or individual
		'fields'     => $counselor_profile_fields_general,
	)
);

// Counselor Profile extended info fields
$counsellor_profile_fields_extended = array(
	'job-title' => array(
		'type'        => 'text',
		'label'       => 'Job Title',
		'placeholder' => 'My Job Title',
		'validation'  => 'no_html',
		'required'    => true,
	),
	'tax-credential' => array(
		'type'        => 'taxonomyselect',
		'label'       => 'Credentials',
		'required'    => true,
		'multiple'    => true,
		'sortable'    => true,
		'taxonomy'    => 'credential',
		'placeholder' => 'Add your credentials',
		'description' => 'Please add your credentials in priority order. (you can drag & drop items to order them)'
	),
	'tax-service' => array(
		'type'        => 'taxonomyselect',
		'label'       => 'Services',
		'required'    => true,
		'multiple'    => true,
		'sortable'    => true,
		'taxonomy'    => 'service',
		'placeholder' => 'Add your services',
		'description' => 'Please add your services in priority order. (you can drag & drop items to order them)'
	),
	'short-biography' => array(
		'type'        => 'editor',
		'label'       => 'Short Biography',
		'validation'  => 'html_post',
		'settings'    => array(
			'teeny' => true
		),
		'max-length'  => 100,
		'required'    => true,
	),
	'long-biography' => array(
		'type'        => 'editor',
		'label'       => 'Long Biography',
		'validation'  => 'html_post',
		'required'    => true,
	),
	'video-biography' => array(
		'type'        => 'oembed',
		'class'       => 'text_large',
		'label'       => 'Video Biography',
		'required'    => false,
		'placeholder' => 'http://www.youtube.com/watch?v=',
		'description' => 'Please insert a video url.'
	),
	'video-thumbnail' => array(
		'type'        => 'file',
		'label'       => 'Video Thumbnail',
		'required'    => false,
		'placeholder' => 'Select a thumbnail',
		'description' => 'Please insert a thumbnail.',
		'filter'      => 'image',
		'title'              => 'Insert Thumbnail',
		'button'             => 'Insert Thumbnail',
		'button-tooltip'     => 'Click here to insert your video thumbnail',
		'dialog-button'      => 'Insert thumbnail',
		'clear-link-tooltip' => 'Click this link to remove the current thumbnail',
		'clear-link'         => 'Remove thumbnail',
	)
);
// Counselor Profile extended info metabox
new TH_Post_Meta(
	array(
		'id'         => 'extended-info',
		'title'      => 'Extended Profile Info',
		'post_types' => array( 'counselor-profile' ),   // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,                               // Show field names on the left
		'save_mode'  => 'single',                           // single or individual
		'fields'     => $counsellor_profile_fields_extended,
	)
);

// Counselor Profile extended info fields
$counsellor_profile_fields_scheduling = array(
	'limited-slots-available' => array(
		'type'        => 'checkbox',
		'label'       => 'Availability',
		'description' => 'Limited slots available',
	),
);
// Counselor Profile extended info metabox
new TH_Post_Meta(
	array(
		'id'         => 'scheduling-info',
		'title'      => 'Scheduling',
		'post_types' => array( 'counselor-profile' ),   // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,                               // Show field names on the left
		'save_mode'  => 'single',                           // single or individual
		'fields'     => $counsellor_profile_fields_scheduling,
	)
);