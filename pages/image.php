<div class="page" id="image">

<?php 


try {
	
	$image = $u->getImage($id);
	
	?>
	
	<div id="imageInfo">
	
	    <h1><?php echo $image->getName(); ?></h1>
	    <p><?php echo date('d-m-Y', $image->getDate()); ?></p>
	
	    <!-- TODO efix data -->
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