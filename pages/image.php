<div class="page" id="image">

<?php 


try {
	
	$image = new ImageExif($u->getImage($id));
	$image->readExifFromFile();
	
	?>
	
	<div id="imageInfo">
	
	    <h1><?php echo $image->getName(); ?></h1>
	    <p><?php echo date('d-m-Y', $image->getDate()); ?></p>
	
	    <!-- TODO efix data -->
	    <div id="exif">
	    	<ul>
	    		<?php 
	    		if($image->getCamera() != NULL) {
	    		?>
	    		<li>
	    			<?php echo $image->getCamera(); ?>
	    		</li>
	    		<?php 
	    		}
	    		
	    		if($image->getIso() != NULL) {
	    		?>
	    		<li>
	    			<?php echo $image->getIso(); ?>
	    		</li>
	    		
	    		<?php 
	    		}
	    		
	    		if($image->getAperture() != NULL) {
	    		?>
	    		<li>
	    			&fnof;/<?php echo $image->getAperture(); ?>
	    		</li>
	    		<?php
	    		}
	    		
	    		if($image->getShutterSpeed() != NULL) {
	    		?>
	    		<li>
	    			<?php echo $image->getShutterSpeed(); ?>"
	    		</li>
	    		
	    		<?php 
	    		}
	    		
	    		if($image->getFocalLength() != NULL) {
	    		?>
	    		<li>
	    			<?php echo $image->getFocalLength(); ?>
	    		</li>
	    		<?php } ?>
	    	</ul>
	    </div>
	    
	    
	    <?php 
	    if($image->getGpsLatitude() != NULL and $image->getGpsLongitude() != NULL) {
	    ?>
	    
	    <div id="map" style="height: 300px;"></div>
	    
	    <script type="text/javascript">
	    	createMap('map', <?php echo $image->getGpsLatitude(); ?>, <?php echo $image->getGpsLongitude(); ?>);
	    </script>
	    
	    <?php } ?>
	    
	    
	</div>
	
	
	<div id="imagePhoto">
        <a href="<?php echo $u->getSiteUrl() . $image->getFileName(); ?>">
	        <img src="<?php echo $u->getSiteUrl() . $image->getFileName(); ?>" alt="<?php echo $image->getName(); ?>" />
	    </a>
	</div>
	
	
	<?php
	
}
catch (exception $exception) {
	?>
	<h2 class="error">Sorry, but this photo doesn't exist</h2>
	<?php
}

 

?>


</div>