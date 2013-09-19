<?php 
/*
Index file for image CMS

Author: Mathias Beke
Url: http://denbeke.be
Date: September 2013
*/

session_start();

require_once('./core/urania.php');

$u = new Urania('./core/config.php');


//Find the page type
$includePage = '';
$pageName = '';
$id = 0;
if(isset($_GET['page']) and $_GET['page'] != '') {
	//Album
	$includePage = $_GET['page'] . '.php';
	$pageName = $_GET['page'];
	$id = intval($_GET['album']);
}
else {
	$includePage = './home.php';
	$pageName = 'Home';
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $pageName; ?></title>
	
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<link rel="stylesheet" href="style.css" type="text/css" />
	
</head>
<body>


	<header>

		<h1 id="siteTitle"><?php echo $u->getSiteTitle(); ?></h1>
		<nav id="albumNav">
			<ul>
				<?php
				
				foreach ($u->getAllAlbums() as $album) {
					$navId = $album->getId();
					$name = $album->getName();
					echo "<li><a href=\"index.php?page=album&album=$navId\">$name</a></li>";
				}
				?>
			</ul>
		</nav>
	
	</header>
	
	

	<?php 
	
	include($includePage);
	
	?>
		
</body>
</html>