<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage THENWBLK
 * @since THENWBLK 1.0
 */

get_header(); ?>

<style type="text/css">
.gallery {
	width:25%;
}

#access ul ul {
	display:block;
}

p * a {
	font-family:'helvetica neue';
	text-decoration:underline;
	color:#fff;
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
				</div>			</div>
				
				<!-- the loop! -->
				<?php while ( have_posts() ) : the_post(); ?>

					<div id="blog-content" style="">
						<article id="post-<?php the_ID(); ?>">
	
						<div id="entry-content">
							<header class="news-header">
								<a href="<?php get_permalink(); ?>"><?php the_title(); ?></a>
		
								<?php if ( 'post' == get_post_type() ) : ?>
									<div class="entry-meta">
										<?php thenwblk_posted_on(); ?>
									</div><!-- .entry-meta -->
								<?php endif; ?>
							</header><!-- .entry-header -->
	
					<?php the_content(); ?>
		
					<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'THENWBLK' ) . '</span>', 'after' => '</div>' ) ); ?>
						</div><!-- .entry-content -->

				
		<div style="clear:both;"></div>
					

						<div id="post-sharing-news" style="margin-top:1em;">
			<fb:like send="false" layout="button_count" width="450" show_faces="false" colorscheme="light" font="trebuchet ms"></fb:like>
		
			<a style="width:31%;" href="https://twitter.com/share" class="twitter-share-button" data-hashtags="THENWBLK" data-url="<?php //Send Link URI grab
					$Path=$_SERVER['REQUEST_URI'];
					$URI= bloginfo('url').$Path; 
					echo $URI ?>">Tweet</a>
					
			<!--<a id="product-email" href='mailto:?subject=PRODUCT | THENWBLK <?php echo $item_name;?>&body=<?php 
			$Path=$_SERVER['REQUEST_URI'];
			$URI= bloginfo('url').$Path; 
			echo $URI ?>
			'>Send Link</a>-->
						</div>
		
	<!-- Arrow Navigation and blog sharing -->
					<nav id="nav-single">
						<h3 class="assistive-text"><?php _e( 'Post navigation', 'THENWBLK' ); ?></h3>
						<span class="prevpage"><?php previous_post_link( '%link', __( '<span class="meta-nav"></span>', 'THENWBLK' ) ); ?></span>
						<span class="nextpage"><?php next_post_link( '%link', __( '<span class="meta-nav"></span>', 'THENWBLK' ) ); ?></span>
					</nav><!-- #nav-single -->
			
				</footer><!-- .entry-meta -->
			</article><!-- #post-<?php the_ID(); ?> -->
			
			<?php endwhile; // end of the loop. ?>
	
		</div>
	</div><!-- #primary -->

<?php get_footer(); ?>

<script>
	$('.custom-archive').click(function(){
		$('.archive-category').css('display','none');
		$(this).find('.archive-category').fadeIn();
	});
</script>