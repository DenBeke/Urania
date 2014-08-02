<?php
/*
Theme part for single image page

Author: Mathias Beke
Url: http://denbeke.be
Date: March 2013
*/
?>

<div id="image-photo">
	<a href="<?php echo SITE_URL . $this->image->getFileName(); ?>">
		<img src="<?php echo SITE_URL . $this->image->getFileName(); ?>" alt="<?php echo $this->image->getName(); ?>" />
	</a>
</div><!-- #image-photo -->


<div class="page" id="image">

	
	<div id="image-info">
	
	    <h1><?php echo $this->image->getName(); ?></h1>
	    <p><?php echo date('d-m-Y', $this->image->getDate()); ?></p>
	
		<!-- Exif info of image -->
	    <?php Theme::exif($this->image); ?>
	    
	    
	    <!-- GeoLocation of image -->
	    <?php 
	    if($this->image->getGpsLatitude() != NULL and $this->image->getGpsLongitude() != NULL) {
	    ?>
	    
	    <div id="map" style="height: 300px;">
	    </div>
	    
	    <script type="text/javascript">
	    	createMap('map', <?php echo $this->image->getGpsLatitude(); ?>, <?php echo $this->image->getGpsLongitude(); ?>);
	    </script>
	    
	    
	    <?php } //endif ?>
	    
	    
	</div><!-- #image-info -->
	
	
	
	
	


</div><!-- #image -->