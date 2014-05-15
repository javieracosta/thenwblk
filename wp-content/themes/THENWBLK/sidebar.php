<?php
/**
 * The Sidebar containing the main widget area.
 *
 * @package WordPress
 * @subpackage THENWBLK
 * @since THENWBLK 1.0
 */

$options = THENWBLK_get_theme_options();
$current_layout = $options['theme_layout'];

if ( 'content' != $current_layout ) :
?>
		<div id="secondary" class="widget-area" role="complementary">
			<?php if ( ! dynamic_sidebar( ) ) : ?>

			<?php endif; // end sidebar widget area ?>
		</div><!-- #secondary .widget-area -->
<?php endif; ?>