<?php 


require_once('./core/login.php');


if(!loggedIn()) {

	echo "<script language=\"javascript\">\n";
	echo "window.location = \"index.php?page=login\";\n";
	echo "</script>\n";

}



if(isset($_POST['albumName'])) {
	$u->addAlbum($_POST['albumName']);
}
elseif (isset($_POST['albumId'])) {
	
	echo "Upload photos";
	for ($i = 0; $i <  count($_FILES['file']['name']); $i++) {
		$u->uploadImage($_FILES['file']['name'][$i], $_FILES['file']['tmp_name'][$i], $_POST['albumId']);
		echo $_FILES['file']['name'][$i];
		echo $_FILES['file']['tmp_name'][$i];
	}
	//print_r($_FILES['file']['tmp_name']);
	
}


?>

<h1>Admin</h1>

<h3>Albums</h3>
<?php

foreach ($u->getAllAlbums() as $album) {
	$id = $album->getId();
	echo "<a href=\"index.php?page=admin&album=$id\">$album</a>";
	//TODO DELETE ALBUM  button
}
?>

<form name="input" action="index.php?page=admin" method="post">
New Album: <input type="text" name="albumName">
<input type="submit" value="Add">
</form>


<form enctype="multipart/form-data" name="upload" action="index.php?page=admin" method="post">
	<p>
		Upload Photos <input type="file" name="file[]" multiple>
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