<?php
/**********************************************************
Create Custom Post Types
**********************************************************/

// Location CPT
new TH_CPT( 'location', 'Location', 'Locations', array( 'supports' => array( 'title', 'thumbnail' ), 'rewrite' => array( 'slug' => 'locations', 'with_front' => false ) ) );
TH_CPT::get_instance( 'location' )
->enable_shortlink()
->set_title_placeholder( 'Enter location name here...', 'Location Name' )
->set_featured_image_text( 'Location Image', 'Set location image', 'Remove location image' )
->show_in_content_table()
->set_menu_icon( 'dashicons-location', '\f230' )
->require_fields( array( 'title', 'thumbnail' => 'Location Image' ) )
->show_thumbnail_in_admin_table();


/**********************************************************
Create Custom Taxonomy
**********************************************************/

// Location Taxonomy
new TH_CT(
	array( 'counselor-profile' ), // Post types
	'location', // Taxonomy name
	'Location',   // Singular name
	'Locations',  // Plural name
	array(          // Taxonomy args only needs 'sort' => true if sort needs to be enabled
		'sort'    => true,
		'show_ui' => false,
		'public'  => false,
		'rewrite' => false
	),
	array(          // Admin Args The post type specific admin args: show_column, show_filter, show_metabox, required, show_in_content_table, default, sortable
		'show_column'  => array(
			'label'         => 'Locations',
			'display_after' => 'default',
			'sortable'      => true
		),
		'show_filter'           => 'Locations',
		'show_metabox'          => true,
		'required'              => false,
		'show_in_content_table' => false,
		'sortable'              => true
	)
);

/**********************************************************
Link Post Type and Taxonomy
**********************************************************/

// Location
require_once 'class-cpt-tax-link.php';

function arche_link_location_cpt_tax() {
	new CPT_Tax_Link( 'location', 'location' );
}
add_action('init', 'arche_link_location_cpt_tax');
