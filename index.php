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
if(isset($_GET['page']) and htmlspecialchars($_GET['page']) != '') {
	//Album
	$includePage = htmlspecialchars($_GET['page']) . '.php';
	$pageName = htmlspecialchars($_GET['page']);
	
	
	if($pageName == 'album') {
		try {
    		$id = intval(htmlspecialchars($_GET['album']));
    		$pageName = $u->getAlbum($id)->getName() . ' - ' . $u->getSiteTitle();
    	}
    	catch (exception $exception) {
    	    $pageName = 'Error';
    	}
	}
	elseif($pageName == 'home') {
		$pageName = $u->getSiteTitle();
	}
	else {
		$pageName = ucfirst($pageName) . ' - ' . $u->getSiteTitle();
	}
}
else {
	$includePage = 'home.php';
	$pageName = $u->getSiteTitle();
}


//Limit include page to everything but letters, numbers and a dot
$includePage = preg_replace('/[^a-z0-9.]/', '', $includePage);


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $pageName; ?></title>
	
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<meta http-equiv="X-UA-Compatible" content="IE=8" />
	
	<script src="<?php echo $u->getSiteUrl(); ?>js/jquery.js" type="text/javascript"></script>
	
	<script src="<?php echo $u->getSiteUrl(); ?>js/lightbox.js" type="text/javascript"></script>
	
	<script src="<?php echo $u->getSiteUrl(); ?>js/browsercheck.js" type="text/javascript"></script>
	
	
	<link rel="stylesheet" href="<?php echo $u->getSiteUrl(); ?>style.css" type="text/css" />
	 
	 
	</script>
	
</head>
<body>



	<header>

		<h1 id="siteTitle"><a href="<?php echo $u->getSiteUrl(); ?>home"><?php echo $u->getSiteTitle(); ?></a></h1>
		
		<nav id="albumNav">
			<ul>
				<?php
				$url = $u->getSiteUrl();
				
				foreach ($u->getAllAlbums() as $album) {
					$navId = $album->getId();
					$name = $album->getName();
					$simpleName = $u->simplifyFileName($name);
					echo "<li><a href=\"$url"."album/$navId/$simpleName\">$name</a></li>";
				}
				?>
			</ul>
		</nav>
	
	</header>
	
	

	<?php 
	
	if(file_exists('./pages/' . $includePage)) {
	    include('./pages/' . $includePage);
	}
	else {
	    ?>
	    <h2>Sorry, but this page doesn't exist</h2>
	    <?php
	}
	?>
	
	
	
	<footer>
		<p>
			&copy; Chris L'hoëst - Website by <a href="http://denbeke.be">Mathias Beke</a>
		</p>
	</footer>

	
	<!--Lightbox elements-->
	<div id="overlay">
		<div id="lightboxImage" class="loader">	
			<img id="ajax" src="<?php echo $u->getSiteUrl(); ?>ajax-loader.gif" />
			<img id="image" src="<?php echo $u->getSiteUrl(); ?>ajax-loader.gif" />
			<div id="close"></div>
		</div>
	</div>
	
		
</body>
</html>