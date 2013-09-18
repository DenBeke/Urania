<h1>Album</h1>

<style>

img {
	max-width: 300px;
}

</style>

<?php 

try {
	$album = $u->getAlbum($id);
	
	//Loop through all the images of the album
	for ($i = 0; $i < $album->getNumberOfImages(); $i++) {
		?>
		
		<li>
			<a href="<?php echo $album->getImage($i)->getFileName() ?>">
				<img src="<?php echo $album->getImage($i)->getFileName() ?>" alt="<?php echo $album->getImage($i)->getName(); ?>" />
			</a>
		</li>
		
		<?php
	}
	
}
catch (exception $exception) {
	?>
	<h2>Sorry, but this photo album doesn't exist</h2>
	<?php
}

 

?>