<?php
/*
Template Name: About
*/
get_header(); ?>

<div class="main">
	<div class="wrapper-landscape">
		<div class="agenda-top">
			<?php //TODO: Improve h1 code. ?>
			<h1> About </h1>
			<?php wp_nav_menu( array( 'theme_location' => 'fourth' ) ); ?>	

		</div>	
	</div>
	<div class="landscape-white">
		<div class="wrapper-landscape">
			<?php echo (strpos($post->post_content,'[gallery') !== false ) ? do_shortcode('[gallery size="iphone-about-thumbnail"]') : ""; ?>
			
			<div class="content">
				
				<?php while ( have_posts() ) : the_post(); ?>
					
					<?php the_content(); ?>
					
				<?php endwhile; // end of the loop. ?>
			</div>
		</div>
	</div>

</div>

<?php get_footer(); ?>