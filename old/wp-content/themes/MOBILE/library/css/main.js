jQuery(document).ready(function($) {

  var feeds = new NewsFeeds($); // Pass the jQuery Object
  
  /* Agenda - Mission page slider */
  $('#iosMission').iosSlider({
    navPrevSelector : $('button.back'),
    navNextSelector : $('button.forward'),
    elasticFrictionCoefficient: 0.9,
    elasticPullResistance: 1,
    desktopClickDrag : true,
    snapToChildren: true,
    infiniteSlider: true
  });   

  /* Agenda - Mission page slider */
  $('#iosNews').iosSlider({
    navPrevSelector : $('button.back'),
    navNextSelector : $('button.forward'),
    desktopClickDrag : true,
    snapToChildren: true,
    onSliderLoaded: function(e) {

      $(e.currentSlideObject).find('.entry-content').find('.gallery').remove();
      var imageCount = $(e.currentSlideObject).find('.gallery').find('.gallery-item').length;

      if( 1 < imageCount ) {
          $(e.currentSlideObject).find('.gallery').find('.gallery-item').addClass('float');
      }

      var setHeight = $(e.currentSlideObject).outerHeight(true);
      $('#iosNews').css({height: setHeight});

    },

    onSlideComplete: function(e){
      $(e.currentSlideObject).find('.entry-content').find('.gallery').remove();

      var setHeight = $(e.currentSlideObject).outerHeight(true);
      var imageCount = $(e.currentSlideObject).find('.gallery').find('.gallery-item').length;

      if( 1 < imageCount ) {
          $(e.currentSlideObject).find('.gallery').find('.gallery-item').addClass('float');
      }

      $('#iosNews').css({height: setHeight});
     
      feeds.GetPosts(e);
    }
  });

    var gal = $('.product-page').find('#galleria').detach();
    gal.appendTo('#item-content');

    // Forward button functionalities when in Products page.
    $('button.forward').click(function(){
      var next_page; 
      
      // If in single product page
      if($('#nextProduct').size() > 0 ) {
        next_page =  $('#nextProduct').attr('href');
      }
      
      // If in Accessory Page
      if($('.nextpage').size() > 0 ) {
        next_page =  $('.nextpage').find('a').attr('href');
      }

      if ( !next_page ) return false;

      window.location.href = nextPage;
    });    

    // Back button functionalities when in Products page.
    $('button.back').click(function(){
      var prev_page;

      // If in single product page
      if($('#prevProduct').size() > 0 ) {
        prev_page =  $('#prevProduct').attr('href');
      }

      // If in Accessory Page
      if($('.prevpage').size() > 0 ) {
        prev_page = $('.prevpage').find('a').attr('href');
      }

      if ( !prev_page ) return false;

      window.location.href = prev_page;

    });

});

// News Feeds Class
var NewsFeeds = function(jQuery) {
  $ = jQuery;
  var element;
}

NewsFeeds.prototype.GetPosts = function(e) {

  this.element = $(e.currentSlideObject).parent().parent();

  if (e.currentSlideNumber == e.data.numberOfSlides) {
    var prevLink = $(e.currentSlideObject).find('input[name="prevLink"]').val();

    if (! prevLink) return;

    this.GetPost(prevLink, true);
  }

  if (e.currentSlideNumber == 1 ) {
    var nextLink = $(e.currentSlideObject).find('input[name="nextLink"]').val();

    if (! nextLink) return;

    this.GetPost(nextLink);
  }

};

NewsFeeds.prototype.GetPost = function(link, is_append, callback ) {
  var element = this.element;

  $.get(link, function(html){
    element.iosSlider('addSlide', html, is_append ? element.find('.slide').length + 1 : 1);    
  });

};

NewsFeeds.prototype.ChangeURI = function() {
    
}