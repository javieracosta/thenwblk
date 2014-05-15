<?php
/*
Template Name: Product
*/
get_header(); ?>

	<div id="primary" class="gray-bg">
		<div style="float:left;width:20%;display:inline-block;margin-top:10%;">
			<?php wp_nav_menu( array( 'theme_location' => 'third' ) ); ?>
			<div id="menu-profiles-header">MADE BY</div>
			<div id="menu-categories-header">CATEGORIES</div>
			<?php wp_nav_menu( array( 'theme_location' => 'sixth' ) ); ?>
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
	$('.menu-profiles-container').show('slow');
	$('#menu-categories-header').show('slow');
	$('#menu-profiles-header').hide();
	$('.menu-product-container').hide();
});

$('#menu-categories-header').click(function(){
	$('#menu-profiles-header').show('slow');
	$('.menu-product-container').show('slow');
	$('.menu-profiles-container').hide();
	$('#menu-categories-header').hide();
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
	function () {$(this).css('color','#ffffff');},
	function () {$(this).css('color','#000000');}
);
</script>