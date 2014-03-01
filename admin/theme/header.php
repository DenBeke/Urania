<?php
/*
Theme part for header

Author: Mathias Beke
Url: http://denbeke.be
Date: March 2013
*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $controller->pageTitle; ?></title>
	
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<script src="<?php echo SITE_URL; ?>js/jquery.js" type="text/javascript"></script>
	
	<link rel="stylesheet" href="<?php echo SITE_URL; ?>admin/style/pure.css" type="text/css" />
	
	<link rel="stylesheet" href="<?php echo SITE_URL; ?>admin/style/style.css" type="text/css" />
    	
</head>
<body>


	<header>

		<h1 id="siteTitle"><a href="<?php echo SITE_URL; ?>home"><?php echo SITE_TITLE; ?></a></h1>
		
		<nav id="albumNav">
			<ul>
				<?php
				foreach ($u->getAllAlbums() as $album) {
					$navId = $album->getId();
					$name = $album->getName();
					$simpleName = $u->simplifyFileName($name);
					echo '<li><a href="' . SITE_URL . "album/$navId/$simpleName\">$name</a></li>";
				}
				?>
			</ul>
		</nav>
	
	</header>