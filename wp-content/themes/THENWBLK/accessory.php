<?php
/*
Template Name: Accessory
*/
get_header(); ?>
<style type='text/css'>
			#{$selector} {
				display:inline-block;
			}
			#{$selector} .gallery-item {
				float: {$float};
				text-align: center;
				width: 100%;
			}
			#{$selector} img {
				vertical-align:bottom;
				border: 0;
			}
			#{$selector} .gallery-caption {
				margin-left: 0;
			}
		</style>
	<div id="primary" class="gray-bg">
		
		<div id="product-menu-container">
			<div id="menu-categories-header">CATEGORIES</div>
			<?php wp_nav_menu( array( 'theme_location' => 'third' ) ); ?>
			<div id="menu-profiles-header">MADE BY</div>
			<?php wp_nav_menu( array( 'theme_location' => 'fifth' ) ); ?>
		</div>
		<?php $id = get_query_var("pdb"); ?>
			<div id="<?php if(empty($id)) echo 'product-content'; else echo 'item-content' ?>" role="main">
				<?php while ( have_posts() ) : the_post(); ?>
					
					<?php the_content(); ?>
					
				<?php endwhile; // end of the loop. ?>

			<!-- closing </div> tag for #item-content is in PDb_List.class.php -->
		
		</div><!-- #primary -->
<script type="text/javascript">
var gallery = $($("#product-content").children()[1]);
gallery.removeClass("products-database").addClass("gallery galleryid-8 gallery-columns-4 gallery-size-medium");
gallery.attr("id","gallery-2");
$('#menu-profiles-header').click(function(){
	$('.menu-made-by-container').show('slow');
	$('#menu-categories-header').show('slow');
	$('#menu-profiles-header').hide();
	$('.menu-product-container').hide();
});

$('#menu-categories-header').click(function(){
	$('#menu-profiles-header').show('slow');
	$('.menu-product-container').show('slow');
	$('.menu-made-by-container').hide();
	$('#menu-categories-header').hide();
});
</script>
<?php get_footer(); ?>