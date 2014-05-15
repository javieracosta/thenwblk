<?php
/*
Template Name: Gallery-Product
*/
get_header(); ?>
<?php $product_id = get_query_var("pdb"); ?>

	<div class="main <?php  echo empty( $product_id ) ? 'product' : 'product-page' ?> ">

		<div class="wrapper-landscape">

		<?php if( empty( $product_id ) ) get_template_part( 'nav', 'product' );  ?>		

			<div id="<?php echo empty( $product_id ) ? 'product-content' : 'item-content' ?>" role="main" class="product-content">

				<?php while ( have_posts() ) : the_post(); ?>
					
					<?php the_content(); ?>
					
				<?php endwhile; // end of the loop. ?>

				<!-- closing </div> tag for #item-content is in PDb_List.class.php -->	

		</div>

	</div>

	<div class="fb-root"></div>

<?php get_footer(); ?>