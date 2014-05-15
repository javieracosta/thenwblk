<?php
/*
Template Name: About
*/
get_header(); ?>

<div class="main">
		
	<div class="left">
		<?php wp_nav_menu( array( 'theme_location' => 'fourth' ) ); ?>	
	</div>
	
	<div class="content-wrapper">

		<div class="left">
			<?php echo (strpos($post->post_content,'[gallery') !== false ) ? do_shortcode('[gallery size="ipad-thumbnail"]') : ""; ?>
		</div>

		<div class="content">
			<?php while ( have_posts() ) : the_post(); ?>
				
				<?php the_content(); ?>
				
			<?php endwhile; // end of the loop. ?>
		</div>

	</div>

</div>

<?php get_footer(); ?>