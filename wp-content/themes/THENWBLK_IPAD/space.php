<?php
/*
Template Name: Space
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
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('space')) : else : ?>
  			<!-- All this stuff in here only shows up if you DON'T have any widgets active in this zone -->
  		<?php endif; ?>	
		</div>

	</div>

</div>

<?php get_footer(); ?>