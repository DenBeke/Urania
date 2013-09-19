<div class="page" id="album">



<?php 

$imageHeight = 250;
$imageWidth = 250;

try {
	$album = $u->getAlbum($id);
	$albumName = $album->getName();
	
	echo '<ul>';
	echo "<h1>$albumName</h1>";
	
	//Loop through all the images of the album
	for ($i = 0; $i < $album->getNumberOfImages(); $i++) {
		?>
		
		<li>
			<a href="<?php echo $album->getImage($i)->getFileName() ?>">
				<img src="./core/timthumb.php?src=<?php echo $album->getImage($i)->getFileName() . "&h=$imageHeight&w=$imageWidth"; ?>" alt="<?php echo $album->getImage($i)->getName(); ?>" />
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