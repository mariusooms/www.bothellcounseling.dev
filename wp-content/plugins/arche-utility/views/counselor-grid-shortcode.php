<div id="counselor-grid" class="<?php echo $counselor_grid_class; ?>" itemscope itemtype="http://schema.org/LocalBusiness">
	<div itemscope itemtype="http://schema.org/ProfessionalService">
		<?php if( !empty( $current_location ) ) : ?>
		<link itemprop="url" href="<?php get_site_url(); ?>">
		<meta itemprop="name" content="<?php echo esc_attr( $current_location->name ); ?>"/>
		<meta itemprop="description" content="<?php echo esc_attr( $current_location->description ); ?>" />
		<span itemscope itemtype="http://schema.org/Place">
			<span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
				<meta itemprop="streetAddress" content="<?php echo esc_attr( $current_location_meta['street-address'] ); ?>" />
				<meta itemprop="addressLocality" content="<?php echo esc_attr( $current_location_meta['city'] ); ?>" />
				<meta itemprop="addressRegion" content="<?php echo esc_attr( $current_location_meta['state'] ); ?>" />
				<meta itemprop="postalCode" content="<?php echo esc_attr( $current_location_meta['postal-code'] ); ?>" />
				<meta itemprop="addressCountry" content="<?php echo esc_attr( $current_location_meta['country'] ); ?>" />
				<meta itemprop="telephone" content="<?php echo esc_attr( $current_location_meta['phone-number'] ); ?>" />
			</span>
			<span itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
				<meta itemprop="latitude" content="<?php echo esc_attr( $current_location_meta['location']['lat'] ); ?>" />
				<meta itemprop="longitude" content="<?php echo esc_attr( $current_location_meta['location']['lng'] ); ?>" />
			</span>
		</span>
		<?php endif; ?>
		<ul class="counselor-grid-images" itemprop="employees" itemscope itemtype="http://schema.org/employees">
		<?php
			foreach($counselors as $counselor):
				$general_info   = get_post_meta( $counselor->ID, 'general-info', true );
				$extended_info  = get_post_meta( $counselor->ID, 'extended-info', true );
				$focus_areas    = wp_get_object_terms( $counselor->ID, 'th_focus_area', array( 'orderby' => 'term_order', 'order' => 'ASC', 'fields' => 'all' ) );
				$thumb_id       = get_post_thumbnail_id( $counselor->ID );
				$thumb_src      = wp_get_attachment_image_src( $thumb_id, 'thumbnail' );
			?>
			<li itemprop="employee provider" itemscope itemtype="http://schema.org/Person">
				<a href="<?php echo esc_url(get_permalink($counselors->ID)); ?>">
					<img src="<?php echo esc_url( $thumb_src[0] ); ?>" itemprop="image" alt="<?php echo esc_attr( 'Image of ' . $counselor->post_title ); ?>" />
				</a>
				<span class="counselor-grid-name" itemprop="name"><?php echo esc_html( $counselor->post_title ); ?></span>
				<meta itemprop="email" content="<?php echo esc_attr( antispambot( $general_info['email-address'] ) ); ?>" />
				<meta itemprop="telephone" content="<?php echo esc_attr( $general_info['phone-number'] ); ?>" />
				<meta itemprop="description" content="<?php echo esc_attr( $ectended_info['short-biography'] ); ?>" />
				<ul class="counselor-grid-services">
				<?php foreach ( $focus_areas as $focus_area ):
					$focus_area       = sanitize_term( $focus_area, 'th_focus_area' );
					$focus_area_link  = get_term_link( $focus_area, 'th_focus_area' );
					if ( is_wp_error( $focus_area_link ) ) {
				        continue;
				    }
				?>
					<li>
						<a href="<?php echo esc_url( $focus_area_link ); ?>"><span><?php echo esc_html( $focus_area->name ); ?></span></a>
					</li>
				<?php endforeach; ?>
				</ul>
			</li>
			<?php endforeach; ?>
		</ul>
		<div class="counselor-grid-info">
			<h4 class="counselor-grid-name"><a href="#">&nbsp;</a></h4>
			<a class="counselor-grid-view-more" href="#">View counselors by service</a>
			<ul class="counselor-grid-services">
			</ul>
		</div>
	</div>
</div>
<script type="text/javascript">
(function ($, window, document, undefined) {
    'use strict';
	$(function() {
	    $('#counselor-grid').counselorGrid();
	});		
}(jQuery, window, document));	
</script>
