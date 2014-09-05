<?php 
/**
 * ------------------------------------------------------------------------------------
 * Template name: Directory 
 * ------------------------------------------------------------------------------------
 */

/**
 * Swap in a different sidebar instead of the default sidebar.
 * 
 * @author Jennifer Baumann
 * @link http://dreamwhisperdesigns.com/?p=1034
 */
//* Swap in directory sidebar. 
function arche_directory_page_sidebar_logic() {
    remove_action( 'genesis_after_content', 'genesis_get_sidebar' );
    add_action( 'genesis_before_content', 'arche_directory_page_get_directory_sidebar' );
}
add_action( 'get_header', 'arche_directory_page_sidebar_logic' );

//* Retrieve directory sidebar
function arche_directory_page_get_directory_sidebar() {
    get_sidebar( 'directory' );
}

/**
 * Enqueue jquery scripts.
 */
function arche_directory_page_enqueue_scripts_styles() {
	
	// Enqueue Scripts
	wp_enqueue_script( 'arche-directory-page-scripts', get_bloginfo( 'stylesheet_directory' ) . '/js/min/directory-page-scripts-min.js', array( 'jquery' ), true );
		
}

add_action( 'wp_enqueue_scripts', 'arche_directory_page_enqueue_scripts_styles' );


//* Force Genesis layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_sidebar_content' );

function arche_the_directory_page_main() { ?>
	<section id="search-results" class="list-view">
	
		<div class="primary search-message">
			
			<p>We have found 2 counselors at <a href="http://www.bothellcounseling.com/locations/bothell" title="View location Bothell">Bothell</a> concerning: <a href="http://www.bothellcounseling.com/services/#marriage-counseling" title="View service Marriage Counseling">Marriage Counseling</a>, <a href="http://www.bothellcounseling.com/services/#family-counseling" title="View service Family Counseling">Family Counseling</a></p>
			
		</div><!-- .primary .search-message -->
		
		<ul class="primary search-results">

			<li class="counselor">
				
				<div class="layout">
				
					<div class="counselor-list-cell">
						<div class="counselor-image list">
								<a class="counselor-image-link" href="#" title="View Carolyn's Profile">
									<img class="portrait" src="http://comm-imac.local:5757/wp-content/uploads/2014/09/Carolyn-profile-150x225.jpg" alt="Carolyn Peterson">
									<div class="counselor-overlay"></div>
									<div class="counselor-location">Bothell</div>
								</a>
						</div><!-- .counselor-image .list -->
					</div>
																		
					<div class="counselor-wrap">
						<div class="details-schedule">
							<div class="counselor-details">
								<h3 class="name-cred">
									<a href="#" class="name" title="View Carolyn's Profile">Carolyn Peterson</a>
									<ul class="credentials">
										<li><abbr title="Masters of Art">MA</abbr></li>
										<li><abbr title="Licensed Mental Health Counselor Associate">LMHCA</abbr></li>
									</ul>
								</h3>
								<div class="jobdescription serif-italic">Licensed Counselor Associate</div>
								<div class="contact">	
									<span class="tel"><strong>Phone: </strong><a href="tel:2064526728">(206) 452.6728</a></span>
									<span class="twitter"><strong>Twitter: </strong><a href="#">@PetersonSCC</a></span>
								</div>	
								<div class="counselor-location">Location Bothell</div>						
							</div>
							<div class="schedule">
								<a href="#" class="button cta">Schedule appointment</a>
								<span class="badge">limited slots available</span>
							</div>
						</div><!-- .details-schedule -->
						
						<div class="short-bio">
							<p>Each individual I work with has different goals for counseling, and the process of healing and change is unique to each person.<a class="more" href="#">[...]</a></p>
						</div>												
						<hr />
						<div class="availability">
							<span>Availability</span>Bothell: Mon, Tue / Greenlake: Wed
						</div>
					</div><!-- .counselor-wrap -->

				</div><!-- .layout-list .layout-grid -->
			</li>
						
		</ul>
		
		<div class="secondary search-message">
			<p>We have found 1 counselor at other locations concerning those services</p>
		</div>
		
		<ul class="secondary search-results">
		
			<li class="counselor">
				
				<div class="layout">

					<div class="counselor-list-cell">
						<div class="counselor-image list">
							<a class="counselor-image-link" href="#" title="View Amanda's Profile">
								<img class="portrait grayscale" src="http://comm-imac.local:5757/wp-content/uploads/2014/07/Amanda-profile-150x225.jpg" alt="Amanda Rowett">
								<div class="counselor-overlay"></div>
								<div class="counselor-location">Millcreek</div>
							</a>
						</div><!-- .counselor-image .list -->
					</div>
																		
					<div class="counselor-wrap">		
						<div class="details-schedule">
							<div class="counselor-details">
								<h3 class="name-cred">
									<a href="#" class="name" title="View Amanda's Profile">Amanda Rowett</a>
									<ul class="credentials">
										<li><abbr title="Masters of Art">MA</abbr></li>
										<li><abbr title="Licensed Mental Health Counselor Associate">LMHCA</abbr></li>
									</ul>
								</h3>
								<div class="jobdescription serif-italic">Licensed Counselor Associate</div>
								<div class="contact">	
									<span class="tel"><strong>Phone: </strong><a href="tel:2067019133">(206) 701.9133</a></span>
									<span class="twitter"><strong>Twitter: </strong><a href="#">@AmandaRowett</a></span>
								</div>	
								<div class="counselor-location">Location Millcreek</div>						
							</div>
							<div class="schedule">
								<a href="#" class="button cta">Schedule appointment</a>
								<span class="badge">limited slots available</span>
							</div>
						</div><!-- .details-schedule -->
						
						<div class="short-bio">
							<p>As a therapist, I can help you increase awareness of yourself—your strengths, weaknesses, desires, and goals.<a class="more" href="#">[...]</a></p>
						</div>												
						<hr />
						<div class="availability">
							<span>Availability</span>Bothell: Mon, Tue, Wed / Downtown Seattle: Thu, Fri
						</div>	
					</div><!-- .counselor-wrap -->

				</div><!-- .layout-list .layout-grid -->
			</li>
			
		</ul>
		<div id="pagination">
			<ul id="search-pagination">
				<li><a href="#">&lt;</a></li>
				<li class="active"><a href="#">1</a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">&gt;</a></li>
			</ul>
		</div>
	</section>
	<?php
}
add_action( 'genesis_before_loop', 'arche_the_directory_page_main' );

//* Remove the default Genesis loop
remove_action( 'genesis_loop', 'genesis_do_loop' );

?>

<?php genesis(); ?>