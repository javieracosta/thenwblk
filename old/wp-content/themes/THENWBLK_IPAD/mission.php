<?php
/*
Template Name: Mission
*/
get_header(); ?>

<div id="preloader"></div>
<div class="main">
	
 	<!-- slider container -->
	<div class = 'iosSlider' id="iosMission">
    
	  <!-- slider -->
	  <div class = 'slider'>

	    <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('mission-ipad')) : else : ?>
  	  <!-- All this stuff in here only shows up if you DON'T have any widgets active in this zone -->
	    <?php endif; ?>
  
  	</div>

	</div>

</div>


<?php get_footer(); ?>