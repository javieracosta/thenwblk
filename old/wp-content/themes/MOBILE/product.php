<?php
/*
Template Name: Product
*/
get_header(); ?>

	<div class="main product">
		
		<div class="agenda-top">
			<?php /*TODO: Improve code*/ ?>
			<h1>Product</h1>
			<?php wp_nav_menu( array( 'theme_location' => 'third', 'depth' => '1' ) ); ?>
		</div>

		<div class="content">
			<?php while ( have_posts() ) : the_post(); ?>
						
			<?php print apply_filters( 'the_content', '[gallery size="iphone-thumbnail" ]' ); ?>

			<?php endwhile; // end of the loop. ?>
		</div>

	</div>

<?php get_footer(); ?>