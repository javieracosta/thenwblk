<?php
/*
Template Name: Utility
*/
get_header(); ?>

	<div id="primary" class="gray-bg">
		<div id="product-menu-container">
			<div id="menu-categories-header">CATEGORIES</div>
			<?php wp_nav_menu( array( 'theme_location' => 'third' ) ); ?>
			<div id="menu-profiles-header">MADE BY</div>
			<?php wp_nav_menu( array( 'theme_location' => 'fifth' ) ); ?>
		</div>
			
		<div id="product-content" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
					
				<?php the_content(); ?>

			<?php endwhile; // end of the loop. ?>
		</div><!-- #content -->
	</div><!-- #primary -->
	<?php get_footer(); ?>
	
<script>
$('#menu-profiles-header').click(function(){
	$('.menu-made-by-container').css('display','block');
	$('#menu-categories-header').css('display','block');
	$('#menu-profiles-header').css('display','none');
	$('.menu-product-container').css('display','none');
});

$('#menu-categories-header').click(function(){
	$('.menu-made-by-container').css('display','none');
	$('#menu-categories-header').css('display','none');
	$('#menu-profiles-header').css('display','block');
	$('.menu-product-container').css('display','block');
});

$('.menu-item a[href*="/transport"], .gallery-item a img[alt*="transport"]').hover(
	function () {$('.menu-item a[href*="/transport"]').css('color','#ffffff');},
	function () {$('.menu-item a[href*="/transport"]').css('color','#000000');}
);

$('.menu-item a[href*="/wear"], .gallery-item a img[alt*="wear"]').hover(
	function () {$('.menu-item a[href*="/wear"]').css('color','#ffffff');},
	function () {$('.menu-item a[href*="/wear"]').css('color','#000000');}
);

$('.menu-item a[href*="/inform"], .gallery-item a img[alt*="inform"]').hover(
	function () {$('.menu-item a[href*="/inform"]').css('color','#ffffff');},
	function () {$('.menu-item a[href*="/inform"]').css('color','#000000');}
);

$('.menu-item a[href*="/consume"], .gallery-item a img[alt*="consume"]').hover(
	function () {$('.menu-item a[href*="/consume"]').css('color','#ffffff');},
	function () {$('.menu-item a[href*="/consume"]').css('color','#000000');}
);

$('.menu-item a[href*="/listen"], .gallery-item a img[alt*="listen"]').hover(
	function () {$('.menu-item a[href*="/listen"]').css('color','#ffffff');},
	function () {$('.menu-item a[href*="/listen"]').css('color','#000000');}
);
</script>