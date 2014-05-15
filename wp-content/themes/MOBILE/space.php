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
			<div class="content">
				
				<?php /* while ( have_posts() ) : the_post(); ?>
					
					<?php the_content(); ?>
					
				<?php endwhile; // end of the loop. */?>

			  <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('space')) : else : ?>
		  	<!-- All this stuff in here only shows up if you DON'T have any widgets active in this zone -->
		  	<?php endif; ?>		
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>