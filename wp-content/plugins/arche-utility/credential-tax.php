<?php
/**********************************************************
Create Custom Taxonomy
**********************************************************/

// Credential Taxonomy
new TH_CT(
	array( 'counselor-profile' ), // Post types
	'credential', // Taxonomy name
	'Credential',   // Singular name
	'Credentials',  // Plural name
	array(          // Taxonomy args only needs 'sort' => true if sort needs to be enabled
		'sort'    => true,
		'show_ui' => true,
		'public'  => false,
		'rewrite' => false
	),
	array(          // Admin Args The post type specific admin args: show_column, show_filter, show_metabox, required, show_in_content_table, default, sortable
		'show_column'  => array(
			'label'         => 'Credentials',
			'display_after' => 'default',
			'sortable'      => true
		),
		'show_filter'           => 'Credentials',
		'show_metabox'          => false,
		'required'              => false,
		'show_in_content_table' => true,
		'sortable'              => true
	)
);
