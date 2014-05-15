<?php
/*
Template Name: Mission
*/
get_header(); ?>

<?php
	$current_page = get_page(get_the_ID());
	$parent = get_page($current_page->post_parent);
?>

<div class="main">

<script type="text/javascript">

jQuery(document).ready(function($){

  //$('#primary, #slideshow #slidesContainer .slide, #slideshow #slidesContainer').css('height', $('#container').height());
  var currentPosition = 0;
  // var slideWidth = window.innerWidth;
  var slideWidth = $('#container').width();
  var slides = $('.slide');
  var numberOfSlides = slides.length;
  
  // Remove scrollbar in JS
  $('#slidesContainer').css('overflow', 'hidden');
  
  //Contains each slide's content
  $('.sidebar').css('max-width',window.innerWidth);

  // Wrap all .slides with #slideInner div
  slides
    .wrapAll('<div id="slideInner"></div>')
    // Float left to display horizontally, readjust .slides width
	.css({
      'float' : 'left',
      'width' : slideWidth
    });

  // Set #slideInner width equal to total width of all slides
  $('#slideInner').css('width', slideWidth * numberOfSlides);

// Dynamically set the slide container and slide(s) based on browser dimensions
$('#slideshow #slidesContainer').css('width',$('#container').width());
$('#slideshow #slidesContainer .slide').css('width',$('#container').width());

  // Insert controls in the DOM
  // $('#slideshow')
  //  .prepend('<span class="control" id="leftControl">Clicking moves left</span>')
  //  .append('<span class="control" id="rightControl">Clicking moves right</span>');

  // Hide left arrow control on first load
  //manageControls(currentPosition);


  $('button.arrow').click(function(){
  	currentPosition = $(this).hasClass('forward') ? currentPosition + 1 : currentPosition - 1;

  	if ( (currentPosition == 0) || (currentPosition == numberOfSlides - 1)  ){
  		return false;
  	}

  	//manageControls(currentPosition);
  	
  	$('#slideInner, #designersArePeople').animate({'marginLeft' : slideWidth*(-currentPosition)});
  });


  // Create event listeners for .controls clicks
  $('.control').bind('click', function(){
    // Determine new position
	currentPosition = ($(this).attr('id')=='rightControl') ? currentPosition+1 : currentPosition-1;
    
	// Hide / show controls
    manageControls(currentPosition);
    // Move slideInner using margin-left
    $('#slideInner, #designersArePeople').animate({
      'marginLeft' : slideWidth*(-currentPosition)
    });
  });

  // manageControls: Hides and Shows controls depending on currentPosition
  function manageControls(position){
    // Hide left arrow if position is first slide
	if(position==0){ $('.arrow.back').addClass('invisible') } else{ $('.arrow.back').removeClass('invisible') }
	// Hide right arrow if position is last slide
    if(position==numberOfSlides-1){ $('.arrow.forward').addClass('invisible') } else{ $('.arrow.forward').removeClass('invisible') }
  }	
});
</script>
			
	<div id="primary" class="gray-bg">
		<div id="slideshow">
			<div id="slidesContainer">
				<div class="slide">
					
					<?php if( 6 == $parent->ID) : ?> <div class="agenda-top"> <?php endif; ?>

					<h1> <?php echo $parent->post_title; ?> </h1>
					<?php bones_agenda_nav(); ?>

					<?php if( 6 == $parent->ID)	: ?> </div> <?php endif; ?>

					<style> #rightControl {background: url('/wp-content/themes/THENWBLK/images/black_arrow_right.png') no-repeat;} #rightControl:hover {background: url('/wp-content/themes/THENWBLK/images/arrow_right.png') no-repeat;} </style>
					<img id="mission-1" style="margin:10% 5%;width:90%;" src="/wp-content/themes/THENWBLK/images/Mission_Type.png" />
				</div>
				
				<div class="slide" style="background:url(/wp-content/themes/THENWBLK/images/get-attachment-15.jpg) no-repeat center center; background-size:cover;">			
					<img style="position:relative; left:30%; top:65%; width:65%;" src="/wp-content/themes/THENWBLK/images/appliedarts.png" />
				</div>
				
				<div class="slide" style="background:url(/wp-content/themes/THENWBLK/images/DSC_6958.jpg) no-repeat center center; background-size:cover;">
					<?php get_sidebar('building'); ?>
				</div>
				
				<div class="slide" style="background:url(/wp-content/themes/THENWBLK/images/DSC_6785.jpg) no-repeat center center; background-size:cover;">
					<?php get_sidebar('mission-designers'); ?>
				</div>
				
				<div class="slide" style="background:url(/wp-content/themes/THENWBLK/images/DSC_7480.jpg) no-repeat center center; background-size:cover;">
					<?php get_sidebar('craft-mission'); ?>
				</div>
				
				<div class="slide" style="background:url(/wp-content/themes/THENWBLK/images/incubate.jpg) no-repeat center center; background-size:cover;">
					<?php get_sidebar('incubate'); ?>
				</div>
				
				<div class="slide" style="background:url(/wp-content/themes/THENWBLK/images/bg_mission_art_fade.png) no-repeat center center; background-size:cover;">
					<?php get_sidebar('art'); ?>
				</div>
				
				<div class="slide" style="background:url(/wp-content/themes/THENWBLK/images/DSC_6962.jpg) no-repeat center center; background-size:cover;">
					<?php get_sidebar('partners'); ?>
				</div>
			</div>
		</div>
			
	</div><!-- #primary -->

</div>


<?php get_footer(); ?>

<!-- Alters arrow colors-->
<script>
jQuery(document).ready(function($){
    $("#rightControl").click(function () {
      $("#rightControl").hover(function () {
	 	$('#rightControl').css('background','url("/wp-content/themes/THENWBLK/images/black_arrow_right.png") no-repeat');
	},
	  function () {
		$('#rightControl').css('background','url("/wp-content/themes/THENWBLK/images/arrow_right.png") no-repeat');
	}
);
    });
});
</script>	