<?php
/**
 * FOOTER template
 *
 * @package THENWBLK
 * @subpackage THENWBLK
 * @since THENWBLK 1.0
 */
?>

</div><!-- #page -->

       
<!--Facebook JavaScript SDK load-->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!--Pinterest JavaScipt package-->
<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>

<!--Twitter script-->
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>	
		
<script type="text/javascript">
//Email signup action
$('#email-signup-button').click( function() {
	$('#global-email-signup #sidebar-email.sidebar').fadeIn('fast');
});

//Contact
$('.inquiries').click(function(){
	$('#contactframe').show('slow');
});	
</script>

<?php wp_footer(); ?>
</body>
</html>