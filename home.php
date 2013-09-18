<h1>Home</h1>
<?php

foreach ($u->getAllAlbums() as $album) {
	$id = $album->getId();
	echo "<a href=\"index.php?page=album&album=$id\">$album</a>";
}
?>