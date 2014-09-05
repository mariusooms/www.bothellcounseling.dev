<?php
/**********************************************************
Create Meta
**********************************************************/

$frontpage_into_fields = array(
	'intro-text' => array(
		'type'        => 'editor',
		'label'       => 'Intro text',
		'placeholder' => 'Professional help with faith-based values',
		'validation'  => 'no_html',
		'max-length'  => 40,		
		'required'    => true,
		'description' => 'Sub heading shown below heading',
		'show_column' => false
	)
);
new TH_Post_Meta(
	array(
		'id'         => 'frontpage-intro',
		'title'      => 'Intro',
		'post_types' => array( 'page' ),   // Post type
		'page_template' => array( 'front-page.php' ),   // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => false,                               // Show field names on the left
		'save_mode'  => 'individual',                           // single or individual
		'fields'     => $frontpage_into_fields,
	)
);


$frontpage_wwd_fields = array(
	'video-image' => array(
		'type'        => 'file',
		'label'       => 'Video Image',
		'required'    => true,
		'placeholder' => 'Select a video image',
		'description' => 'Please insert an image.',
		'filter'      => 'image',
		'title'              => 'Insert Image',
		'button'             => 'Insert Image',
		'button-tooltip'     => 'Click here to insert your image',
		'dialog-button'      => 'Insert image',
		'clear-link-tooltip' => 'Click this link to remove the current image',
		'clear-link'         => 'Remove image',
	),	
	'video' => array(
		'type'        => 'oembed',
		'class'       => 'text_large',
		'label'       => 'Video',
		'required'    => true,
		'placeholder' => 'http://www.youtube.com/watch?v=',
		'description' => 'Please insert a video url.'
	),
	'text' => array(
		'type'        => 'editor',
		'label'       => 'Intro text',
		'placeholder' => '',
		'validation'  => 'html_post',
		'max-length'  => 70,		
		'required'    => true,
		'description' => 'Text to be shown below video',
		'show_column' => false
	)
);
new TH_Post_Meta(
	array(
		'id'         => 'frontpage-what-we-do',
		'title'      => 'What we do',
		'post_types' => array( 'page' ),   // Post type
		'page_template' => array( 'front-page.php' ),   // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,                               // Show field names on the left
		'save_mode'  => 'single',                           // single or individual
		'fields'     => $frontpage_wwd_fields,
	)
);


$frontpage_hiw_fields = array(
	'image' => array(
		'type'        => 'file',
		'label'       => 'Image',
		'required'    => false,
		'placeholder' => 'Select an image',
		'description' => 'Please insert an image.',
		'filter'      => 'image',
		'title'              => 'Insert Image',
		'button'             => 'Insert Image',
		'button-tooltip'     => 'Click here to insert your image',
		'dialog-button'      => 'Insert image',
		'clear-link-tooltip' => 'Click this link to remove the current image',
		'clear-link'         => 'Remove image',
	),
	'text' => array(
		'type'        => 'editor',
		'label'       => 'How it works text',
		'placeholder' => '',
		'validation'  => 'html_post',
		'max-length'  => 70,
		'required'    => true,
		'description' => 'Text to be shown below video',
		'show_column' => false
	),
	'button-text' => array(
		'type'        => 'text',
		'class'       => 'text_large',
		'label'       => 'Button text',
		'placeholder' => 'Start your risk-free initial appointment',
		'validation'  => 'no_html',
		'required'    => true,
		'description' => 'Text shown in the button below the how it works tekst',
		'show_column' => false
	),
	'button-link-page' => array(
		'type'        => 'postselect',
		'class'       => 'text_large',
		'label'       => 'Button target',
		'id_or_slug'  => 'id',
		'required'    => true,
		'multiple'    => false,
		'sortable'    => false,
		'select2'     => true,
		'required'    => true,
		'post_type'   => 'page',
		'placeholder' => 'Select target page',
		'description' => 'Select the page the button should link to.',
		'show_column' => false
	)
);
new TH_Post_Meta(
	array(
		'id'         => 'frontpage-how-it-works',
		'title'      => 'How it works',
		'post_types' => array( 'page' ),   // Post type
		'page_template' => array( 'front-page.php' ),   // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,                               // Show field names on the left
		'save_mode'  => 'single',                           // single or individual
		'fields'     => $frontpage_hiw_fields,
	)
);

$frontpage_testimonials_fields = array(
	'background-image' => array(
		'type'        => 'file',
		'label'       => 'Image',
		'required'    => false,
		'placeholder' => 'Select a background image',
		'description' => 'Please insert a background image.',
		'filter'      => 'image',
		'title'              => 'Insert Background Image',
		'button'             => 'Insert Background',
		'button-tooltip'     => 'Click here to insert your background image',
		'dialog-button'      => 'Insert background ',
		'clear-link-tooltip' => 'Click this link to remove the current background image',
		'clear-link'         => 'Remove background',
	),
);

new TH_Post_Meta(
	array(
		'id'         => 'frontpage-testimonials',
		'title'      => 'Testimonials',
		'post_types' => array( 'page' ),   // Post type
		'page_template' => array( 'front-page.php' ),   // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,                               // Show field names on the left
		'save_mode'  => 'single',                           // single or individual
		'fields'     => $frontpage_testimonials_fields,
	)
);


$frontpage_articles_fields = array(
	'max-tags' => array(
		'type'        => 'text',
		'class'       => 'text_small',
		'label'       => 'Number of tags',
		'validation'  => 'number',
		'default'     => 4,
		'required'    => true,
		'description' => 'The maximum number of tags to show per article.',
		'show_column' => false
	),
	'excerpt-length' => array(
		'type'        => 'text',
		'class'       => 'text_small',
		'label'       => 'Excerpt length',
		'validation'  => 'number',
		'default'     => 60,
		'required'    => true,
		'description' => 'The maximum number of words to show in the excerpt.',
		'show_column' => false
	),
);

new TH_Post_Meta(
	array(
		'id'         => 'frontpage-articles',
		'title'      => 'Articles',
		'post_types' => array( 'page' ),   // Post type
		'page_template' => array( 'front-page.php' ),   // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,                               // Show field names on the left
		'save_mode'  => 'single',                           // single or individual
		'fields'     => $frontpage_articles_fields,
	)
);

// Remove the editor if front-page.php template is selected
add_action('init', 'arche_remove_admin_editor_front_page');
function arche_remove_admin_editor_front_page() {
    // if post not set, just return 
    // fix when post not set, throws PHP's undefined index warning
    if (isset($_GET['post'])) {
        $post_id = $_GET['post'];
    } else if (isset($_POST['post_ID'])) {
        $post_id = $_POST['post_ID'];
    } else {
        return;
    }
    $template_file = get_page_template_slug( $post_id );
    if ( 'front-page.php' === $template_file) {
        remove_post_type_support('page', 'editor');
        remove_post_type_support('page', 'thumbnail');
    }
}
