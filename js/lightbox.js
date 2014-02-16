/*
Simple Lightbox for Urania Image Gallery

Author: Mathias Beke
Url: http://denbeke.be
Date: September 2013
*/



$(document).ready(function() {
    
    
    //Lightbox url changing found on http://www.tinywall.info/2012/02/22/change-browser-url-without-page-reload-refresh-with-ajax-request-using-javascript-html5-history-api-php-jquery-like-facebook-github-navigation-menu/
    //Many thanks to the poster!
    
    // the below code is to override back button to get the ajax content without page reload
    $(window).bind('popstate', function() {
      //$.ajax({url:location.pathname+'?rel=tab',success: function(data){
          closeLightbox(); 
      //}});
    });
    
    
    
    //Open lightbox
	$("a.lightbox").click(function(e){
	    
	    //Check if the screen is large enough to display the lightbox, else go directly to the image
	    var windowHeight = $(window).height();
	    var windowWidth = $(window).width();
	    
	    if(windowHeight > 620 && windowWidth > 820 || true) {
	    
		    //e.preventDefault();
		    /*
		    if uncomment the above line, html5 nonsupported browers won't change the url but will display the ajax content;
		    if commented, html5 nonsupported browers will reload the page to the specified link.
		    */
		 
		 
		 	//Get the id of the image
		 	var jsonUrl = $(this).attr('data-json');
		 	
		 	//Retrieve JSON object and load data	
		 	$.getJSON(jsonUrl, function(data) {
		 		
		 		$('#lightboxContent h1').text(data['name']);
				$('#lightboxContent .date').text(data['date']);
				$('#lightboxContent #photo').attr('src', data['fileName']);
				
				
				//Check for exif data, and load the data if needed.
				
				
				//Do action when image is loaded
				$('#lightboxContent #photo').load(function() {
					
					$('#lightboxContent #photo').fadeIn();
					
				});
				
				
				//Display geo location on map
				if(data['longitude'] != null && data['latitude'] != null) {
					createMap('lightboxMap', data['latitude'], data['longitude']);
				}
				
				//Display other exif information
				if(data['camera'] != null) {
					$('#lightboxContent .exif').append('<li>' + data['camera'] + '</li>');
				}
				
				if(data['iso'] != null) {
					$('#lightboxContent .exif').append('<li>ISO ' + data['iso'] + '</li>');
				}
				
				if(data['focallength'] != null) {
					$('#lightboxContent .exif').append('<li>' + data['focallength'] + '</li>');
				}
				
				if(data['aperture'] != null) {
					$('#lightboxContent .exif').append('<li>ƒ/' + data['aperture'] + '</li>');
				}
				
				if(data['shutterSpeed'] != null) {
					$('#lightboxContent .exif').append('<li>' + data['shutterSpeed'] + '"</li>');
				}

				
		 	});
		 	
		 	
		 	
		 			 	
		 
		 
		    //get the link location that was clicked
		    var pageUrl = $(this).attr('href');
		 
		    //to change the browser URL to the given link location
		    if(pageUrl != window.location){
		        window.history.pushState({path:pageUrl},'',pageUrl);
		    }
		    
		    
		    $('#overlay').fadeIn();
		    $('#overlay').css('display', 'table-cell');
		  
		    
		    //stop refreshing to the page given in
		    return false;
		    
		    }
	  });
	
	
	
	$('#overlay').click(function(e) {
	
		closeLightbox();
		destroyMap('lightboxMap');
	}
	);
	
	
	
	//Close lightbox
	function closeLightbox() {
	    //Hide overlay and place loader images back
	    $('#overlay').fadeOut(0);	
	    $('#overlay img#photo').fadeOut(0);
	    $('#overlay img#photo').attr("src", '../../img/ajax-loader.gif');
	    $('#overlay #lightboxImage').addClass('loader');
	    $('#overlay #lightboxImage.loader').css('margin-top', -16);
	    
	    
	    //Clean content of exif...
	    $('#lightboxContent .exif').empty();
	    
	    
	    //Re enable body scrolling
	    $('body').css('overflow', 'auto');
	}
	

});

    


