<?php
/*
Template Name: Utility
*/
get_header(); ?>

	<div class="main product">
		
		<aside>
			<?php wp_nav_menu( array( 'theme_location' => 'third', 'depth' => '2' ) ); ?>
		</aside>

		<div class="content">
			<?php while ( have_posts() ) : the_post(); ?>
						
			<?php print apply_filters( 'the_content', '[gallery size="ipad-thumbnail" ]' ); ?>

			<?php endwhile; // end of the loop. ?>
		</div>

	</div>

<?php get_footer(); ?>