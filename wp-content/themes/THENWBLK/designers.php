<?php
/*
Template Name: Profiles
*/
get_header(); ?>
<style>
#access ul ul {
	display: block;	
}
</style>
	<div id="primary" class="gray-bg">
		<!-- <div style="margin-top:10%;width:20%;float:left;display:inline-block;position:fixed;"> -->
		<div style="margin-top:10%;width:20%;float:left;display:inline-block;">
			<?php wp_nav_menu( array( 'theme_location' => 'sixth' ) ); ?>
			<a id="small-designer-arrow" href="/product">&nbsp</a>
		</div>
		<div id="product-content" style="float:right;" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
						
				<?php the_content(); ?>

			<?php endwhile; // end of the loop. ?>
		
		</div><!-- #content -->
	</div><!-- #primary -->
	<?php get_footer(); ?>

<script>

$('.menu-item a[href*="maarten"], .gallery-item a[href*="maarten"]').hover(
	function () { $('.menu-item a[href*="maarten"]').css('color','#ffffff');},
	function () { $('.menu-item a[href*="maarten"]').css('color','#000000');}
);
$('.menu-item a[href*="feay"], .gallery-item a[href*="feay"]').hover(
	function () { $('.menu-item a[href*="feay"]').css('color','#ffffff');},
	function () { $('.menu-item a[href*="feay"]').css('color','#000000');}
);
$('.menu-item a[href*="anzfer"], .gallery-item a[href*="anzfer"]').hover(
	function () { $('.menu-item a[href*="anzfer"]').css('color','#ffffff');},
	function () { $('.menu-item a[href*="anzfer"]').css('color','#000000');}
);
$('.menu-item a[href*="racuk"], .gallery-item a[href*="racuk"]').hover(
	function () { $('.menu-item a[href*="racuk"]').css('color','#ffffff');},
	function () { $('.menu-item a[href*="racuk"]').css('color','#000000');}
);
$('.menu-item a[href*="ascalon"], .gallery-item a[href*="ascalon"]').hover(
	function () { $('.menu-item a[href*="ascalon"]').css('color','#ffffff');},
	function () { $('.menu-item a[href*="ascalon"]').css('color','#000000');}
);
$('.menu-item a[href*="budnitz"], .gallery-item a[href*="budnitz"]').hover(
	function () { $('.menu-item a[href*="budnitz"]').css('color','#ffffff');},
	function () { $('.menu-item a[href*="budnitz"]').css('color','#000000');}
);
$('.menu-item a[href*="burwell"], .gallery-item a[href*="burwell"]').hover(
	function () { $('.menu-item a[href*="burwell"]').css('color','#ffffff');},
	function () { $('.menu-item a[href*="burwell"]').css('color','#000000');}
);
$('.menu-item a[href*="boots"], .gallery-item a[href*="boots"]').hover(
	function () { $('.menu-item a[href*="boots"]').css('color','#ffffff');},
	function () { $('.menu-item a[href*="boots"]').css('color','#000000');}
);
$('.menu-item a[href*="concreteworks"], .gallery-item a[href*="concreteworks"]').hover(
	function () { $('.menu-item a[href*="concreteworks"]').css('color','#ffffff');},
	function () { $('.menu-item a[href*="concreteworks"]').css('color','#000000');}
);
$('.menu-item a[href*="council"], .gallery-item a[href*="council"]').hover(
	function () { $('.menu-item a[href*="council"]').css('color','#ffffff');},
	function () { $('.menu-item a[href*="council"]').css('color','#000000');}
);
$('.menu-item a[href*="taylor"], .gallery-item a[href*="taylor"]').hover(
	function () { $('.menu-item a[href*="taylor"]').css('color','#ffffff');},
	function () { $('.menu-item a[href*="taylor"]').css('color','#000000');}
);
$('.menu-item a[href*="hutton"], .gallery-item a[href*="hutton"]').hover(
	function () { $('.menu-item a[href*="hutton"]').css('color','#ffffff');},
	function () { $('.menu-item a[href*="hutton"]').css('color','#000000');}
);
$('.menu-item a[href*="doucet"], .gallery-item a[href*="doucet"]').hover(
	function () { $('.menu-item a[href*="doucet"]').css('color','#ffffff');},
	function () { $('.menu-item a[href*="doucet"]').css('color','#000000');}
);
$('.menu-item a[href*="geremia"], .gallery-item a[href*="geremia"]').hover(
	function () { $('.menu-item a[href*="geremia"]').css('color','#ffffff');},
	function () { $('.menu-item a[href*="geremia"]').css('color','#000000');}
);
$('.menu-item a[href*="maaike"], .gallery-item a[href*="maaike"]').hover(
	function () { $('.menu-item a[href*="maaike"]').css('color','#ffffff');},
	function () { $('.menu-item a[href*="maaike"]').css('color','#000000');}
);
$('.menu-item a[href*="collective"], .gallery-item a[href*="collective"]').hover(
	function () { $('.menu-item a[href*="collective"]').css('color','#ffffff');},
	function () { $('.menu-item a[href*="collective"]').css('color','#000000');}
);
$('.menu-item a[href*="yaffe"], .gallery-item a[href*="yaffe"]').hover(
	function () { $('.menu-item a[href*="yaffe"]').css('color','#ffffff');},
	function () { $('.menu-item a[href*="yaffe"]').css('color','#000000');}
);
$('.menu-item a[href*="phase"], .gallery-item a[href*="phase"]').hover(
	function () { $('.menu-item a[href*="phase"]').css('color','#ffffff');},
	function () { $('.menu-item a[href*="phase"]').css('color','#000000');}
);
$('.menu-item a[href*="miller"], .gallery-item a[href*="miller"]').hover(
	function () { $('.menu-item a[href*="miller"]').css('color','#ffffff');},
	function () { $('.menu-item a[href*="miller"]').css('color','#000000');}
);
$('.menu-item a[href*="carella"], .gallery-item a[href*="carella"]').hover(
	function () { $('.menu-item a[href*="carella"]').css('color','#ffffff');},
	function () { $('.menu-item a[href*="carella"]').css('color','#000000');}
);
</script>

