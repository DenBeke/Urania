<div class="page" id="album">



<?php 

$imageHeight = 240;
$imageWidth = 240;

try {
	$album = $u->getAlbum($id);
	$albumName = $album->getName();
	
	echo "<h1>$albumName</h1>";
	
	echo '<ul>';
	
	//Loop through all the images of the album
	for ($i = 0; $i < $album->getNumberOfImages(); $i++) {
		?>
		
		<li>
			<a href="<?php echo $u->getSiteUrl() . $album->getImage($i)->getFileName() ?>" class="lightbox" title="<?php echo $album->getImage($i)->getName(); ?>">
				<img src="<?php echo $u->getSiteUrl(); ?>core/timthumb.php?src=<?php echo $album->getImage($i)->getFileName() . "&amp;h=$imageHeight&amp;w=$imageWidth"; ?>" alt="<?php echo $album->getImage($i)->getName(); ?>" title="<?php echo $album->getImage($i)->getName(); ?>" />
			</a>
		</li>
		
		<?php
	}
	
	
	echo "</ul>";
	
	
}
catch (exception $exception) {
	?>
	<h2>Sorry, but this photo album doesn't exist</h2>
	<?php
}

 

?>

</div>