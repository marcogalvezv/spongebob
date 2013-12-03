/* 

66Themes - Premium Site Templates & Wordpress Themes

*/

$(document).ready(function() {
  // Handler for .ready() called.
  
  //Submenu fade in on hover menu item hover
  $(".headerInner ul li").find('ul').fadeTo(0, 0).hide();
  
  $('.headerInner > ul > li').each(function(index) {
  	$(this).find('>ul').css('left', '-' + Math.round((($(this).find('>ul').width()/2)-($(this).width()/2))-3) + 'px');
  });
  
  $(".headerInner ul li").hover( function () {
   	$(this).find('>ul').show()
    $(this).find('>ul').stop().animate({
    	opacity: 1,
        top: '38'
      }, 300, function() {
        // Animation complete.
      });
    },
    function () {
      $(this).find('>ul').stop().animate({
      	  opacity: 0,
          top: '45'
        }, 100, function() {
          $(this).hide()
        });
    }
  );
  
  //Any Sub Level submenu
  $(".headerInner ul li ul li").hover( function () {
   	$(this).find('>ul').show()
   	$(this).find('>ul').css('top', ($(this).position().top + 16) + 'px')
    $(this).find('>ul').stop().animate({
    	opacity: 1,
        top: $(this).position().top + 9
      }, 300, function() {
        // Animation complete.
      });
    },
    function () {
      $(this).find('>ul').stop().animate({
      	  opacity: 0,
      	  top: $(this).position().top + 16
        }, 100, function() {
          $(this).hide();
        });
    }
  );
  //End submenu code
  
  //Selectbox nav
  $('#selectNav').find('option:first').attr('selected', 'selected').parent('select');
  $("#selectNav").change(function () {
    $("#selectNav option:selected").each(function () {
    	if ($(this).attr('value') != "") {
    		window.location = $(this).attr('value');
    	}
    });
  })
  .trigger('change');
  
  //Input fields placeholder functionality
  $('input, textarea').placeholder();
  
  //Footer Tweets
  $(".tweet").tweet({
      username: "EnvatoWebDesign",
      join_text: "auto",
      count: 3,
      auto_join_text_default: "", 
      auto_join_text_ed: "",
      auto_join_text_ing: "",
      auto_join_text_reply: "",
      auto_join_text_url: "",
      loading_text: "Loading tweets..."
  });
  
  //Google Maps API Code
  //Footer Maps init
  var myLatlng = new google.maps.LatLng(-17.38318,-66.145443);
    var myOptions = {
      zoom: 15,
      disableDefaultUI: true,
      center: myLatlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    var map = new google.maps.Map(document.getElementById("mapCanvas"), myOptions);
  
		//PidamosAlgo
        var image = base_url+'images/maps/icons/logo64x50.png';
        var myLatLng = new google.maps.LatLng(-17.38318,-66.145443);
        var beachMarker = new google.maps.Marker({
            position: myLatLng,
            map: map,
			center: myLatLng,
            icon: image
        });
/*    var marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        title:"PidamosAlgo"
    });
*/    
    //Footer Bottom Go To Top Button Functionality
    $('.topButton').click(function(){
	    $('html, body').animate({scrollTop:0}, 'slow');
	     
	    return false;
    });
    
    //jQuery UI
    //Tabs init
    $("#tabs").tabs({ selected: 0 });
    
    //Accordion init
    $("#accordion").accordion();
    
    //Toggles init
    $('#main').find('.toggle .toggleContent').stop().slideToggle(0, function() {
	    $('#main').find('.toggle .toggleOpen').parent().find('.toggleContent').stop().slideToggle(0, function() {
	    	// Animation complete.
	    });
    });
    
    $('.toggle h3').click(function(){
		$(this).toggleClass('toggleOpen').parent().find('.toggleContent').stop().slideToggle(100, function() {
	    	// Animation complete.
	    });
    });
    
    //Message box close button
    $('.boxCloseBtn').click(function(){
    	$(this).fadeOut(400).parent().fadeOut(400);
    });
    
    //Nivo Slider init 
    $('#slider').nivoSlider({
        effect: 'random', // Specify sets like: 'fold,fade,sliceDown'
        slices: 15, // For slice animations
        boxCols: 8, // For box animations
        boxRows: 4, // For box animations
        animSpeed: 500, // Slide transition speed
        pauseTime: 6000, // How long each slide will show
        startSlide: 0, // Set starting Slide (0 index)
        directionNav: true, // Next & Prev navigation
        directionNavHide: false, // Only show on hover
        controlNav: true, // 1,2,3... navigation
        controlNavThumbs: false, // Use thumbnails for Control Nav
        controlNavThumbsFromRel: false, // Use image rel for thumbs
        controlNavThumbsSearch: '.jpg', // Replace this with...
        controlNavThumbsReplace: '_thumb.jpg', // ...this in thumb Image src
        keyboardNav: true, // Use left & right arrows
        pauseOnHover: true, // Stop animation while hovering
        manualAdvance: false, // Force manual transitions
        captionOpacity: 0.8, // Universal caption opacity
        prevText: '', // Prev directionNav text
        nextText: '', // Next directionNav text
        randomStart: false // Start on a random slide
    });
    
    //Flex Slider init
    $('.flexslider').flexslider({
         animation: "slide",              //String: Select your animation type, "fade" or "slide"
         slideDirection: "horizontal",   //String: Select the sliding direction, "horizontal" or "vertical"
         slideshow: true,                //Boolean: Animate slider automatically
         slideshowSpeed: 7000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
         animationDuration: 600,         //Integer: Set the speed of animations, in milliseconds
         directionNav: true,             //Boolean: Create navigation for previous/next navigation? (true/false)
         controlNav: true,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
         keyboardNav: true,              //Boolean: Allow slider navigating via keyboard left/right keys
         mousewheel: false,              //Boolean: Allow slider navigating via mousewheel
         prevText: "Previous",           //String: Set the text for the "previous" directionNav item
         nextText: "Next",               //String: Set the text for the "next" directionNav item
         pausePlay: false,               //Boolean: Create pause/play dynamic element
         pauseText: 'Pause',             //String: Set the text for the "pause" pausePlay item
         playText: 'Play',               //String: Set the text for the "play" pausePlay item
         randomize: false,               //Boolean: Randomize slide order
         slideToStart: 0,                //Integer: The slide that the slider should start on. Array notation (0 = first slide)
         animationLoop: true,            //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
         pauseOnAction: true,            //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
         pauseOnHover: false,            //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
         controlsContainer: ".flexsliderContainer",          //Selector: Declare which container the navigation elements should be appended too. Default container is the flexSlider element. Example use would be ".flexslider-container", "#container", etc. If the given element is not found, the default action will be taken.
         manualControls: "",             //Selector: Declare custom control navigation. Example would be ".flex-control-nav li" or "#tabs-nav li img", etc. The number of elements in your controlNav should match the number of slides/tabs.
         start: function(){},            //Callback: function(slider) - Fires when the slider loads the first slide
         before: function(){},           //Callback: function(slider) - Fires asynchronously with each slider animation
         after: function(){},            //Callback: function(slider) - Fires after each slider animation completes
         end: function(){}               //Callback: function(slider) - Fires when the slider reaches the last slide (asynchronous)
    });
    
    //Kwicks init
    $('.kwicks').kwicks({
    	max: 700,					//The width or height (in pixels) of a fully expanded kwick element. If isVertical is true, then max refers to the height - otherwise it is the width.
    	min: 'auto',				//The width or height (in pixels) of a fully collapsed kwick element. If isVertical is true, then min refers to the height - otherwise it is the width.
    	isVertical: false,			//Kwicks will align vertically if true.
    	sticky: false,				//One kwick will always be expanded if true.
    	defaultKwick: 0,			//The initially expanded kwick (if and only if sticky is true). Note: Zero based, left-to-right (or top-to-bottom).
    	event: 'mouseover',			//The event that triggers the expand effect. Other likely candidates are click and dblclick.
    	duration: 500,				//The number of milliseconds required for each animation to complete.
    	easing: 'easeInOutQuint',		//A custom easing function for the animation (requires easing plugin).
    	spacing: 0					//The width (in pixels) separating each kwick element.
    });
    
    //PrettyPhoto init
	$("a[data-rel^='prettyPhoto']").prettyPhoto({
		animation_speed: 'fast', /* fast/slow/normal */
		slideshow: 5000, /* false OR interval time in ms */
		autoplay_slideshow: false, /* true/false */
		opacity: 0.80, /* Value between 0 and 1 */
		show_title: true, /* true/false */
		allow_resize: true, /* Resize the photos bigger than viewport. true/false */
		default_width: 500,
		default_height: 344,
		counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
		theme: 'dark_rounded', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
		horizontal_padding: 20, /* The padding on each side of the picture */
		hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
		wmode: 'opaque', /* Set the flash wmode attribute */
		autoplay: true, /* Automatically start videos: True/False */
		modal: false, /* If set to true, only the close button will close the window */
		deeplinking: true, /* Allow prettyPhoto to update the url to enable deeplinking. */
		overlay_gallery: true, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
		keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
		changepicturecallback: function(){}, /* Called everytime an item is shown/changed */
		callback: function(){}, /* Called when prettyPhoto is closed */
		ie6_fallback: true
	});
	
    //Create overlay for every image link
/*    var currentColor = "aa1c1c"
    $('#main').find('a img').parent().css('display', 'inline-block').append("<span class='imgOverlayEnlarge'></span>").find('.imgOverlayEnlarge').fadeOut(0).parent().hover(
      function () {
      	if ($(this).attr('data-rel')) {
      		$(this).find('.imgOverlayEnlarge').css('background-image', 'url("'+base_url+'images/img-overlay-enlarge.jpg")').css('width', $(this).find('>img').width() + 'px').css('height', $(this).find('>img').height() + 'px').stop().fadeTo(300, 0.7);
      		$(this).find('>img').css('border', '1px solid #' + currentColor).css('background-color', '#' + currentColor);
      	} else {
      		$(this).find('.imgOverlayEnlarge').css('background-image', 'url("'+base_url+'images/img-overlay-link.jpg")').css('width', $(this).find('>img').width() + 'px').css('height', $(this).find('>img').height() + 'px').stop().fadeTo(300, 0.7);
      		$(this).find('>img').css('border', '1px solid #' + currentColor).css('background-color', '#' + currentColor);
      	}
      }, 
      function () {
        $(this).find('>img').css('border', '1px solid #a1a1a1').css('background-color', '#ddd');
        $(this).find('.imgOverlayEnlarge').stop().fadeTo(300, 0);
      }
    );*/
    
    //Slides init
    $("#slides").slides({
    	preload: true,							//Set true to preload images in an image based slideshow.
    	preloadImage: base_url+'images/slider/loading.gif',//Name and location of loading image for preloader.
    	container: 'slides_container',			//Class name for slides container.
    	generateNextPrev: true,					//Auto generate next/prev buttons.
    	next: 'next',							//Class name for next button.
    	prev: 'prev',							//Class name for previous button.
    	pagination: false,						//If you're not using pagination you can set to false, but don't have to.
    	generatePagination: false,				//Auto generate pagination.
    	paginationClass: 'pagination',			//Class name for pagination.
    	currentClass: 'current',				//Class name for current pagination item.
    	fadeSpeed: 350,							//Set the speed of the fading animation in milliseconds.
    	fadeEasing: "easeOutQuad",				//Set the easing of the fade animation.
    	slideSpeed: 1000,						//Set the speed of the sliding animation in milliseconds.
    	slideEasing: "easeInOutQuint",				//Set the easing of the sliding animation.
    	start: 1,								//Set which slide you'd like to start with.
    	effect: 'slide',						//Set effect, slide or fade for next/prev and pagination. If you use just one effect name it'll be applied to both or you can state two effect names. The first name will be for next/prev and the second will be for pagination. Must be separated by a comma.
    	crossfade: true,						//Crossfade images in a image based slideshow.
    	randomize: true,						//Set to true to randomize slides.
    	play: 5000,								//Autoplay slideshow, a positive number will set to true and be the time between slide animation in milliseconds.
    	pause: 2500,							//Pause slideshow on click of next/prev or pagination. A positive number will set to true and be the time of pause in milliseconds.
    	hoverPause: true,						//Set to true and hovering over slideshow will pause it.
    	autoHeight: true,						//Set to true to auto adjust height.
    	autoHeightSpeed: 350,					//Set auto height animation time in milliseconds.
    	bigTarget: true,						//Set to true and the whole slide will link to next slide on click.
    	animationStart: function() {			//Function called at the start of animation.
    		// Do something awesome!
    	},
    	animationComplete: function() {			//Function called at the completion of animation
    		// Do something awesome!
    	}
    });
    
    //Quovolver init					speed duration
    $("#quoteWrap blockquote").quovolver(500, 6000);
    
    //Sidebar Tag list sizes 
    $('.tags li a').each(function(index) {
        $(this).css('font-size', Math.round(10 + ((30 - 10)*(Math.random() % 1))) + 'px');
    });
    
    //Sidebar Flickr Gadget
    $.getJSON("http://api.flickr.com/services/feeds/groups_pool.gne?id=685365@N25&lang=en-us&format=json&jsoncallback=?",
      function(data) {
        $.each(data.items, function(i,item){
          $("<a><img/></a>").attr("href", item.link).attr('target', '_blank').find('img').attr("src", item.media.m).parent().appendTo(".flickrWidget");
          if ( i == 8 ) return false;
        });
      });
      
      //Comment go to comment form animation
      $('.commentsHeader a, .replyBtn').click(function(){
          $.scrollTo('#commentForm', 400);
           
          return false;
      });
      
      if ($.browser.msie && ($.browser.version == 7.0 || 8.0)){
        $("#main .twoColumn .portfolioItem:nth-child(odd)").css("margin-right", "26px");
        $("#main .threeColumn .portfolioItem:nth-child(3n+3)").css("margin-right", "0");
        $("#main .fourColumn .portfolioItem:nth-child(4n+4)").css("margin-right", "0");
      }
      //Quicksand (portfolio filter sorting) init
      // Custom sorting plugin
      (function($) {
        $.fn.sorted = function(customOptions) {
          var options = {
            reversed: false,
            by: function(a) { return a.text(); }
          };
          $.extend(options, customOptions);
          $data = $(this);
          arr = $data.get();
          arr.sort(function(a, b) {
            var valA = options.by($(a));
            var valB = options.by($(b));
            if (options.reversed) {
              return (valA < valB) ? 1 : (valA > valB) ? -1 : 0;				
            } else {		
              return (valA < valB) ? -1 : (valA > valB) ? 1 : 0;	
            }
          });
          return $(arr);
        };
      })(jQuery);
      
      // DOMContentLoaded
      $(function() {
      
        // bind radiobuttons in the form
        var $filterType = $('#portfolioFilter ul li a');
      
        // get the first collection
        var $applications = $('#portfolioItems');
      
        // clone applications to get a second collection
        var $data = $applications.clone();
      
        // attempt to call Quicksand on every form change
        $filterType.click(function(e) {
          e.preventDefault();
          $('#portfolioFilter ul li a').removeClass('activeFilter');
          $(this).addClass('activeFilter');
          if ($(this).attr('data-value') == 'all') {
            var $filteredData = $data.find('.portfolioItem');
          } else {
            var $filteredData = $data.find('.portfolioItem[data-type~=' + $(this).attr('data-value') + ']');
          }
      
          // if sorted by size
          if ($('#filter input[name="sort"]:checked').val() == "size") {
            var $sortedData = $filteredData.sorted({
              by: function(v) {
                return parseFloat($(v).find('span[data-type=size]').text());
              }
            });
          } else {
            // if sorted by name
            var $sortedData = $filteredData.sorted({
              by: function(v) {
                return $(v).find('strong').text().toLowerCase();
              }
            });
          }   
      
          // finally, call quicksand
          $applications.quicksand($sortedData, {
            duration: 800,
            easing: 'easeInOutQuad'
          }, function() {
	          if ($.browser.msie && ($.browser.version == 7.0 || 8.0)){
	            $("#main .twoColumn .portfolioItem:nth-child(odd)").animate({"margin-right": "26px"}, "fast");
	            $("#main .twoColumn .portfolioItem:nth-child(even)").animate({"margin-right": "0"}, "fast");
	            
	            $("#main .threeColumn .portfolioItem").animate({"margin-right": "26px"}, "fast");
	            $("#main .threeColumn .portfolioItem:nth-child(3n+3)").animate({"margin-right": "0"}, "fast");
	            
	            $("#main .fourColumn .portfolioItem").animate({"margin-right": "25px"}, "fast");
	            $("#main .fourColumn .portfolioItem:nth-child(4n+4)").animate({"margin-right": "0"}, "fast");
	          }
          
	          //Create overlay for every image link
/*	          $('#main').find('a img').parent().css('display', 'inline-block').find('.imgOverlayEnlarge').fadeOut(0).parent().hover(
	            function () {
	            	if ($(this).find('img').attr('data-rel')) {
	            		$(this).find('.imgOverlayEnlarge').css('background-image', 'url("'+base_url+'images/img-overlay-enlarge.jpg")').css('width', $(this).find('>img').width() + 'px').css('height', $(this).find('>img').height() + 'px').stop().fadeTo(300, 0.7);
	            		$(this).find('>img').css('border', '1px solid #' + currentColor).css('background-color', '#' + currentColor);
	            	} else {
	            		$(this).find('.imgOverlayEnlarge').css('background-image', 'url("'+base_url+'images/img-overlay-link.jpg")').css('width', $(this).find('>img').width() + 'px').css('height', $(this).find('>img').height() + 'px').stop().fadeTo(300, 0.7);
	            		$(this).find('>img').css('border', '1px solid #' + currentColor).css('background-color', '#' + currentColor);
	            	}
	            }, 
	            function () {
	              $(this).find('>img').css('border', '1px solid #a1a1a1').css('background-color', '#ddd');
	              $(this).find('.imgOverlayEnlarge').stop().fadeTo(300, 0);
	            }
	          );*/
          });
        });
      });
      
      $('#contactForm').submit(function() {
      	var validates = 0;
      	
  		$('.validationText').fadeOut(50);
      		
      	//Fade in loading gif
		$('.loadingImg').fadeIn(1000, function() {
			//Fade out loading gif
			$('.loadingImg').fadeOut(300);
			
			//Check if required forms are filled out
			$('#contactForm input[data-required="true"], #contactForm textarea[data-required="true"]').each(function(index) {
				if( !$(this).val() ) {
					$('.validationText').fadeIn(300).text('You forgot one or more required fields!').css('color', '#aa1c1c');
				    $(this).addClass('fieldEmpty');
				    validates ++;
				}
				else {
				    $(this).removeClass('fieldEmpty');
				}
			});
			if (validates == 0) {
				// submit the form 
				$('#contactForm').ajaxSubmit(function() {
					$('.validationText').fadeIn(300).text('Thank you for your message!').css('color', '#1E911A');
				});
			}
		});
		
		// return false to prevent normal browser submit and page navigation 
		return false; 
      });
      
      //Settings widget show/hide
      $('#settingsWidget #settingsToggle').click(function(){
      	$(this).toggleClass('opened');
      	if ($(this).attr('class') == "opened") {
      		$(this).css('background-position', 'right');
	      	$(this).parent().animate({
	      	    left: '0'
	      	  }, 250, 'easeInOutCirc', function() {
	      	    // Animation complete.
	      	  });
      	}
      	else {
      		$(this).css('background-position', 'left');
      		$(this).parent().animate({
      		    left: '-131px'
      		  }, 150, function() {
      		    // Animation complete.
      		  });
      	}
      });
      
      //Settings widget color selectors
      $('.colorSelector.generalColor').ColorPicker({
      	color: '#aa1c1c',
      	onShow: function (colpkr) {
      		$(colpkr).fadeIn(500);
      		return false;
      	},
      	onHide: function (colpkr) {
      		$(colpkr).fadeOut(500);
      		return false;
      	},
      	onChange: function (hsb, hex, rgb) {
      		$('.colorSelector.generalColor').css('backgroundColor', '#' + hex);
      		$('#headerTop').css('border-color', '#' + hex);
      		$('#main p > a, #main .column > a, #main .meta a, .newsPreview > a , .categoriesList a, .archivesList a, .navigationList a').css('color', '#' + hex);
      		currentColor = hex;
      	}
      });
      
      $('.colorSelector.sliderColor').ColorPicker({
      	color: '#585858',
      	onShow: function (colpkr) {
      		$(colpkr).fadeIn(500);
      		return false;
      	},
      	onHide: function (colpkr) {
      		$(colpkr).fadeOut(500);
      		return false;
      	},
      	onChange: function (hsb, hex, rgb) {
      		$('.colorSelector.sliderColor').css('backgroundColor', '#' + hex);
      		$('#sliderContainerBg').css('backgroundColor', '#' + hex);
      	}
      });
      
      $('.colorSelector.footerColor').ColorPicker({
      	color: '#585858',
      	onShow: function (colpkr) {
      		$(colpkr).fadeIn(500);
      		return false;
      	},
      	onHide: function (colpkr) {
      		$(colpkr).fadeOut(500);
      		return false;
      	},
      	onChange: function (hsb, hex, rgb) {
      		$('.colorSelector.footerColor').css('backgroundColor', '#' + hex);
      		$('footer').css('backgroundColor', '#' + hex);
      	}
      });
      
      //Settings background selector
      $('#settingsWidget .backgroundSelector img').click(function(){
      	$('#settingsWidget .backgroundSelector img').removeClass('currentBg');
      	$(this).addClass('currentBg');
      	$('body').css('backgroundImage', 'url('+ $(this).attr("src") +')')
      	$('#main .pageLink h3 a').css('backgroundImage', 'url('+ $(this).attr("src") +')')
      	$('#main .pageLink .linkBtn').css('backgroundImage', 'url('+ $(this).attr("src") +')')
      });
      
      //Google Web Fonts selection
      $('#settingsWidget .settingsDropdown').click(function(e){
      	e.stopPropagation();
      	$(this).find('ul').slideToggle(100).css('z-index', '999');
      });
      
      $('#settingsWidget .settingsDropdown.headings ul li').click(function(){
      
      	//Set current class to clicked element
      	$(this).parents('.settingsDropdown').find('ul li').removeClass('current');
      	$(this).addClass('current');
      	
      	//Set font to selected elements
      	$('h1, h2, h3, h4, h5, h6, .callout').css('font-family', $(this).css('font-family'));
      	
      	//Change current font text
      	$(this).parents('.settingsDropdown').find('span').text($(this).text()).css('font-family', $(this).css('font-family'));
      });
      
      $('#settingsWidget .settingsDropdown.body ul li').click(function(){
      
      	//Set current class to clicked element
      	$(this).parents('.settingsDropdown').find('ul li').removeClass('current');
      	$(this).addClass('current');
      	
      	//Set font to selected elements
      	$('body').css('font-family', $(this).css('font-family'));
      	
      	//Change current font text
      	$(this).parents('.settingsDropdown').find('span').text($(this).text()).css('font-family', $(this).css('font-family'));
      });
      
      $('body').click(function(){
      	$(this).find('#settingsWidget .settingsDropdown ul').slideUp(100)
      });
});

//SELECTED TAB IN SESSION
