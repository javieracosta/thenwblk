<?php
/*
Template Name: Accessory
*/
get_header(); ?>

	<div class="main product">
		
		<?php get_template_part( 'sidebar', 'products' ); ?>
		
		<div class="content">
			<?php while ( have_posts() ) : the_post(); ?>
						
			<?php print apply_filters( 'the_content', '[gallery size="ipad-thumbnail" ]' ); ?>

			<?php endwhile; // end of the loop. ?>
		</div>

	</div>

<?php get_footer(); ?>