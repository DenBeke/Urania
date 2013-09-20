<h1 id="adminTitle">Admin</h1>

<div id="admin" class="page">

	
	<?php 
	
	
	require_once('./core/login.php');
	
	
	if(!loggedIn()) {
	
		echo "<script language=\"javascript\">\n";
		echo "window.location = \"index.php?page=login\";\n";
		echo "</script>\n";
	
	}
	
	
	
	?>
	
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

</div>