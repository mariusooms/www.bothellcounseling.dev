<?php
/**********************************************************
Create Custom Post Types
**********************************************************/

// Counsellor Profile CPT
new TH_CPT( 'counselor-profile', 'Counselor Profile', 'Counselor Profiles', array( 'supports' => array( 'title', 'thumbnail' ), 'rewrite' => array( 'slug' => 'counselors', 'with_front' => false ) ) );
TH_CPT::get_instance( 'counselor-profile' )
->enable_shortlink()
->set_title_placeholder( 'Enter counselor name here...', 'Counselor Name' )
->set_featured_image_text( 'Counselor Profile Image', 'Set profile image', 'Remove profile image' )
->show_in_content_table()
->set_menu_icon( 'dashicons-id-alt', '\f337' )
// ->set_screen_icon( plugins_url( 'img/counsellorprofile-screen.png' , __FILE__ ) )
->require_fields( array( 'title', 'thumbnail' => 'Counselor Profile Image' ) )
// ->add_template_overrides()
->show_thumbnail_in_admin_table();
