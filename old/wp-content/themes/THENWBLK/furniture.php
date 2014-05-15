<?php
/*
Template Name: Furniture
*/
get_header(); ?>

	<div id="primary" class="gray-bg">
		<div id="product-menu-container">
			<?php wp_nav_menu( array( 'theme_location' => 'third' ) ); ?>
			<div id="menu-profiles-header">MADE BY</div>
			<?php wp_nav_menu( array( 'theme_location' => 'fifth' ) ); ?>
			<div id="menu-categories-header">CATEGORIES</div>
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

$('.menu-item a[href*="tables"], .gallery-item a img[alt*="tables"]').hover(
	function () {$('.menu-item a[href*="tables"]').css('color','#ffffff');},
	function () {$('.menu-item a[href*="tables"]').css('color','#000000');}
);

$('.menu-item a[href*="casegoods"], .gallery-item a img[alt*="casegoods"]').hover(
	function () {$('.menu-item a[href*="casegoods"]').css('color','#ffffff');},
	function () {$('.menu-item a[href*="casegoods"]').css('color','#000000');}
);

$('.menu-item a[href*="seating"], .gallery-item a img[alt*="seating"]').hover(
	function () {$('.menu-item a[href*="seating"]').css('color','#ffffff');},
	function () {$('.menu-item a[href*="seating"]').css('color','#000000');}
);

$('.menu-item a[href*="shelving"], .gallery-item a img[alt*="shelving"]').hover(
	function () {$('.menu-item a[href*="shelving"]').css('color','#ffffff');},
	function () {$('.menu-item a[href*="shelving"]').css('color','#000000');}
);

$('.menu-item a[href*="miscellaneous"], .gallery-item a img[alt*="miscellaneous"]').hover(
	function () {$('.menu-item a[href*="miscellaneous"]').css('color','#ffffff');},
	function () {$('.menu-item a[href*="miscellaneous"]').css('color','#000000');}
);
</script>