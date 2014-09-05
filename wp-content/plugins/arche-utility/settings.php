<?php
$settings_definitions = array(
	'meta' => array(
		'version' => '0.0.3'
	),
	'tabs' => array(
		'general' => array(
			'title' => 'General',
			'sections' => array(
				'general_options' => array(
					'title' => 'General Settings',
					'description' => '',
					'settings' => array(
						'primary-location' => array(
							'title' => 'Choose Location',
							'type' => 'postselect',
							'post_type' => 'location',
							'description' => 'The primary location for the site',
							'id_or_slug' => 'id',
							'since' => '0.0.3',
						),
						'telephone-number' => array(
							'title' => 'Telephone number',
							'type' => 'text',
							'description' => 'This is the main contact telephone number. It will appear on every page.',
							'since' => '0.0.1',
						),
						'footer-text' => array(
							'title' => 'Footer text',
							'type' => 'editor',
							'description' => 'This is the footer text. It will appear on every page.',
							'since' => '0.0.2',
						),
					)
				),
			)
		)
	)
);
