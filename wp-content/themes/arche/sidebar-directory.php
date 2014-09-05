<?php
//* Output primary sidebar structure
genesis_markup( array(
	'html5'   => '<aside %s>',
	'xhtml'   => '<div id="sidebar" class="sidebar widget-area">',
	'context' => 'sidebar-primary',
) );

?>
	<div id="l-directory-options">
		<input type="search" id="counselor-search" placeholder="<?php _e('Find counselor by name...', 'arche'); ?>"/>
	
		<?php $services = get_terms( 'service', array( 'hide_empty' => false ) );
		if ( !empty( $services ) && !is_wp_error( $services ) ) : ?>
			<h3><?php _e('Services', 'arche'); ?></h3>
			<ul id="m-services-checkbox" class="icheck">
			<?php foreach ( $services as $service ) : ?>
				<li><input type="checkbox" id="<?php echo esc_attr( $service->slug ); ?>" value="<?php echo esc_attr( $service->slug ); ?>"><label for="<?php echo esc_attr( $service->slug ); ?>"><?php echo esc_html( $service->name ); ?></label></li>
			<?php endforeach; ?>
			</ul>
		<?php endif; ?>
		
		<hr />
		
		<?php
			$location_query = new WP_Query( array( 'post_type' => 'location', 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'asc' ) );
			// The Loop
			if ( $location_query->have_posts() ) : ?>
				<h3><?php _e('Locations', 'arche'); ?></h3>
				<ul id="m-locations-radio" class="icheck">
				<?php while ( $location_query->have_posts() ) :
					$location_query->the_post(); ?>
					<li><input type="radio" id="<?php echo esc_attr($post->post_name); ?>" name="location" value="<?php echo esc_attr($post->post_name); ?>"><label for="<?php echo esc_attr($post->post_name); ?>"><?php the_title() ?></label></li>
				<?php endwhile; ?>
				</ul>
			<?php endif;
			/* Restore original Post Data */
			wp_reset_postdata();
		?>		
		<hr />
							
	</div>
	
<?php

//do_action( 'genesis_before_sidebar_widget_area' );
//do_action( 'genesis_sidebar' );
//do_action( 'genesis_after_sidebar_widget_area' );

genesis_markup( array(
	'html5' => '</aside>', //* end .sidebar-primary
	'xhtml' => '</div>', //* end #sidebar
) );