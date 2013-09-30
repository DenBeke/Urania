<?php


if (isset($_POST['deleteImage'])) {
    try {	
	    $u->deleteImage(intval($_POST['deleteImage']));
	    echo '<h3 class="notice ok">Image successfully deleted</h3>';
	}
	catch (exception $exception) {
	    echo '<h3 class="notice error">Could not delete image</h3>';
	}

}
elseif (isset($_POST['albumId'])) {
    try {
    	for ($i = 0; $i <  count($_FILES['file']['name']); $i++) {
    		$u->uploadImage($_FILES['file']['name'][$i], $_FILES['file']['tmp_name'][$i], $_POST['albumId']);
    	}
    	echo '<h3 class="notice ok">Image(s) successfully uploaded</h3>';
    }
    catch (exception $exception) {
        echo '<h3 class="notice error">Could not upload image: ' . $exception->getMessage() . '</h3>';
    }
	
}
elseif (isset($_POST['changeName'])) {
	//Change the name of the image
	try {
	    $u->changeImageName(intval($_POST['changeImage']), stripslashes($_POST['changeName']));
	    echo '<h3 class="notice ok">Name of image successfully changed</h3>';
	}
	catch (exception $exception) {
	    echo '<h3 class="notice error">Could not change image name: ' . $exception->getMessage() . '</h3>';
	}
}


$albumId = intval($_GET['album']);
$album = $u->getAlbum($albumId);

?>

<h3 class="nav"><a href="<?php echo $u->getSiteUrl(); ?>index.php?page=admin">Albums</a> &gt; <a href="<?php echo $u->getSiteUrl(); ?>index.php?page=admin&album=<?php echo $album->getId(); ?>"><?php echo $album->getName(); ?></a></h3>

<table id="adminAlbum">

	<tbody>
	
	
		<tr>
		
			<th>
	
			</th>
			
			<th>
				Photo
			</th>
			
			<th>
				Date
			</th>
			
			<th>
			
			</th>
		
			<th>
			
			</th>
		
		</tr>
	
		<?php
		
		$imageHeight = 75;
		$imageWidth = 75;
		
		for ($i = 0; $i < $album->getNumberOfImages(); $i++) {
			
			?>
			
			<tr>
				<td>
					<img src="<?php echo $u->getSiteUrl(); ?>core/timthumb.php?src=<?php echo $album->getImage($i)->getFileName() . "&h=$imageHeight&w=$imageWidth"; ?>" alt="<?php echo $album->getImage($i)->getName(); ?>" />
				</td>
				<td>
					<?php echo $album->getImage($i)->getName(); ?>
				</td>
				
				<td class="date">
					<?php echo date('d-m-Y',$album->getImage($i)->getDate()); ?>
				</td>
				
				<td>
					<form method="post" action="<?php echo $u->getSiteUrl(); ?>index.php?page=admin&album=<?php echo $album->getId(); ?>">
						<input type="hidden" name="deleteImage" value="<?php echo $album->getImage($i)->getId(); ?>">
						<input type="submit" value="Delete">
					</form>
				</td>
				
				<td>
					<form method="post" action="<?php echo $u->getSiteUrl(); ?>index.php?page=admin&album=<?php echo $album->getId(); ?>">
						<input type="hidden" name="changeImage" value="<?php echo $album->getImage($i)->getId(); ?>">
						<input type="text" name="changeName" value="" required/>
						<input type="submit" value="Change name">
					</form>
				</td>
				
			</tr>
			
			<?php
			
		}
		
		?>
	
	
	</tbody>

</table>





<form id="uploadImages" enctype="multipart/form-data" name="upload" action="<?php echo $u->getSiteUrl(); ?>index.php?page=admin&album=<?php echo $albumId; ?>" method="post">
	<p>
		Upload Photos
	</p>
	<p>
		<input type="file" name="file[]" multiple required>

		<input type="hidden" name="albumId" value="<?php echo $albumId; ?>">
	</p>
	<p class="submitButton">
		<input type="submit" value="Upload">
	</p>
</form>
