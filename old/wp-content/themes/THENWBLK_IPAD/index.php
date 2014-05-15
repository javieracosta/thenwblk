<?php get_header(); ?>

<?php if ( get_the_ID() == 1910 ) : ?>
	
	<div class="main news">

		<div class="left">

			<div class="wrapper">

				<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('email')) : else : ?>
	  		<!-- All this stuff in here only shows up if you DON'T have any widgets active in this zone -->
    		<?php endif; ?>
				
				<ul class="press-items">
					<?php 

						global $post;

						$news = get_posts( array( 'numberposts' => 3, 'category' => 12 ) );
						
						foreach( $news as $post ) :	setup_postdata($post); ?>

						<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>

					<?php endforeach; ?>

				</ul>

			</div>

		</div>

		<div class="content-wrapper">

			<?php if (have_posts()) : while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
					<section class="images left">
						<?php echo (strpos($post->post_content,'[gallery') !== false ) ? do_shortcode('[gallery size="ipad-thumbnail"]') : ""; ?>
					</section>
					<section class="entry-content" itemprop="articleBody">
						<h2 class="entry-title single-title" itemprop="headline"><a href="<?php the_permalink() ?>"><?php  the_title(); ?></a></h2>
						<?php the_content(); ?>
					</section>
				</article>

			<?php endwhile; else : ?>

				<article id="post-not-found" class="hentry clearfix">
					<p><?php _e("Oops, Post Not Found!", "bonestheme"); ?></p>
					<section class="entry-content">
						<p><?php _e("Uh Oh. Something is missing. Try double checking things.", "bonestheme"); ?></p>
					</section>
				</article>

			<?php endif; ?>

		</div>

	</div>

<?php endif; ?>

<?php get_footer(); ?>