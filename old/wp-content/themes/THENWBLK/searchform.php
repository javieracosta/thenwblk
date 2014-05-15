<?php
/**
 * The template for displaying search forms in THENWBLK
 *
 * @package WordPress
 * @subpackage THENWBLK
 * @since THENWBLK 1.0
 */
?>
	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<label for="s" class="assistive-text"><?php _e( 'Search', 'THENWBLK' ); ?></label>
		<input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'THENWBLK' ); ?>" />
		<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'THENWBLK' ); ?>" />
	</form>
