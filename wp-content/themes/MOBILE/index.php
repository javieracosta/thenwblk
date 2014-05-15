<?php get_header(); ?>


	<div class="main news">
		<div class="wrapper-landscape">
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
				<?php 

					global $post;

					$news = get_posts( array( 'numberposts' => 20 ) );
					
					foreach( $news as $post ) :	setup_postdata($post); ?>

						<li><a href="<?php the_permalink(); ?>"><?php sanitize_title(the_title()); ?></a></li>

					<?php endforeach; ?>

				</ul>

			</div>
		</div>

	</div>



<?php get_footer(); ?>