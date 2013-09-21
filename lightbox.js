/**
Toggle a lightbox

@param source of image to be displayed
@param url for larger image
*/


       
$(document).ready(function() {
    
	$("a.lightbox").click(function(e){
	    
	    //Check if the screen is large enough to display the lightbox, else go directly to the image
	    var windowHeight = $(window).height();
	    var windowWidth = $(window).width();
	    
	    if(windowHeight > 620 && windowWidth > 820) {
	    
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
		      //window.history.pushState({path:pageurl},'',pageurl);
		    }
		    
		    
		    
		    $('#overlay').fadeIn();
		    $('#overlay').css('display', 'table-cell');
		    
		    $('#overlay img#image').attr("src", pageurl);
		    
		    
		    
		    
		    
		    //stop refreshing to the page given in
		    return false;
		    
		    
		    //TODO image loader or other stuff
		    //TODO sometime last images appears when clicken other
		    //TODO close button
		  }
	  });
	  
	  
	$('#overlay').click(function() {
		$('#overlay').fadeOut(0);	
		$('#overlay img#image').fadeOut(0);
		$('#overlay #lightboxImage').addClass('loader');
		$('#overlay #lightboxImage.loader').css('margin-top', -16);
	}
	);
	
	$('#lightboxImage img').load(function(){
	    if($(this).height() > 100) {
	        //Margin image div     
	        //$('#overlay img#ajax').fadeOut(0);
	        
	        $('#overlay #lightboxImage').removeClass('loader');
	        
	        
	        var height;
	        var totalHeight = $(window).height();
	        
	        height = 610;
	        height = $('#lightboxImage img#image').outerHeight() + 10;
	        
	        $('#overlay #lightboxImage').css('margin-top', (totalHeight-height)/2);
	        
	        $('#overlay img#image').fadeIn();
	    }
	});

});
    
    
    


