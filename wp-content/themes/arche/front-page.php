<?php 
/**
 * ------------------------------------------------------------------------------------
 * Template name: Front 
 * ------------------------------------------------------------------------------------
 */


// Force full width content layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

function arche_the_front_page_intro_section() { ?>

	<section id="l-intro" itemscope="itemscope" itemtype="http://schema.org/Organization">
		<div class="m-intro-wrap">
			<h1 itemprop="name"><?php bloginfo('name'); ?></h1>
			<p class="m-intro-description"><?php bloginfo('description'); ?></p>
		</div>
		<div class="m-intro-text" itemprop="description"><p><?php arche_the_front_page_intro_text(); ?></p></div>
	</section><!-- #l-intro -->

	<?php
}
add_action( 'genesis_before_loop', 'arche_the_front_page_intro_section' );


function arche_the_front_page_what_who_how_section() { ?>

	<section id="l-what-who-how">
		<?php arche_the_front_page_what_we_do_section(); ?>
		<?php arche_the_front_page_who_we_are_section(); ?>
		<?php arche_the_front_page_how_it_works_section(); ?>
	</section><!-- #l-what-who-how -->

	<?php
}
add_action( 'genesis_before_loop', 'arche_the_front_page_what_who_how_section' );


function arche_the_front_page_what_we_do_section() { ?>

		<div id="m-what" itemscope="itemscope" itemtype="http://schema.org/Organization">
			<h2 class="section-title" itemprop="headline"><?php _e('What we do', 'arche'); ?></h2> 
			<div itemprop="description">
 				<div class="youtube video-wrap" id="<?php arche_the_front_page_what_we_do_video_id(); ?>" data-params="modestbranding=1&showinfo=0&controls=0&vq=hd720&rel=0">
 					<?php arche_the_front_page_what_we_do_video_image_html(); ?>
 				</div>
				<?php arche_the_front_page_what_we_do_text(); ?>
			</div>	
		</div><!-- #m-what -->

	<?php
}

function arche_the_front_page_who_we_are_section() {

	if (ARCHE_CACHE) {
		$counselor_profiles_cache = get_transient( 'arche-front-page-who-we-are-cache' );
	} else {
		$counselor_profiles_cache = false;
	}

	if (!$counselor_profiles_cache) {

		$counselor_profiles_cache = array();
		$counselor_profiles_cache_query_args = array(
			'post_type'      => 'counselor-profile', 
			'posts_per_page' => -1,
		);
		$counselor_profiles_cache_query = new WP_Query( $counselor_profiles_cache_query_args );			

		while( $counselor_profiles_cache_query->have_posts() ) : $counselor_profiles_cache_query->the_post();
			global $post;
			$post_name    = $post->post_name;
			$phone_link   = arche_get_counselor_profile_phone_link( get_the_id() );
			$twitter_link = arche_get_counselor_profile_twitter_link( get_the_id() );

			$counselor_profiles_cache_large  = arche_get_counselor_profile_image_link_html( get_the_id() );
			$counselor_profiles_cache_large .= '<h3><a href="' . esc_url( get_permalink() ) . '" title="' . esc_attr( arche_get_counselor_profile_name_credentials( get_the_id() ) ) .'">' . esc_html( arche_get_counselor_profile_name_credentials( get_the_id() ) ) . '</a></h3>';
			$counselor_profiles_cache_large .= '<span class="m-profile-jobtitle">' . esc_html( arche_get_counselor_profile_job_title( get_the_id() ) ) . '</span>';
			$counselor_profiles_cache_large .= '<p class="m-profile-meta">' . $phone_link;

			if( !empty( $phone_link ) && !empty( $twitter_link ) ) {
				$counselor_profiles_cache_large .= ' | ';
			}

			$counselor_profiles_cache_large .= $twitter_link . '</p>';

			$counselor_profiles_cache_small = '<li class="profile">' . arche_get_counselor_profile_image_link_html( arche_get_counselor_profile_id_from_post( get_the_ID() ), 'square-small' ) . '</li>';

			$counselor_profiles_cache[$post_name] = array(
				'small' => $counselor_profiles_cache_small,
				'large' => $counselor_profiles_cache_large
			);
		endwhile;

		if (ARCHE_CACHE) {
			set_transient( 'arche-front-page-who-we-are-cache', $counselor_profiles_cache, DAY_IN_SECONDS );
		}
	}

	$random_keys = array_keys( $counselor_profiles_cache );
	shuffle( $random_keys );

	?>

		<div id="m-who" itemscope="itemscope" itemtype="http://schema.org/Organization">
			<h2 class="section-title" itemprop="headline"><?php _e('Who we are', 'arche'); ?></h2>
			<div itemprop="text">
				<?php
					$current_key = array_shift($random_keys);
					echo $counselor_profiles_cache[$current_key]['large'];
				?>
			</div>
			<hr />
			<?php if(!empty($random_keys)) :?>
				<ul id="profiles" class="owl-carousel">
					<?php while( !empty($random_keys) ) :
						$current_key = array_shift($random_keys);
						echo $counselor_profiles_cache[$current_key]['small'];
					endwhile ?>
				</ul>
				<?php endif ?>
		</div><!-- #m-who -->

	<?php
}

