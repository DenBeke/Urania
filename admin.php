<?php 


require_once('./core/login.php');


if(!loggedIn()) {

	echo "<script language=\"javascript\">\n";
	echo "window.location = \"index.php?page=login\";\n";
	echo "</script>\n";

}



?>

<h1>Admin</h1>

<?php

if (!isset($_GET['album'])) {
	include('admin_albums.php');
}
else {
	include('admin_single_album.php');
}

?>


<p>
<a href="index.php?page=logout">Logout</a>
</p>