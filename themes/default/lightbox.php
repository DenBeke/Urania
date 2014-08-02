<?php
/*
Theme part for lightbox

Author: Mathias Beke
Url: http://denbeke.be
Date: March 2013
*/
?>

<!--Lightbox elements-->
<div id="overlay" class="">
	<div id="lightboxContent">	
		
		
		<div id="lightboxWrapper">
		
			<div id="imageContainer">
			
				<img id="photo" src="" alt="" />
				
				<div class="loading active"></div>
				
			</div>
			
			
			<div id="meta">
				
				<h1></h1>
				
				<span class="date"></span>
				
				<ul class="exif">
				
				</ul>
				
				<!-- Div that will contain the geolocation map -->
				<div id="lightboxMap"></div>
				
				
				<a id="close-lightbox">X</a>
				
			</div>
			
		</div>
		
	</div>
</div>
