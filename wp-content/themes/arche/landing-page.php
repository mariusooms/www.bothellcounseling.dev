<?php 
/**
 * ------------------------------------------------------------------------------------
 * Template name: Landing 
 * ------------------------------------------------------------------------------------
 */


//* Force full width content layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

//* Remove the default Genesis loop
remove_action( 'genesis_loop', 'genesis_do_loop' );

//* Remove the primary navigation
remove_action('genesis_header', 'genesis_do_nav');



?>

<?php genesis(); ?>