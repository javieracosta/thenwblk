<?php
/**
 * The template for displaying content in the single.php template
 *
 * @package WordPress
 * @subpackage THENWBLK
 * @since THENWBLK 1.0
 */
?>


<article id="post-<?php the_ID(); ?>" class="news-post">
	<header class="news-header">
		<a href="<?php get_permalink(the_ID()); ?>"><?php the_title(); ?></a>
		
		<!--<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php thenwblk_posted_on(); ?>
		</div>
		<?php endif; ?>-->
		
		
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'THENWBLK' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	

	<footer class="entry-meta">
		<!--<?php
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( __( ', ', 'THENWBLK' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', __( ', ', 'THENWBLK' ) );
			if ( '' != $tag_list ) {
				$utility_text = __( 'This entry was posted in %1$s and tagged %2$s by <a href="%6$s">%5$s</a>. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'THENWBLK' );
			} elseif ( '' != $categories_list ) {
				$utility_text = __( 'This entry was posted in %1$s by <a href="%6$s">%5$s</a>. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'THENWBLK' );
			} else {
				$utility_text = __( 'This entry was posted by <a href="%6$s">%5$s</a>. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'THENWBLK' );
			}

			printf(
				$utility_text,
				$categories_list,
				$tag_list,
				esc_url( get_permalink() ),
				the_title_attribute( 'echo=0' ),
				get_the_author(),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )
			);
		?>
		
		<?php edit_post_link( __( 'Edit', 'THENWBLK' ), '<span class="edit-link">', '</span>' ); ?>-->
		
		<br />
		
		<!-- social stuff -->
		<div id="post-sharing-news">
			<fb:like href="<?php echo get_permalink(); ?>" send="false" layout="button_count" width="450" show_faces="false" colorscheme="light" font="trebuchet ms"></fb:like>
		
			<a style="width:31%;" href="https://twitter.com/share" class="twitter-share-button" data-hashtags="THENWBLK" data-url="<?php echo get_permalink(); ?>">Tweet</a>

		</div>
		
		
	</footer><!-- .entry-meta -->
	<hr class="blog-rule">
</article><!-- #post-<?php the_ID(); ?> -->

