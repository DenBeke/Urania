/*
Script for the lightbox in the admin album

Author: Mathias Beke
Url: http://denbeke.be
Date: March 2014
*/

$(document).ready(function() {
    
    
    
    /* Menu *
    ********/
    
    $('.nav-toggle').click(function(e) {
	   
	    if($('#nav-bar').hasClass('open')) {
			$('#nav-bar').hide();
			$('#nav-bar').removeClass('open');
	    }
	    else {
			$('#nav-bar').fadeIn();
			$('#nav-bar').addClass('open');  
	    }
	   
	    
    });
    
    
    
    /* Lightbox *
    ************/   
    
    //Open lightbox
	$("a.lightbox").click(function(e){
	    
		 
		//Get the id of the image
		var url = $(this).attr('href');
		
			
		$('#lightbox-content img').attr('src', url);

		
		
		//Do action when image is loaded
		$('#lightbox-content img').load(function() {
			
			$('#lightbox-overlay .loading').removeClass('active');
			$('#lightbox-content img').fadeIn();
			
			
		});

		
		
		
		$('#lightbox-overlay').fadeIn();
		$('#lightbox-overlay').css('display', 'table');
		$('#lightbox-overlay').removeClass('hidden');
		
		
		//stop refreshing to the page given in
		return false;
		    
		
	  });
	
	
	
	
	
	//Close lightbox
	$('#lightbox-overlay').click(function(e) {
	    //Hide overlay and place loader images back
	    $('#lightbox-overlay').fadeOut(0);
	    $('#lightbox-overlay img').attr("src", '');
	    $('#lightbox-overlay #lightbox-content').addClass('loader');

	    
	}
	);
	
	
	
	//Prevent lightbox from closing
	$(function() {
		$("#lightbox-content").on("click", function(e) {
			e.stopPropagation();
		});
	});
	
	
	
	
	
	
	
	/* Edit Box *
	************/
	
	
	//Open the edit box on click
	$('.edit-button').click(function(e) {	
		
		$(this).next('.edit-box').fadeIn();
		$(this).addClass('open');
		$('body').addClass('edit-box-open');
		
		e.stopPropagation();
	
	});
	
	//Close the box when clicking outside it
	$('body').click(function() {
		
		$('.edit-box').hide();
		
	});

	
	//Prevent edit box from closing
	$(function() {
		$(".edit-box").on("click", function(e) {
			e.stopPropagation();
		});
	});
	
	

});

    


