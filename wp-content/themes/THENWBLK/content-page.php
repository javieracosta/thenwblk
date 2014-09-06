<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage THENWBLK
 * @since THENWBLK 1.0
 */
?>
<style type="text/css">
		<?php if(is_front_page() ): ?>
body {
	background: url(/wp-content/themes/THENWBLK/images/new_landing.jpg) no-repeat center center fixed; 
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
	overflow:hidden;
	}
	<?php endif; ?>
</style>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<div class="entry-content">
		<div class="inner-content">	
		<?php the_content(); ?>
		
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'THENWBLK' ) . '</span>', 'after' => '</div>' ) ); ?>
		</div>
	</div><!-- .entry-content -->
	<footer class="entry-meta">
		<?php edit_post_link( __( 'Edit', 'THENWBLK' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
