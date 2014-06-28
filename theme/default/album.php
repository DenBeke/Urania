<?php
/*
Theme part for page with album

Author: Mathias Beke
Url: http://denbeke.be
Date: March 2013
*/
?>


<div class="page" id="album">


<?php 

$imageHeight = 270;
$imageWidth = 270;

try {
	$albumName = $this->album->getName();
	$description = $this->album->getDescription();
	
	echo "<h1>$albumName</h1>";
	
	echo "<div class=\"album-description\">$description</div>";
	
	echo '<ul>';
	
	//Loop through all the images of the album
	for ($i = 0; $i < $this->album->getNumberOfImages(); $i++) {
		?>
		
		<li>
			<a href="<?php echo SITE_URL . 'image/' . $this->album->getImage($i)->getId() . '/' . $this->urania->simplifyFileName($this->album->getImage($i)->getName()); ?>" class="lightbox" title="<?php echo $this->album->getImage($i)->getName(); ?>" data-json="<?php echo SITE_URL . 'ajax/image.php?image=' . $this->album->getImage($i)->getId(); ?>">
			
				<img src="<?php echo SITE_URL; ?>core/timthumb.php?src=<?php echo $this->album->getImage($i)->getFileName() . "&amp;h=$imageHeight&amp;w=$imageWidth"; ?>" alt="<?php echo $this->album->getImage($i)->getName(); ?>" title="<?php echo $this->album->getImage($i)->getName(); ?>" />
				
			</a>
		</li>
		
		<?php
	}
	
	
	echo "</ul>";
	
	
}
catch (exception $exception) {
	?>
	<h2 class="error">Sorry, but this photo album doesn't exist</h2>
	<?php
}

 

?>

</div>