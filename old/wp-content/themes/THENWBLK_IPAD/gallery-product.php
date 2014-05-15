<?php
/*
Template Name: Gallery-Product
*/
get_header(); ?>

	<div class="main product">
		
		<aside>
			<?php wp_nav_menu( array( 'theme_location' => 'third', 'depth' => '2' ) ); ?>
		</aside>

		<?php $id = get_query_var("pdb"); ?>

		<div id="<?php if(empty($id)) echo 'product-content'; else echo 'item-content' ?>" role="main" class="product-content content">

			<?php while ( have_posts() ) : the_post(); ?>
				
				<?php the_content(); ?>
				
			<?php endwhile; // end of the loop. ?>

			<!-- closing </div> tag for #item-content is in PDb_List.class.php -->	

	</div>

	<div class="fb-root"></div>

<?php get_footer(); ?>