function arche_the_front_page_how_it_works_section() { ?>

		<div id="m-how" itemscope="itemscope" itemtype="http://schema.org/Organization">
			<h2 class="section-title" itemprop="headline"><?php _e('How it works', 'arche'); ?></h2> 
			<div itemprop="text">
				<a href="<?php echo esc_url( arche_the_front_page_how_it_works_button_link() ); ?>" title="<?php echo esc_attr( arche_get_front_page_how_it_works_button_text() ); ?>">
					<?php arche_the_front_page_how_it_works_image_html() ?>
				</a>
				<div class="m-how-wrap">
					<?php arche_the_front_page_how_it_works_text(); ?>
					<a href="<?php echo esc_url( arche_the_front_page_how_it_works_button_link() ); ?>" class="cta button" title="<?php echo esc_attr( arche_get_front_page_how_it_works_button_text() ); ?>"><?php arche_the_front_page_how_it_works_button_text(); ?></a>
				</div>
			</div>	
		</div><!-- #m-how -->	

	<?php
}


/**
 * Add testimonials to the loop.
 */
function arche_frontpage_testimonial_loop() { 

	do_action( 'woothemes_testimonials', array( 'orderby' => 'rand', 'before' => '<section id="l-testimonials">', 'after' => '</section>' ) );
	echo '<!-- #l-testimonials -->';

}
add_action( 'genesis_before_footer', 'arche_frontpage_testimonial_loop' );

/**
 * Add inline style for testimonials background
 */
function arche_frontpage_testimonials_style() {
    $background_image_url = arche_get_front_page_testimonials_background_image_url();
    $custom_css = "#l-testimonials {
			background: transparent url('{$background_image_url}') no-repeat center center;
		}";
    wp_add_inline_style( 'arche', $custom_css ); // Stylesheet name is same as child theme name
}
add_action( 'wp_enqueue_scripts', 'arche_frontpage_testimonials_style' );

/**
 * Custom excerpt length page.
 */
function arche_excerpt_length( $length ) {
	return arche_get_front_page_articles_excerpt_length();
}
add_filter( 'excerpt_length', 'arche_excerpt_length', 999 );

/**
 * Add a read more link to the excerpt.
 *
 * @link http://wordpress.stackexchange.com/a/134145
 */
function arche_excerpt_more($more) {
    return '';
}
//add_filter('excerpt_more', 'arche_excerpt_more', 21 );

