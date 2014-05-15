<?php if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') : the_post(); ?>
<?php $prev_post = get_previous_post(1); ?>
<?php $next_post = get_next_post(1); ?>
	
	<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix slide'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
		
		<?php if (isset($prev_post->ID)) : ?>
			<input type="hidden" name="prevLink" value="<?php echo get_permalink($prev_post->ID); ?>" />
		<?php endif; ?>

		<?php if (isset($next_post->ID)) : ?>
			<input type="hidden" name="nextLink" value="<?php echo get_permalink($next_post->ID); ?>" />
		<?php endif; ?>

		<?php echo (strpos($post->post_content,'[gallery') !== false ) ? do_shortcode('[gallery size="iphone-thumbnail"]') : ""; ?>
		
		<h1 class="entry-title single-title" itemprop="headline"><?php the_title(); ?></h1>

		<section class="entry-content" itemprop="articleBody">
			<?php the_content(); ?>
		</section> <!-- end article section -->

	</article> <!-- end article -->

<?php exit(); endif; ?>

<?php get_header(); ?>
		<div class="main news">

			<?php if (have_posts()) : the_post(); ?>

					<?php $prev_post = get_previous_post(1); ?>
					<?php $next_post = get_next_post(1); ?>

					<div class="iosSlider" id="iosNews">

						<div class="slider">
							
							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix slide'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
								
								<?php if (isset($prev_post->ID)) : ?>
									<input type="hidden" name="prevLink" value="<?php echo get_permalink($prev_post->ID); ?>" />
								<?php endif; ?>

								<?php if (isset($next_post->ID)) : ?>
									<input type="hidden" name="nextLink" value="<?php echo get_permalink($next_post->ID); ?>" />
								<?php endif; ?>

								<?php echo (strpos($post->post_content,'[gallery') !== false ) ? do_shortcode('[gallery size="iphone-thumbnail"]') : ""; ?>
								
								<h1 class="entry-title single-title" itemprop="headline"><?php the_title(); ?></h1>

								<section class="entry-content" itemprop="articleBody">
									<?php the_content(); ?>
								</section> <!-- end article section -->

							</article> <!-- end article -->

						</div>

					</div>

				<?php else : ?>

					<article id="post-not-found" class="hentry clearfix">
						<p><?php _e("Oops, Post Not Found!", "bonestheme"); ?></p>
						<section class="entry-content">
							<p><?php _e("Uh Oh. Something is missing. Try double checking things.", "bonestheme"); ?></p>
						</section>
					</article>

				<?php endif; ?>

		</div>

<?php get_footer(); ?>
