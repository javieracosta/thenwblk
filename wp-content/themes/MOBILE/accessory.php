<?php
/*
Template Name: Accessory
*/
get_header(); ?>

	<div class="main product">
		<div class="wrapper-landscape">
			
			<?php get_template_part('nav', 'product'); ?>

			<div class="content" id="product-menu-container">

				<?php $id = get_query_var("pdb"); ?>
				<div id="<?php if(empty($id)) echo 'product-content'; else echo 'item-content' ?>" role="main">

					<?php while ( have_posts() ) : the_post(); ?>
								
					<?php  the_content(); //print apply_filters( 'the_content', '[gallery size="iphone-thumbnail" ]' ); ?>

					<?php endwhile; // end of the loop. ?>

			</div>
		</div>

	</div>

<?php get_footer(); ?>