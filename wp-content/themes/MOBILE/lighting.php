<?php
/*
Template Name: Lighting
*/
get_header(); ?>

	<div class="main product">
		<div class="wrapper-landscape">
			
			<?php get_template_part('nav', 'product'); ?>
			
			<div class="content">
				<?php while ( have_posts() ) : the_post(); ?>
							
				<?php print apply_filters( 'the_content', '[gallery size="iphone-thumbnail" ]' ); ?>

				<?php endwhile; // end of the loop. ?>
			</div>
		</div>

	</div>

<?php get_footer(); ?>