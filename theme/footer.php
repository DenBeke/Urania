<?php
/*
Theme part for footer

Author: Mathias Beke
Url: http://denbeke.be
Date: March 2013
*/
?>

	<footer>
		<p>
			<?php echo COPYRIGHT; ?>
		</p>
	</footer>

	
	<!--Lightbox elements-->
	<div id="overlay">
		<div id="lightboxContent">	
			<h1></h1>
			
			<div id="lightboxWrapper">
			
				<div id="imageContainer">
				
					<img id="photo" src="" alt="" />
					
					<div class="loading active"></div>
					
				</div>
				
				
				<div id="meta">
					<span class="date"></span>
					
					<ul class="exif">
					
					</ul>
					
					<!-- Div that will contain the geolocation map -->
					<div id="lightboxMap"></div>
				</div>
				
			</div>
			
		</div>
	</div>
	
		
</body>
</html>