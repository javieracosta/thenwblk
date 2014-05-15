<?php get_header(); ?>

<?php
	$current_page = get_page(get_the_ID());
	$parent = get_page($current_page->post_parent);
?>

<div class="main">

	<?php if( 6 == $parent->ID) : ?>
		<div class="agenda-top">
	<?php endif; ?>

		<h1> <?php echo $parent->post_title; ?> </h1>
		<?php bones_agenda_nav(); ?>

	<?php if( 6 == $parent->ID)	: ?> </div> <?php endif; ?>

</div>


<?php get_footer(); ?>
