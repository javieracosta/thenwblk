<?php
/*
Template Name: Gallery-Product-Designers
*/
get_header(); ?>

	<div id="primary" class="gray-bg">
		
		<div id="product-menu-container">
			<?php wp_nav_menu( array( 'theme_location' => 'third' ) ); ?>
			<div id="menu-categories-header">CATEGORIES</div>
			<div id="menu-profiles-header">MADE BY</div>
			<?php wp_nav_menu( array( 'theme_location' => 'sixth' ) ); ?>
		</div>
			<div id="product-content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>
					
					<?php the_content(); ?>
					
				<?php endwhile; // end of the loop. ?>

			<!-- closing </div> tag for #item-content is in PDb_List.class.php -->
		
		</div><!-- #primary -->

<script>
$('.menu-made-by-container').show();
$('#menu-categories-header').show();
$('#menu-profiles-header').hide();
$('.menu-product-container').hide();

$('#menu-categories-header').click(function(){
	$('#menu-profiles-header').show('slow');
	$('.menu-product-container').show('slow');
	$('.menu-profiles-container').hide();
	$('#menu-categories-header').hide();
});

$('#menu-profiles-header').click(function(){
	$('.menu-profiles-container').show('slow');
	$('#menu-categories-header').show('slow');
	$('#menu-profiles-header').hide();
	$('.menu-product-container').hide();
});
</script>


<?php get_footer(); ?>