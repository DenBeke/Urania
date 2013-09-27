<?php

if(isset($_POST['albumName'])) {
	try {
	    $u->addAlbum(stripslashes($_POST['albumName']));
	}
	catch (exception $exception) {
	    echo '<h3>Could not add album: ' . $exception->getMessage() . '</h3>';
	}
}
elseif (isset($_POST['albumId'])) {
	try {
    	for ($i = 0; $i <  count($_FILES['file']['name']); $i++) {
    		$u->uploadImage($_FILES['file']['name'][$i], $_FILES['file']['tmp_name'][$i], $_POST['albumId']);
    	}
    }
    catch (exception $exception) {
        echo '<h3>Could not upload image: ' . $exception->getMessage() . '</h3>';
    }
		
}
elseif (isset($_POST['deleteAlbum'])) {
    try {
	    $u->deleteAlbum(intval($_POST['deleteAlbum']));
	}
	catch (exception $exception) {
	    echo '<h3>Could not delete album: ' . $exception->getMessage() . '</h3>';
	}
}
elseif (isset($_POST['changeName'])) {
	//Change the name of the image
	try {
    	$u->changeAlbumName(intval($_POST['changeAlbumId']), stripslashes($_POST['changeName']));
    }
    catch (exception $exception) {
        echo '<h3>Could not change album name: ' . $exception->getMessage() . '</h3>';
    }
}




?>

<h3><a href="<?php echo $u->getSiteUrl(); ?>index.php?page=admin">Albums</a></h3>
<table>

	<tbody>
	
	
		<?php
		
		foreach ($u->getAllAlbums() as $album) {
			$id = $album->getId();
			//echo "<a href=\"index.php?page=admin&album=$id\">$album</a>";
			?>
			<tr>
				<td>
					<a href="<?php echo $u->getSiteUrl(); ?>index.php?page=admin&album=<?php echo $id; ?>"><?php echo $album->getName(); ?></a>
				</td>
				<td class="date">
					<?php echo date('d-m-Y', $album->getDate()); ?>
				</td>
				<td>
					<form method="post" action="<?php echo $u->getSiteUrl(); ?>index.php?page=admin">
						<input type="hidden" name="deleteAlbum" value="<?php echo $id; ?>">
						<input type="submit" value="Delete">
					</form>
				</td>
				<td>
					<form method="post" action="<?php echo $u->getSiteUrl(); ?>index.php?page=admin">
						<input type="hidden" name="changeAlbumId" value="<?php echo $album->getId(); ?>">
						<input type="text" name="changeName" value="" / required>
						<input type="submit" value="Change name">
					</form>
				</td>
			</tr>
			<?php
			//TODO DELETE ALBUM  button
		}
		?>
	
	
	</tbody>


</table>


<form name="input" action="<?php echo $u->getSiteUrl(); ?>index.php?page=admin" method="post">
New Album: <input type="text" name="albumName" required>
<input type="submit" value="Add">
</form>


<form enctype="multipart/form-data" name="upload" action="<?php echo $u->getSiteUrl(); ?>index.php?page=admin" method="post">
	<p>
		Upload Photos <input type="file" name="file[]" multiple required>
	</p>
	<p>
	<select name="albumId">
	
	<?php
	
	foreach ($u->getAllAlbums() as $album) {
		$id = $album->getId();
		$name = $album->getName();
		//echo "<a href=\"index.php?page=admin&album=$id\">$album</a>";
		echo "<option value=\"$id\">$name</option>";
	}
	?>
	
	</p>
	<p>
		<input type="submit" value="Upload">
	</p>
</form>