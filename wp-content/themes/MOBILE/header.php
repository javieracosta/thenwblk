<!doctype html>

<html <?php language_attributes(); ?> class="no-js">

	<head>
		<meta charset="utf-8">

		<!-- Google Chrome Frame for IE -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title><?php
			/*
			 * Print the <title> tag based on what is being viewed.
			 */
			global $page, $paged;

			wp_title( '|', true, 'right' );

			// Add the blog name.
			bloginfo( 'name' );

			// Add the blog description for the home/front page.
			$site_description = get_bloginfo( 'description', 'display' );
			if ( $site_description && ( is_home() || is_front_page() ) )
				echo " | $site_description";

			// Add a page number if necessary:
			if ( $paged >= 2 || $page >= 2 )
				echo ' | ' . sprintf( __( 'Page %s', 'THENWBLK' ), max( $paged, $page ) );

		?></title>

		<!-- mobile meta (hooray!) -->
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) -->
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-icon-touch.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">


		<!-- wordpress head functions -->
		<?php wp_head(); ?>
		<!-- end of wordpress head -->

		<!-- drop Google Analytics Here -->
		<!-- end analytics -->

	</head>

	<body <?php body_class(); ?>>

		<div id="container">
		<?php wp_reset_query(); ?>
	    <header>

	      <div class="arrow back">
		      <?php if (have_posts() && is_single() || is_page_template('gallery-product.php')) previous_post_link('%link', ' '); ?>
      		<?php if (is_page_template('mission.php')) : ?>
      			<button class="arrow back ir ">Back</button>
	      	<?php endif; ?>
	      </div>

	      <a href="<?php echo home_url(); ?>" title="" id="logo" class="logo"><img src="<?php echo get_template_directory_uri(); ?>/library/images/layout/logo.png" alt="" /></a>
	      

				<div class="arrow forward">
		    	<?php if (have_posts() && is_single() || is_page_template('gallery-product.php')) next_post_link('%link', ' '); ?>
	      	<?php if (is_page_template('mission.php')) : ?>
	      		<button class="arrow forward ir">forward</button>
	      	<?php endif; ?>
				</div>


	      <div class="bars"></div>

    	</header>