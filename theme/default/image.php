<?php
/*
Theme part for home page

Author: Mathias Beke
Url: http://denbeke.be
Date: March 2013
*/
?>


<div class="page" id="image">
	
	<div id="include">
	
	<div id="imageInfo">
	
	    <h1><?php echo $this->image->getName(); ?></h1>
	    <p><?php echo date('d-m-Y', $this->image->getDate()); ?></p>
	
	    <!-- TODO efix data -->
	    <div id="exif">
	    	<ul>
	    		<?php 
	    		if($this->image->getCamera() != NULL) {
	    		?>
	    		<li>
	    			<?php echo $this->image->getCamera(); ?>
	    		</li>
	    		<?php 
	    		}
	    		
	    		if($this->image->getIso() != NULL) {
	    		?>
	    		<li>
	    			ISO <?php echo $this->image->getIso(); ?>
	    		</li>
	    		
	    		<?php 
	    		}
	    		
	    		if($this->image->getAperture() != NULL) {
	    		?>
	    		<li>
	    			&fnof;/<?php echo $this->image->getAperture(); ?>
	    		</li>
	    		<?php
	    		}
	    		
	    		if($this->image->getShutterSpeed() != NULL) {
	    		?>
	    		<li>
	    			<?php echo $this->image->getShutterSpeed(); ?>"
	    		</li>
	    		
	    		<?php 
	    		}
	    		
	    		if($this->image->getFocalLength() != NULL) {
	    		?>
	    		<li>
	    			<?php echo $this->image->getFocalLength(); ?>
	    		</li>
	    		<?php } ?>
	    	</ul>
	    </div>
	    
	    
	    <?php 
	    if($this->image->getGpsLatitude() != NULL and $this->image->getGpsLongitude() != NULL) {
	    ?>
	    
	    <div id="map" style="height: 300px;">
	    </div>
	    
	    <script type="text/javascript">
	    	createMap('map', <?php echo $this->image->getGpsLatitude(); ?>, <?php echo $this->image->getGpsLongitude(); ?>);
	    </script>
	    
	    
	    <?php } ?>
	    
	    
	</div>
	
	
	<div id="imagePhoto">
        <a href="<?php echo SITE_URL . $this->image->getFileName(); ?>">
	        <img src="<?php echo SITE_URL . $this->image->getFileName(); ?>" alt="<?php echo $this->image->getName(); ?>" />
	    </a>
	</div>
	
	</div>
	


</div>