<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage THENWBLK
 */
get_header(); ?>
<style>
#access ul ul {
	display:block;
}
p a {
	font-family:'helvetica neue';
	color:#fff;
}

p a:hover {
	text-decoration:underline;
}
</style>
		<div id="primary" class="gray-bg">
			<div id="blog-archives">
				<?php get_sidebar('email'); ?>
				<div class="custom-archive"><h2>EVENTS</h2>
					<ul class="archive-category">
					<?php wp_get_archives('type=postbypost&cat=13&limit=10&format=custom'); ?>
					</ul>
				</div>
				<div class="custom-archive"><h2>VIDEOS</h2>
					<ul class="archive-category">
					<?php wp_get_archives('type=postbypost&cat=15&limit=10&format=custom'); ?>
					</ul>
				</div>
				<div class="custom-archive"><h2>PRODUCT NEWS</h2>
					<ul class="archive-category">
					<?php wp_get_archives('type=postbypost&cat=14&limit=10&format=custom'); ?>
					</ul>
				</div>
				<div class="custom-archive"><h2>PRESS</h2>
					<ul class="archive-category">
					<?php wp_get_archives('type=postbypost&cat=12&limit=10&format=custom'); ?>
					</ul>
				</div>
			</div>
			
			<div id="blog-content" role="main">

			<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					
					<?php get_template_part( 'content-single', get_post_format() ); ?>

				<?php endwhile; ?>

				<?php thenwblk_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'thenwblk' ); ?></h1>
					</header><!-- .entry-header -->
					<div class="entry-content">
						<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'thenwblk' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>

<script>
	$('.custom-archive').click(function(){
		$('.archive-category').css('display','none');
		$(this).find('.archive-category').fadeIn();
	});
</script>