<?php

if (isset($_POST['deleteImage'])) {
	$u->deleteImage(intval($_POST['deleteImage']));
}
elseif (isset($_POST['albumId'])) {
	for ($i = 0; $i <  count($_FILES['file']['name']); $i++) {
		$u->uploadImage($_FILES['file']['name'][$i], $_FILES['file']['tmp_name'][$i], $_POST['albumId']);
	}
	
}
elseif (isset($_POST['changeName'])) {
	//Change the name of the image
	$u->changeImageName(intval($_POST['changeImage']), stripslashes($_POST['changeName']));
}


$albumId = intval($_GET['album']);
$album = $u->getAlbum($albumId);

?>

<h3><a href="<?php echo $u->getSiteUrl(); ?>index.php?page=admin">Albums</a> &gt; <a href="<?php echo $u->getSiteUrl(); ?>index.php?page=admin&album=<?php echo $album->getId(); ?>"><?php echo $album->getName(); ?></a></h3>

<table>

	<tbody>
	
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





<form enctype="multipart/form-data" name="upload" action="<?php echo $u->getSiteUrl(); ?>index.php?page=admin&album=<?php echo $albumId; ?>" method="post">
	<p>
		Upload Photos <input type="file" name="file[]" multiple required>
	</p>
	<p>
	<input type="hidden" name="albumId" value="<?php echo $albumId; ?>">
	</p>
	<p>
		<input type="submit" value="Upload">
	</p>
</form>
