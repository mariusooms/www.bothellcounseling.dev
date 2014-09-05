<?php 
/**
 * ------------------------------------------------------------------------------------
 * Template name: Profile
 * ------------------------------------------------------------------------------------
 */

//* Force Genesis layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar' );

function arche_the_profile_page_main() { ?>
	<section id="main-profile">
		<div id="counselor-single">
			<div class="counselor-list-cell">
				<div class="counselor-image">
					<!-- <img src="http://comm-imac.local:5757/wp-content/uploads/2014/09/Carolyn-profile-150x225.jpg" data-hi-res="http://comm-imac.local:5757/wp-content/uploads/2014/09/Carolyn-profile-270x405.jpg" data-lo-res="http://comm-imac.local:5757/wp-content/uploads/2014/09/Carolyn-profile-150x225.jpg" alt="Photo of Carolyn Peterson"> -->
					<img src="http://comm-imac.local:5757/wp-content/uploads/2014/09/Carolyn-profile-270x405.jpg" alt="Photo of Carolyn Peterson">			
				</div>
			</div><!-- .counselor-list-cell -->
			<div class="counselor-wrap">
				<div class="details-schedule">
					<div class="counselor-details">
						<h1 class="name-cred">
							<span class="name"><?php arche_the_counselor_profile_name( get_the_ID() ); ?></span>
							<ul class="credentials">
								<li><abbr title="Masters of Art">MA</abbr></li>
								<li><abbr title="Licensed Mental Health Counselor Associate">LMHCA</abbr></li>
							</ul>					
						</h1>
						<div class="jobdescription serif-italic"><?php arche_the_counselor_profile_job_title( get_the_ID() );?></div>
						<div class="contact">	
							<span class="tel"><?php arche_the_counselor_profile_phone_link( get_the_ID() ); ?></span>
							<span class="twitter"><?php arche_the_counselor_profile_twitter_link( get_the_id() ); ?></span>
						</div>				
					</div>
				<?php if (arche_get_counselor_profile_limited_slots_available()) : ?>
					<div class="schedule">
						<span class="badge">limited slots available</span>
					</div>
				<?php endif; ?>
				</div>
				<div class="short-bio">
					<?php arche_the_counselor_profile_short_biography( get_the_ID() ); ?>
				</div>												
				<hr />
				<div class="availability">
					<span>Availability</span>Bothell: Mon, Tue / Greenlake: Wed
				</div>				
			</div><!-- .counselor-wrap -->			
		</div><!-- #counselor-single -->
		
		<div id="profile-navigiation">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#about"><?php _e('About', 'arche' ); ?> Carolyn</a></li>
				<li><a href="#biography"><?php _e('Biography', 'arche' ); ?></a></li>
				<li><a href="#services-specialities"><?php _e('Services & Specialities', 'arche' ); ?></a></li>
				<li><a href="#payment-forms"><?php _e('Payment & Forms', 'arche' ); ?></a></li>
			</ul>
		</div>	
		<section id="about" class="tab-content active">
		    <div class="entry-content">
				<h2>Counseling Approach</h2>
				Each individual I work with has different goals for counseling, and the process of healing and change is unique to each person. My hope is that the relationship we form will provide you with a solid ground from which you can move with honesty and intention into the difficult areas of your life. Generally speaking, my counseling style is personalized to fit your unique needs. Having said that, I most commonly use a combination of cognitive-behavioral therapy (CBT), depth-oriented counseling and narrative approaches. I believe that while it is important to address the specific thoughts and behaviors that get in your way (CBT), it is also important to reach behind those thoughts and behaviors to meanings, patterns, and stories (depth and narrative approaches to counseling).
				<h2>Faith Based Counseling</h2>
				As a Christian counselor, I firmly believe the Holy Spirit is the true Counselor and the provider of both redemption and healing. I work with both Christian and non-Christian clients. It is up to my clients to decide whether they want to include aspects of faith and spirituality into our time together. Wherever you are on your faith journey, I am here as a compassionate and respectful listener who is ready to join you in wrestling with difficult questions.
				<h2>My Areas of Focus</h2>
				<ul>
					<li>Eating Disorders &amp; Body Image Concerns</li>
					<li>Chemical Dependency</li>
					<li>Teen Issues</li>
				</ul>
				<h2>I Also Work With</h2>
				<ul>
					<li>Depression</li>
					<li>Anxiety</li>
					<li>Crisis Management</li>
					<li>Self-Esteem</li>
					<li>Relationship Struggles</li>
					<li>Trauma</li>
					<li>Women’s Issues</li>
					<li>Grief &amp; Loss</li>
					<li>Christian Faith Struggles</li>
				</ul>
				For more information on my approach to eating disorder and chemical dependency treatment, please see my Specialties section.
				<h2>A Note to Parents</h2>
				If you are the parent of a struggling teen, you are taking a compassionate step in seeking help for your son or daughter. We all know that adolescence can be a particularly trying time for our youth, yet these years can also be a time of profound growth and development. In working with your teen, it is not my objective to “fix” him or her. Instead, my job is to come alongside your son or daughter in an honest and authentic way that will be both supportive and challenging, while at the same time working to uphold and strengthen your relationship with your child. We will work together to find their unique way of being in the world, as well as open doors to a fuller and more intentional way of life.
				<h2>On a Personal Note</h2>
				I am a native to the Pacific Northwest, so naturally I enjoy coffee, rain boots, and my dog. I take every opportunity to travel that I can, and have especially enjoyed trips to central Mexico, Turkey, and India. I also like card games, Chipotle, and The Voice. If I could go to any sporting event in Seattle I would pick the Sounders, hands down.
		    </div>
		</section>
		<section id="biography" class="tab-content hide">
		    <div class="entry-content">
	            <h2>Education and Experience</h2>
				<ul>
				<li>I am a Licensed Mental Health Counselor Associate with a Masters Degree in Counseling Psychology from Northwest University. One reason why I chose this graduate program is because it places particular emphasis on the cultural and faith-based components of counseling, both of which I’m very passionate about. Prior to my masters program I received a Bachelor’s Degree in Psychology from Whitworth University, along with minors in Theology and Spanish.</li>
				<li>&nbsp;In addition to my private practice experience I worked at Eastside Academy, where I provided one-on-one counseling to teenagers with a variety of cultural backgrounds and experiences. This work focused primarily on substance abuse recovery, but also included counseling for problems such as depression, anxiety, trauma, relational difficulties, and faith struggles. I have also provided crisis management to patients of Spokane Mental Health. In addition to my work as a counselor, I have been involved in ministry with Young Life working extensively with youth.</li>
				</ul>
		    </div>
		</section>
		<section id="services-specialities" class="tab-content hide">
		    <div class="entry-content">
				<h2>For Teens with Substance Abuse Struggles</h2>
				
				An important part of my practice involves providing counseling to adolescents struggling with substance abuse and chemical dependency. Unfortunately, struggles in this area are common among teens, with half of high school seniors reporting at some point they used an illicit drug and a quarter reporting they used an illicit drug within the past 30 days (MTF, 2011). Every teen that struggles with substance abuse has a unique combination of biological, psychological, and social factors that contributes to his or her use. Each of these factors needs to be taken into consideration as we work together to break the cycle of abuse and dependency.
				
				<h2>Bio-Psycho-Social Counseling Approach</h2>
				
				<h3>Biological</h3>
				
				A person’s biology can play a role in pre-disposing them to drug addiction and dependency. While it is not the aim of counseling to change a person’s biology, understanding and taking into consideration one’s biological predispositions can play an important role in recovery from substance abuse.
				
				<h3>Psychological</h3>
				
				In our work together, we will examine the function that substances serve in your life, and then determine together how to meet your needs in more effective, life-giving ways. A significant part of therapy will involve identifying the underlying issues that have led to and sustained your use. These issues may include depression, anxiety, relational struggles, family problems, or others. We will also address the practical, day-to-day circumstances that surround your use and develop skills to help you in recovery.
				
				<h3>Social</h3>
				
				We are all influenced by our social surroundings, including our families, peers, and cultural contexts. It is important to sort through the messages you’ve received around substance use, figure out where you stand on those issues, and determine whether that stance matches with your goals and values.
				
				Therapy should not be a disempowering experience where someone else decides things for you. Instead, I am here to help you clarify your goals in life and take the steps that will allow you to pursue those goals more fully.
				
				<h2>For Individuals with Eating Disorders</h2>
				
				If you find yourself struggling with an eating disorder, know that you are not alone. Statistics suggest that in the United States, more than 10 million women and 1 million men suffer from Anorexia and Bulimia Nervosa, while still millions more struggle with Binge-Eating Disorder (National Eating Disorder Association, 2005). Contrary to popular belief, these disorders affect men and women of all different ages, cultures, ethnicities, and body-sizes. Although we live in a society that glamorizes thinness, eating disorders are not the result of vanity or extreme attempts at beauty. Instead, individuals with these disorders find themselves caught in a brutal cycle characterized by shame, loss of control, self-contempt, and secrecy. Eating disorders are both painful and isolating experiences, and the first step toward getting your life back is reaching out to someone who can guide and support you through the recovery process.
				
				<h2>A Team Treatment Approach</h2>
				
				<h3>Counseling:</h3>
				
				During our sessions, we will focus on practical, daily concerns as well as explore what led to the development of your eating disorder. For example, we will work to develop healthy coping skills, rework unhelpful thought patterns, and collaborate with a dietician around nutrition when necessary. We will also talk about struggles with anxiety, depression, and self-worth. I am convinced that you did not wake up one morning and decide to develop an eating disorder. As destructive and painful as these behaviors are, they serve a function in your life. A significant part of counseling will involve coming to an understanding of what that function is, and then developing new, more life giving tools to meet those needs.
				
				<h3>Medical Doctor:</h3>
				
				Eating disorders can result in serious and even fatal medical complications. For this reason I ask my clients to regularly visit a medical doctor who is knowledgeable and experienced in the treatment of eating disorders when clinically necessary. This partnership will help ensure that you are medically safe and will provide you with a resource for any concerns you have about the impact of your eating disorder on your body.
				
				<h3>Dietitian:</h3>
				
				I also ask that my clients see a dietitian or nutritionist who specializes in eating disorder treatment. This relationship will be essential for developing healthy eating skills, leaning about nutrition, and helping you work through any concerns you have about specific foods and their effects on your body. Just as is true in counseling, it will be essential that we find a medical doctor and a dietitian you trust and feel supported by. I am here to help you in that process.
		    </div>
		</section>
		<section id="payment-forms" class="tab-content hide">
		    <div class="entry-content">
		    	<h2>The next step</h2>
				Whether you are looking for time spent in an individual counseling session or family counseling, there is a setting that is right for you. Choose from individual counseling or family therapy, or if the office setting isn’t quite right for you, we can take our time outside to the beautiful Greenlake setting.
				
				<h3>Sessions:</h3>  I offer 53-minute or 45-minute sessions. Sessions can be held more than once per week, weekly, or every other week. Scheduling options are discussed in greater detail during your initial consultation.
				
				<h3>Fees:</h3> I offer a Risk-Free initial consultation for individuals and families. Payment for your Risk-Free consultation is due only if you decide to continue the counseling process. The full fee per session is required at the time of service. For more information regarding standard session fees, please view my Forms section.
				
				<h3>Insurance:</h3> As a Licensed Mental Health Counselor (LMHC) a majority of insurance companies will reimburse for a portion of my services (as an Out of Network Provider). Please consult with your insurance provider as to whether they specifically cover individual, couple, or family therapy.
				
				<h3>Receipts/Statements:</h3> In the event you require a printed or digital receipt, I will provide receipts for personal use, insurance reimbursement, Flex Spending Accounts (FSA), and Health Savings Accounts (HSA).
				
				<h3>Payment options:</h3> Cash, Check, or Credit Card (Visa, MasterCard, Discover, & American Express). A fee of up to 3.7% plus $0.15 per transaction will be added for credit card payments.				
		    </div>
			<ul id="counselor-forms">
				<li><a href="#" class="cta button" title="Individual Form"><?php _e('Individual Form', 'arche' ); ?></a></li>
				<li><a href="#" class="cta button" title="Couples Form"><?php _e('Couples Form', 'arche' ); ?></a></li>
			</ul>		    
		</section>		
	</section>
	<?php
}
add_action( 'genesis_before_loop', 'arche_the_profile_page_main' );

/**
 * Add testimonials to the loop.
 */
function arche_profile_testimonial_loop() { 

	do_action( 'woothemes_testimonials', array( 'orderby' => 'rand', 'before' => '<section id="l-testimonials">', 'after' => '</section>' ) );
	echo '<!-- #l-testimonials -->';

}
add_action( 'genesis_before_footer', 'arche_profile_testimonial_loop' );

/**
 * Add inline style for testimonials background
 */
function arche_profile_testimonials_style() {
    $background_image_url = arche_get_front_page_testimonials_background_image_url();
    $custom_css = "#l-testimonials {
			background: transparent url('{$background_image_url}') no-repeat center center;
		}";
    wp_add_inline_style( 'arche', $custom_css ); // Stylesheet name is same as child theme name
}
add_action( 'wp_enqueue_scripts', 'arche_profile_testimonials_style' );
 
//* Remove the default Genesis loop
remove_action( 'genesis_loop', 'genesis_do_loop' );

?>

<?php genesis(); ?>