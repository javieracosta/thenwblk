<?php
/*
Template Name: About
*/
get_header(); ?>
<?php if (is_page('THE SPACE')) : ?>
<style type="text/css">

.singular #content, .singular .entry-header, .singular .entry-content, .singular footer.entry-meta, .singular #comments-title {
background:transparent;
}
</style>
<?php endif; ?>	
				
	<div id="primary" class="gray-bg">
		<div style="width:20%;float:left;margin-top:10%;">
			<?php wp_nav_menu( array( 'theme_location' => 'fourth' ) ); ?>
			
			<div id="global-email-signup">
				<div id="email-signup-button">SIGN UP FOR NWBLK NEWS & EVENTS</div>
				<?php get_sidebar('email'); ?>
			</div>

			<?php if (is_page('THE SPACE'))  : get_sidebar('space'); endif; ?>
		</div>
		<div id="content" style="width:80%;" role="main">
			
				<?php while ( have_posts() ) : the_post(); ?>
					
					<?php get_template_part( 'content', 'page' ); ?>
					
				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>