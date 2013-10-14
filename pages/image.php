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
	    		<li>
	    			<?php echo $image->getCamera(); ?>
	    		</li>
	    		
	    		<li>
	    			<?php echo $image->getIso(); ?>
	    		</li>
	    		
	    		<li>
	    			<?php echo $image->getAperture(); ?>
	    		</li>
	    		
	    		<li>
	    			<?php echo $image->getShutterSpeed(); ?>
	    		</li>
	    		
	    		<li>
	    			<?php echo $image->getFocalLength(); ?>
	    		</li>
	    	</ul>
	    </div>
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