function arche_the_excerpt_more_link( $excerpt ){
    $post = get_post();
    $excerpt .= '<a href="'. get_permalink($post->ID) . '" title="'. get_the_title($post->ID) .'">'. __('continue reading', 'arche') .' &raquo;</a>';
    return $excerpt;
}
add_filter( 'the_excerpt', 'arche_the_excerpt_more_link', 21 );


/**
 * Limit number of tags shown per post.
 */
function arche_frontpage_tags_number( $terms ) {
	return array_slice( $terms, 0, arche_get_front_page_articles_max_tags(), true );
}
add_filter('term_links-post_tag','arche_frontpage_tags_number');

/**
 * Remove the default Genesis loop.
 */
function arche_frontpage_article_loop() { 
	$article_query_args = array(
		'posts_per_page' => 2,
	);
	$article_query   = new WP_Query( $article_query_args );
	$total_articles  = count( $article_query->get_posts() );
	$current_article = 0;

	if ( $article_query->have_posts() ) :
		?>
		<section id="l-articles" itemscope="itemscope" itemtype="http://schema.org/Blog">
			
			<h2 class="section-title"><?php _e('Latest articles written by our counselors', 'arche'); ?></h2>
	
		<?php while( $article_query->have_posts() ) : $article_query->the_post(); 
			$counselor_profiles_id = arche_get_counselor_profile_id_from_post( get_the_ID() );
			$current_article = $current_article + 1;
			$article_class = '';

			if( $total_articles === 1 ) {
				$article_class = '';
			} elseif ( $current_article === 1 ) {
				$article_class = 'class="first"';	
			} elseif ( $current_article === $total_articles ) {
				$article_class = 'class="last"';
			}
		?>
		                                                                                                        
			<article <?php echo $article_class; ?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
				<div class="article-meta">
					<div class="author-pic">
						<?php arche_the_counselor_profile_image_link_html( $counselor_profiles_id, 'square-small' ); ?>
						<!-- <a href="#" title="Andrew Engstrom"><img src="<?php bloginfo('url'); ?>/wp-content/uploads/2014/07/IMG_1697_edited-100x100.jpg" alt="Andrew Engstrom" /></a> -->
					</div>
					<div class="author-name">
						<h4><?php arche_the_counselor_profile_permalink_name_anchor( $counselor_profiles_id ); ?></h4>
						<span class="credentials"><?php echo esc_html( arche_get_counselor_profile_credentials( $counselor_profiles_id ) ); ?></span>
					</div>
					<div class="entry-date">
						<div class="entry-date-wrap-left">
							<div class="month"><?php the_time( 'M' ); ?></div>
							<div class="year"><?php the_time( 'Y' ); ?></div>
						</div>
						<div class="entry-date-wrap-right">
							<div class="day"><?php the_time( 'd' ); ?></div>
						</div>
					</div>
				</div>
				<div class="article-content">
		        	<h3 class="entry-title" itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
		        	<div class="entry-tags">
		        		<?php the_tags('', ' ', ''); ?>
		        	</div>
		        	<?php the_excerpt(); ?>
				</div>
			</article><!-- article -->
	
		<?php endwhile ?>
			
		</section><!-- #l-articles -->

<?php endif;
}

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'arche_frontpage_article_loop' );

