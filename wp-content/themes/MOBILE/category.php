<?php get_header(); ?>


	<div class="main news">

		<div class="agenda-top">
			<?php //TODO: Improve h1 code. ?>
			<h1> Agenda </h1>
			<?php bones_agenda_nav(); ?>
		</div>
	
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('email')) : else : ?>
	  <!-- All this stuff in here only shows up if you DON'T have any widgets active in this zone -->
    <?php endif; ?>
    
		<div class="content">

			<ul class="press-items">

					<?php if(have_posts()) : while( have_posts()) : the_post(); ?>
			
						<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>

					<?php endwhile; endif; ?>

			</ul>

		</div>

	</div>



<?php get_footer(); ?>