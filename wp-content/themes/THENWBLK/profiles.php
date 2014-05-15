<?php
/*
Template Name: Individual Profiles
*/
get_header(); ?>

<style type="text/css">
.gallery + p {
	margin-top:12.5%;
}
</style>

	<div id="primary" class="gray-bg">
		<div style="margin-top:10%;width:20%;float:left;display:inline-block;">
			<?php wp_nav_menu( array( 'theme_location' => 'sixth' ) ); ?>
			<a id="small-designer-arrow" href="/profiles">&nbsp</a>
		</div>
		
		<div id="content" style="width:80%;float:left;background:white;" role="main">
			
			<?php while ( have_posts() ) : the_post(); ?>
						
				<?php get_template_part( 'content', 'page' ); ?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->
	<?php get_footer(); ?>
