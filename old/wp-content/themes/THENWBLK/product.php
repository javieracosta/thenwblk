<?php
/*
Template Name: Product
*/
get_header(); ?>

	<div id="primary" class="gray-bg">
		<div style="float:left;width:20%;display:inline-block;margin-top:10%;">
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

$('#menu-profiles-header, .gallery-item a img[alt*="Yaffe"]').hover(
	function () {$('#menu-profiles-header').css('color','#ffffff');},
	function () {$('#menu-profiles-header').css('color','#000000');}
);

$('.menu-item a[href*="accessories"], .gallery-item a img[alt*="accessories"]').hover(
	function () {$('.menu-item a[href*="accessories"]').css('color','#ffffff');},
	function () {$('.menu-item a[href*="accessories"]').css('color','#000000');}
);

$('.menu-item a[href*="furniture"], .gallery-item a img[alt*="furniture"]').hover(
	function () {$('.menu-item a[href*="furniture"]').css('color','#ffffff');},
	function () {$('.menu-item a[href*="furniture"]').css('color','#000000');}
);

$('.menu-item a[href*="lighting"], .gallery-item a img[alt*="lighting"]').hover(
	function () {$('.menu-item a[href*="lighting"]').css('color','#ffffff');},
	function () {$('.menu-item a[href*="lighting"]').css('color','#000000');}
);

$('.menu-item a[href*="utility"], .gallery-item a img[alt*="utility"]').hover(
	function () {$('.menu-item a[href*="utility"]').css('color','#ffffff');},
	function () {$('.menu-item a[href*="utility"]').css('color','#000000');}
);

$('.menu-item a[href*="profiles"], .gallery-icon a[href*="profiles"]').hover(
	function () {$('.menu-item a[href*="profiles"]').css('color','#ffffff');},
	function () {$('.menu-item a[href*="profiles"]').css('color','#000000');}
);
</script>