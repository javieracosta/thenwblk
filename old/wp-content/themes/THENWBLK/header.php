<?php
/**
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage THENWBLK
 * @since THENWBLK 1.0
 */
?>

<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE]>
<style>
#primary.gray-bg {
	background: rgb(238, 233, 233);
}
.galleria-stage {
	width:50%;
	margin-left:50%;
}
</style>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html xmlns:fb="http://ogp.me/ns/fb#" <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta name="google-site-verification" content="NRyuYF5dVGF_jBHG4tfSGH4rZXctUVwun0Mqi4S8iyo" />
<meta name="google-site-verification" content="mCj2CVTM1RTpwJzS9srmgVokakySMd3vS5qvBltIFIc" />
<meta http-equiv="X-UA-Compatible" content="IE=8"/>
<meta property="og:title" content="THE NWBLK" />
<meta property="og:type" content="blog" />
<meta property="og:url" content="<?php //Send Link URI grab
					$Path=$_SERVER['REQUEST_URI'];
					$URI= bloginfo('url').$Path; 
					echo $URI ?>" />
<meta property="og:image" content="<?php bloginfo('template_directory'); ?>/images/NWBLK_logo.png" />
<meta property="og:site_name" content="THE NWBLK" />
<meta property="fb:admins" content="100002235034397" />

<!--FontDeck section-->
<script type="text/javascript">
WebFontConfig = { fontdeck: { id: '23344' } };

(function() {
  var wf = document.createElement('script');
  wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
  '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
  wf.type = 'text/javascript';
  wf.async = 'true';
  var s = document.getElementsByTagName('script')[0];
  s.parentNode.insertBefore(wf, s);
})();
</script>

<!--Custom favicon-->
<link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/images/NWBLK_favicon.png" />

<!--Product page photo gallery-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
<script src="/wp-content/themes/THENWBLK/js/galleria-1.2.8.min.js"></script>
<script src="/wp-content/themes/THENWBLK/js/galleria.classic.js"></script>
<link rel="stylesheet" href="/wp-content/themes/THENWBLK/js/galleria.classic.css">
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'THENWBLK' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="stylesheet" type="text/css" media="print" href="<?php bloginfo('template_directory'); ?>/print.css" />
<link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 768px)" href="<?php bloginfo('template_directory'); ?>/ipad.css" />
<link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 480px)" href="<?php bloginfo('template_directory'); ?>/iphone.css" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<!--VERY IMPORTANT-->
<?php wp_head(); ?>

<!--Set body background according to page template-->
<style type="text/css">
<?php if(is_page_template('furniture.php' || 'product.php' || 'lighting.php' || 'accessories.php' || 'utility.php' || 'profiles.php' || 'designers.php' || 'gallery-product.php' || 'gallery-product-designers.php')) : ?>
body {
	background: url(<?php bloginfo('template_directory'); ?>/images/background_gallery.png) no-repeat center center fixed; 
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
}
<?php endif; ?>	

<?php if(is_page_template('mission.php')) : ?>
body {
	background: url(<?php bloginfo('template_directory'); ?>/images/background_agenda.png) no-repeat center center fixed; 
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
}
<?php endif; ?>

<?php if(is_page_template('craft.php')) : ?>
body {
	background: url(<?php bloginfo('template_directory'); ?>/images/background_craft.png) no-repeat center center fixed; 
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
}

.singular .entry-content {
	width:100%;
}
<?php endif; ?>

<?php if(is_page_template('about.php')) : ?>
body {
	background: url(<?php bloginfo('template_directory'); ?>/images/background_events.png) no-repeat center center fixed; 
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
}
.singular #content {
	float:left;
	margin:0;
}
.singular .entry-header, .singular .entry-content, .singular footer.entry-meta, .singular #comments-title {
	width:100%;
	margin:0;
}
<?php endif; ?>
</style>    

<!--Site-wide setup scripts-->
<script>
$(document).ready(function() {

// Script(s) to dynamically resize font throughout
	var $body = $('body'); //Cache this for performance
			
    var setFontScale = function() {
    	var scaleSource = $body.width(),
        	scaleFactor = .073,
            maxScale = 1000,
            minScale = 60; //Tweak these values to taste
	
			var fontSize = scaleSource * scaleFactor; //Multiply the width of the body by the scaling factor:			

		if (fontSize > maxScale) fontSize = maxScale;
        if (fontSize < minScale) fontSize = minScale; //Enforce the minimum and maximums

        $('body').css('font-size', fontSize + '%');
	}
	
    	$(window).resize(function(){
    		setFontScale();
    	});
//Fire it when the page first loads:
	setFontScale();

//Hide email signup
//$('#global-email-signup #sidebar-email.sidebar').hide();

//Size the product/designer tiles according to browser
var $fifthWidth = ($(window).innerWidth())/5;
	$('.products-database').css('height', ($fifthWidth*3));
	$('.item-tile').css('width', $fifthWidth);
	$('.item-tile').css('height', $fifthWidth);	

//Remove arrow nav from product page, when appropriate
$('#nextProduct[href="http://thenwblk.com/product/product/?pdb="],#prevProduct[href="http://thenwblk.com/product/product/?pdb="]').hide();

});
</script> 

</head>

<body <?php body_class(); ?>>

<div id="page">
	<div id="header">
	
		<!--Header Logo-->
		<div id="header-logo">
			<a href="/">
				<img src="<?php bloginfo('template_directory'); ?>/images/NWBLK_logo.png"/>
			</a>
		</div>
		
		<!--Header Lines-->
		<img id="header-lines" src="<?php bloginfo('template_directory'); ?>/images/header_lines.png"/>
	
		<!--Main Nav Menu-->
		<nav id="access" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			<div style="clear:both;"></div>
		</nav>
		
	</div><!-- #header -->
	
	<!--content follows…-->