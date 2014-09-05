<div id="scccd-list" data-filter="<?php echo $initial_filter; ?>">
	<div id="scccd-list-options" class="clearfix combo-filters">
		<div class="scccd-option-combo scccd_service">
			<h2 class="h2head">Select options below to help find the right counselor for you.</h2>
			<p>Showing counselors with the following specialty focus areas:</p>
			<div class="portfolioFilter">
				<ul data-filter-group="scccd_services" class="option-set" >
				<?php foreach($focus_areas as $fa): ?>
				<?php
					$current_focus_area_class = ( !empty( $focus_area ) && $focus_area === $fa->term_id ) ? 'current' : '';
				?>
					<li>
						<a class="flist <?php echo $current_focus_area_class; ?>" id="cat<?php echo $fa->term_id; ?>" href="#" data-filter-value=".cat<?php echo $fa->term_id; ?>" data-content="" ><?php echo $fa->name; ?></a>
    					<!-- <a class="flist" id="cat<?php echo $fa->term_id; ?>" href="#" data-filter-value=".cat<?php echo $fa->term_id; ?>" data-content="" <?php echo $current_focus_area_class; ?>><?php echo $fa->name; ?></a> -->
       			 		<span class="mr-info cat<?php echo $fa->term_id; ?>-showdiv"></span>      
	          			<!-- Add content to modal -->
	          			<div id="my_modal<?php echo $fa->term_id; ?>" class="tooltip common" style="display:none;">
	                		<h2 class="h2head"><?php echo $fa->name; ?><a href="<?php echo get_term_link( $fa, 'th_focus_area' ); ?>" class="view-more">View Page</a></h2>
	                		<span class="sml-title"><?php echo $fa->description; ?></span>
	                		<?php
	                			$subs = get_terms( 'th_focus_area', array( 'hide_empty' => false, 'parent' => $fa->term_id ) );
	                		?>
	                		<?php if ( !empty( $subs ) && !is_wp_error( $subs ) ) : ?>
	                		<ul class="popup-ul">
	                			<?php foreach ($subs as $sub ) : ?>
			                    <li><?php echo $sub->name ?></li>
			                	<?php endforeach; ?>
			                </ul>
			            	<?php endif; ?>
	    		            <span class="my_modal_close">Close</span>
	          			</div>
  		  			</li>
  		  		<?php endforeach; ?>
				</ul>																																																																										
				<br style="clear:both" />
			</div> <!-- end of .portfolioFilter -->																																																																		
		</div> <!-- end of .scccd_service -->
		<div class="scccd-option-combo scccd_location">
			<h2 class="h2head location-head">
				<span class="toggleh2head">Show Counselors for Other Locations</span>
			</h2>
			<div class="portfolioFilter" >
				<div class="show-location">
					<strong class="scccd-info">Showing counselors for the following locations:</strong>
					<ul data-filter-group="scccd_location" class="option-set">
					<?php foreach($locations as $lo): ?>
					<?php
						$current_location_class = ( !empty( $location ) && $location === $lo->term_id ) ? 'class="flist current"' : 'class="flist"';
					?>
						<li><a href="#" <?php echo $current_location_class; ?> data-filter-value=".cat<?php echo $lo->term_id; ?>"><?php echo $lo->name; ?></a></li>
	  		  		<?php endforeach; ?>
					</ul>
				</div>
			</div> <!-- end of .portfolioFilter -->																																																																		
		</div> <!-- end of .scccd_location -->
	</div> <!-- end of #scccd-list-options -->

	<div class="portfolioContainer" id="scccd-list-profiles">
		<?php foreach($counsellors as $cp): ?>
		<?php
			$cp_term_args   = array('orderby' => 'term_order', 'order' => 'ASC', 'fields' => 'ids');
			$cp_focus_areas = wp_get_object_terms( $cp->ID, 'th_focus_area', $cp_term_args );
			$cp_locations   = wp_get_object_terms( $cp->ID, 'th_location', $cp_term_args );
			$cp_cat_class   = array_merge( $cp_focus_areas, $cp_locations );
			$cp_class       = array();

			foreach ($cp_cat_class as $cpc) {
				$cp_class[] = 'cat' . $cpc;
			}

			$cp_class       = implode( ' ', $cp_class );

			$general_info   = get_post_meta( $cp->ID, 'general-info', true );
			$extended_info  = get_post_meta( $cp->ID, 'extended-info', true );

			$cp_term_args['fields'] = 'names';
			$cp_credentials = wp_get_object_terms( $cp->ID, 'th_credential', $cp_term_args );
			$cp_credentials = implode( ', ', $cp_credentials );
			$cp_meta        = get_post_meta( $cp->ID );
			$thumb_id       = get_post_thumbnail_id( $cp->ID );
			$thumb_src      = wp_get_attachment_image_src( $thumb_id, 'thumbnail' );
		?>
		<div class="<?php echo $cp_class; ?> vcard">
	    	<!-- <?php echo $cp->post_title; ?> --> 
	    	<div class="testimonial-widget one-third column child mb25">
				<div class="testimonial-thumbnail">
					<a href="<?php echo get_permalink($cp->ID); ?>"><img src="<?php echo $thumb_src[0]; ?>" alt="<?php echo $cp->post_title; ?>" width="94" height="94"></a>
				</div>
				<div class="testimonial-content-wrapper">
					<div class="testimonial-title-wrapper">
						<h2 class="h2head"><a href="<?php echo get_permalink($cp->ID); ?>"><?php echo $cp->post_title; ?> <?php echo $cp_credentials; ?></a></h2>
					</div>
					<div class="testimonial-content">
						<span class="alignleft ico_phn"><?php echo $general_info['phone-number']; ?></span>
						<span class="alignleft ico_info clear_b info_kel">Info</span>                  
						<a href="<?php echo get_permalink($cp->ID); ?>"><span class="alignleft ico_bio">Full Bio</span></a>
						<!-- <a class="gdl-button alignright" href="mailto:<?php echo antispambot($general_info['email-address']); ?>">Email <?php echo strtok($cp->post_title, " "); ?></a> -->
					</div>
					<div id="<?php echo $cp->post_name; ?>" class="tooltip" style="display:none;">
						<h2 class="h2head"><?php echo $cp->post_title; ?> <?php echo $cp_credentials; ?>
							<a href="<?php echo get_permalink($cp->ID); ?>" class="view-more">View Page</a>
						</h2>
						<span class="sml-title"><?php echo $extended_info['job-title'];?></span>
						<h5>
							<strong>Phone:</strong> <?php echo $general_info['phone-number']; ?>
							<br/>
							<strong>Email:</strong> <a href="mailto:<?php echo antispambot($general_info['email-address']); ?>"><?php echo antispambot($general_info['email-address']); ?></a>
						</h5>					  
						<span class="my_modal_close">Close</span>
					</div>
				</div>																				
			</div>
		</div>
  		<?php endforeach; ?>
	</div>
</div> <!-- end of #scccd-list -->