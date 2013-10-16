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
		 
		    //get the link location that was clicked
		    pageurl = $(this).attr('href');
		 
		    //to get the ajax content and display in div with id 'content'
		 
		    //to change the browser URL to the given link location
		    if(pageurl!=window.location){
		        window.history.pushState({path:pageurl},'',pageurl);
		    }
		    
		    
		    
		    $('#overlay').fadeIn();
		    $('#overlay').css('display', 'table-cell');
		    
		    //$('#overlay img#image').attr("src", pageurl);
		    //$( "#lightboxContent" ).load( pageurl + " #image #include" );
		    //$("#lightboxContent").load( pageurl + " #image script" );
		    
		    //$( '#lightboxContent' ).html( $( '<div id="include"></div>' ).html( data ).find( pageurl + " #image #include" ).clone() );
		    
		    $.get( pageurl, function ( data ) {
		        $( '#lightboxContent' ).html( $( '<div></div>' ).html( data ).find( '#include' ).clone() );
		    });
		    
		    
		    //Prevent body from scrolling
		    $('body').css('overflow', 'hidden');
		    
		    
		    
		    //stop refreshing to the page given in
		    return false;
		    
		    }
	  });
	
	
	
	
	$('#overlay').click(function() {
		closeLightbox();
	}
	);
	
	//Close lightbox
	function closeLightbox() {
	    //Hide overlay and place loader images back
	    $('#overlay').fadeOut(0);	
	    $('#overlay img#image').fadeOut(0);
	    $('#overlay img#image').attr("src", '');
	    $('#overlay #lightboxImage').addClass('loader');
	    $('#overlay #lightboxImage.loader').css('margin-top', -16);
	    
	    //Re enable body scrolling
	    $('body').css('overflow', 'auto');
	}
	

});

    


