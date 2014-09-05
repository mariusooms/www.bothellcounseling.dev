<?php
//* Output primary sidebar structure
genesis_markup( array(
	'html5'   => '<aside %s>',
	'xhtml'   => '<div id="sidebar" class="sidebar widget-area">',
	'context' => 'sidebar-primary',
) );

?>

<section id="profile-video">
		<div class="youtube video-wrap" id="<?php arche_the_front_page_what_we_do_video_id(); ?>" data-params="modestbranding=1&showinfo=0&controls=0&vq=hd720&rel=0">
 			<?php arche_the_front_page_what_we_do_video_image_html(); ?>
 		</div>
</section>
<section id="profile-schedule">
	<a href="#" class="cta button" title="Schedule an Appointment"><?php _e('Schedule an Appointment', 'arche' ); ?></a>
</section>
<?php

do_action( 'genesis_before_sidebar_widget_area' );
dynamic_sidebar('profile-sidebar');
do_action( 'genesis_after_sidebar_widget_area' );

genesis_markup( array(
	'html5' => '</aside>', //* end .sidebar-primary
	'xhtml' => '</div>', //* end #sidebar
) );