function arche_frontpage_location_loop() {
$arche_settings = get_option('arche-settings');
$primary_location = (array) $arche_settings['primary-location'];


$location_query_args_first = array(
	'post_type'           => 'location', 
	'posts_per_page'      => -1,
	'ignore_sticky_posts' => true,
	'post__in'            => $primary_location,
	'orderby'             => 'name',
	'order'               => 'asc'
);
$location_query_first = new WP_Query( $location_query_args_first );			

$location_query_args = array(
	'post_type'           => 'location', 
	'posts_per_page'      => -1,
	'ignore_sticky_posts' => true,
	'post__not_in'        => $primary_location,
	'orderby'             => 'name',
	'order'               => 'asc'
);
$location_query = new WP_Query( $location_query_args );

if ( ( $location_query_first->have_posts() ) || $location_query->have_posts() ) : ?>
	<section id="l-locations" itemscope="itemscope" itemtype="http://schema.org/LocalBusiness">
		<div id="l-locations-inner">
			<h2 class="section-title" itemprop="headline"><?php _e('Our offices at Seattle Christian Counseling', 'arche'); ?></h2>
			
			<div id="m-locations">
				<ul id="locations" class="owl-carousel">
		<?php while( $location_query_first->have_posts() ) : $location_query_first->the_post(); ?>
	
			<li class="location vcard">
				<?php arche_the_location_image_link_html(); ?>
				<!-- <a href="#" title="View Office Details" class="location-image"><img class="lazyOwl" src="http://www.bothellcounseling.dev/wp-content/uploads/2014/07/location-bothell-250x140.jpg" alt="Bothell" /></a> -->
				<h3 class="fn org"><?php arche_the_location_permalink_name_anchor(); ?></h3>
				<!-- <h3 class="fn org"><a href="#" title="View Office Details">Bothell</a></h3> -->
				<span class="region"><?php arche_the_location_state(); ?></span>
				<h4><?php _e('Phone', 'arche'); ?></h4>
				<p class="adr">				
					<span class="telephone" itemprop="telephone"><?php arche_the_location_phone_link(); ?></span>
					<span class="street-address"><?php arche_the_location_street_number(); ?> <?php arche_the_location_street_address(); ?></span>
					<span class="locality"><?php arche_the_location_city(); ?></span>,&nbsp;<abbr class="region" title="<?php arche_the_location_state(); ?>"><?php arche_the_location_state_short(); ?></abbr>&nbsp;<span class="postal-code"><?php arche_the_location_postal(); ?></span>
				</p>
				<hr />
				<a href="<?php the_permalink(); ?>" title="<?php _e('View Office Details', 'arche'); ?>" class="details"><?php _e('View Office Details', 'arche'); ?></a>
			</li>
	
		<?php endwhile ?>
			<?php wp_reset_postdata(); ?>
		<?php while( $location_query->have_posts() ) : $location_query->the_post(); ?>
	
			<li class="location vcard">
				<?php arche_the_location_image_link_html(); ?>
				<!-- <a href="#" title="View Office Details" class="location-image"><img class="lazyOwl" src="http://www.bothellcounseling.dev/wp-content/uploads/2014/07/location-bothell-250x140.jpg" alt="Bothell" /></a> -->
				<h3 class="fn org"><?php arche_the_location_permalink_name_anchor(); ?></h3>
				<!-- <h3 class="fn org"><a href="#" title="View Office Details">Bothell</a></h3> -->
				<span class="region"><?php arche_the_location_state(); ?></span>
				<h4><?php _e('Phone', 'arche'); ?></h4>
				<p class="adr">				
					<span class="telephone" itemprop="telephone"><?php arche_the_location_phone_link(); ?></span>
					<span class="street-address"><?php arche_the_location_street_number(); ?> <?php arche_the_location_street_address(); ?></span>
					<span class="locality"><?php arche_the_location_city(); ?></span>,&nbsp;<abbr class="region" title="<?php arche_the_location_state(); ?>"><?php arche_the_location_state_short(); ?></abbr>&nbsp;<span class="postal-code"><?php arche_the_location_postal(); ?></span>
				</p>
				<hr />
				<a href="<?php the_permalink(); ?>" title="<?php _e('View Office Details', 'arche'); ?>" class="details"><?php _e('View Office Details', 'arche'); ?></a>
			</li>
	
		<?php endwhile ?>
			<?php wp_reset_postdata(); ?>
				</ul>
			</div>
		</div>
	</section><!-- #l-locations -->
<?php endif;

	
}
add_action( 'genesis_before_footer', 'arche_frontpage_location_loop' );

genesis(); ?>