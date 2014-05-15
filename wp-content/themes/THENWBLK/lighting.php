<?php
/*
Template Name: Lighting
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

$('.menu-item a[href*="pendant"], .gallery-item a img[alt*="pendant"]').hover(
	function () {$('.menu-item a[href*="pendant"]').css('color','#ffffff');},
	function () {$('.menu-item a[href*="pendant"]').css('color','#000000');}
);
$('.menu-item a[href*="floor"], .gallery-item a img[alt*="floor"]').hover(
	function () {$('.menu-item a[href*="floor"]').css('color','#ffffff');},
	function () {$('.menu-item a[href*="floor"]').css('color','#000000');}
);
$('.menu-item a[href*="lamps"], .gallery-item a img[alt*="lamps"]').hover(
	function () {$('.menu-item a[href*="lamps"]').css('color','#ffffff');},
	function () {$('.menu-item a[href*="lamps"]').css('color','#000000');}
);
$('.menu-item a[href*="wall"], .gallery-item a img[alt*="wall"]').hover(
	function () {$('.menu-item a[href*="wall"]').css('color','#ffffff');},
	function () {$('.menu-item a[href*="wall"]').css('color','#000000');}
);	
</script>