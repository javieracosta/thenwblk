<?php
/*
Template Name: Craft
*/
get_header(); ?>
<script type="text/javascript">
$(document).ready(function(){
	var $slideHeight = $(window).innerHeight();
	$('#portfolio-slideshow0').css('height',$slideHeight);
});
</script>					
	<div id="primary" style="overflow:hidden;" class="gray-bg">
		<?php get_sidebar( 'craft' ); ?>
		
		<div id="content" role="main">			
		
			<?php while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>			
			<?php endwhile; // end of the loop. ?>
		
		</div><!-- #content -->
		
	</div><!-- #primary -->

<?php get_footer(); ?>