<?php
// Services Taxonomy
new TH_CT(
	array( 'counselor-profile' ), // Post types
	'service', // Taxonomy name
	'Service',   // Singular name
	'Services',  // Plural name
	array(          // Taxonomy args only needs 'sort' => true if sort needs to be enabled
		'sort'         => true,
		'hierarchical' => true,
		'rewrite'      => array( 'slug' => 'services', 'with_front' => false )
	),
	array(          // Admin Args The post type specific admin args: show_column, show_filter, show_metabox, required, show_in_content_table, default, sortable
		'show_column'  => array(
			'label'         => 'Services',
			'display_after' => 'default',
			'sortable'      => true
		),
		'show_filter'           => 'Services',
		'show_metabox'          => false,
		'required'              => false,
		'show_in_content_table' => true,
		'sortable'              => true
	)
);
TH_CT::get_instance( 'service' )
->add_taxonomy_to_post_type( // Add to posts
	'post',
	array(          // Admin Args The post type specific admin args: show_column, show_filter, show_metabox, required
		'show_column'  => true,
		'show_filter'  => 'services',
		'show_metabox' => true,
		'required'     => false,
	)
)
->add_taxonomy_to_post_type( // Add to pages
	'page',
	array(          // Admin Args The post type specific admin args: show_column, show_filter, show_metabox, required
		'show_column'  => true,
		'show_filter'  => 'services',
		'show_metabox' => true,
		'required'     => false,
	)
);
