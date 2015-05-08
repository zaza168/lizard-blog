$(document).ready( function() {
    $('#menu').menu({
        'scrollSpeed' : 1
	    });
	});
	(function(){

	
	$.fn.menu = function( options ) {

		// adding a class to users div
		$(this).addClass('menu')

		var settings = $.extend({
            'scrollSpeed '  : 500
            }, options);


		return $('#menu a').each( function() {

            
			if ( settings.scrollSpeed ) {

				var scrollSpeed = settings.scrollSpeed

			}


			///////////////////////////////////

			// get initial top offset for the menu 
			var stickyTop = $('#menu').offset().top;	

			// check position and make sticky if needed
			var stickyMenu = function(){
				
				// current distance top
				var scrollTop = $(window).scrollTop(); 
							
				// if we scroll more than the navigation, change its position to fixed and add class 'fxd', otherwise change it back to absolute and remove the class
				if (scrollTop > stickyTop) { 
					$('#menu').css({ 'position': 'fixed' , 'top':0 }).addClass('fxd');

					} else {
						$('#menu').css({ 'position': 'absolute', 'top':stickyTop }).removeClass('fxd'); 
					}   
			};
					
			// run function
			stickyMenu();
					
			// run function every time you scroll
			$(window).scroll(function() {
				 stickyMenu();
			});

			///////////////////////////////////////
    
        
        	$(this).on('click', function(e){


				// gets the height of the users div. This is used for off-setting the scroll so th emenu doesnt overlap any content in the div they jst scrolled to
				var selectorHeight = $('#menu').height();   

        		// stops empty hrefs making the page jump when clicked
				e.preventDefault();

				// get id pf the button you just clicked
		 		var id = $(this).attr('id');
				
				// gets the distance from top of the div class that matches your button id minus the height of the nav menu. This means the nav wont initially overlap the content.
				var goTo =  $('div.'+ id).offset().top -selectorHeight;
				
				// Scroll the page to the desired position!
				$("html, body").animate({ scrollTop: goTo }, scrollSpeed);

			});	

            

		});

	}

})();
