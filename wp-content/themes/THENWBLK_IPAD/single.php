<?php get_header(); ?>
		<div class="main news">

			<div class="left">

				<div class="wrapper">
					<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('email')) : else : ?>
		  		<!-- All this stuff in here only shows up if you DON'T have any widgets active in this zone -->
	    		<?php endif; ?>
					
					<?php get_template_part('news', 'category-menu') ?>

				</div>

			</div>

			<div class="content-wrapper">

			<?php if (have_posts()) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
					<section class="images left">
						<?php echo (strpos($post->post_content,'[gallery') !== false ) ? do_shortcode('[gallery size="ipad-thumbnail"]') : ""; ?>					
					</section>
					<section class="entry-content" itemprop="articleBody">
						<h1 class="entry-title single-title" itemprop="headline"><?php the_title(); ?></h1>
						<?php the_content(); ?>
						<!-- social stuff -->
						<div id="post-sharing-news" class="social-buttons">
							<fb:like href="<?php echo get_permalink(); ?>" send="false" layout="button_count" width="450" show_faces="false" colorscheme="light" font="trebuchet ms"></fb:like>
							<a style="width:31%;" href="https://twitter.com/share" class="twitter-share-button" data-hashtags="THENWBLK" data-url="<?php echo get_permalink(); ?>"></a>
						</div>
						
					</section>
				</article>

			<div class="navigation">
				<div class="prev"><?php next_post_link('%link', 'Older post' ); ?></div>
				<div class="next"><?php previous_post_link('%link', 'Newer post' ); ?></div>			
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

		</div>

<?php get_footer(); ?>
