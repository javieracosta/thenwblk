<?php
/*
Template Name: Furniture
*/
get_header(); ?>

	<div class="main product">
		
		<?php get_template_part('nav', 'product'); ?>

		<div class="content">
			<?php while ( have_posts() ) : the_post(); ?>
						
			<?php print apply_filters( 'the_content', '[gallery size="iphone-thumbnail" ]' ); ?>

			<?php endwhile; // end of the loop. ?>
		</div>

	</div>

<?php get_footer(); ?>