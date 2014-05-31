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
	
	<link rel="stylesheet" href="<?php echo SITE_URL; ?>admin/style/grids-responsive.css" type="text/css" />
	
	<link rel="stylesheet" href="<?php echo SITE_URL; ?>admin/style/style.css" type="text/css" />
	
	<link rel="stylesheet" href="<?php echo SITE_URL; ?>admin/style/lightbox.css" type="text/css" />
	
	<link rel="stylesheet" href="<?php echo SITE_URL; ?>admin/style/glyphicons.css" type="text/css" />
	
	
	<script src="<?php echo SITE_URL; ?>js/jquery.js" type="text/javascript"></script>
	
	<script src="<?php echo SITE_URL; ?>admin/js/script.js" type="text/javascript"></script>
	
	
	<?php
	
	if($controller->pageName == 'login') {
		if($controller->notification != NULL and $controller->notification->type == 'success') {
			?>
			<meta http-equiv="refresh" content="3; url=<?php echo SITE_URL; ?>admin" />
			<?php
		}
	}
	elseif ($controller->pageName == 'logout') {
		if($controller->notification != NULL and $controller->notification->type == 'success') {
			?>
			<meta http-equiv="refresh" content="3; url=<?php echo SITE_URL; ?>" />
			<?php
		}
	}
	
	?>
	
    	
</head>
<body class="<?php echo $controller->pageName ?>">


	<?php
	if($controller->pageName != 'login' and $controller->pageName != 'logout') {
	?>


	<header>
	
	
		<div id="header-wrapper">
	

			<h1 id="siteTitle"><a href="<?php echo SITE_URL; ?>home"><?php echo SITE_TITLE; ?></a></h1>
			
			
			<div id="nav-bar">

				<nav id="albumNav" class="">
					<ul>
						<li><a href="<?php echo SITE_URL; ?>admin">Administrator</a></li>
						<li><a href="<?php echo SITE_URL; ?>admin/albums">Albums</a>
							<ul class="children">
								<!-- <li><a href=""><span class="glyphicon glyphicon-plus"></span> Add Album</a></li> -->
							<?php
							foreach ($controller->urania->getAllAlbums() as $album) {
								$navId = $album->getId();
								$name = $album->getName();
								echo '<li><a href="' . SITE_URL . "admin/album/$navId/\">$name</a></li>";
							}
							?>
							</ul>
						</li>
						<li><a>Settings</a>
							<ul class="children">
								<li><a href="<?php echo SITE_URL; ?>admin/themes"><span class="glyphicon glyphicon-th"> </span> Theme</a></li>
								<li><a href="<?php echo SITE_URL; ?>admin/configuration"><span class="glyphicon glyphicon-wrench"> </span> Site Configuration</a></li>
							</ul>
						</li>
					</ul>
				</nav>
			
			
			
				<div class="user logout">
					<a href="<?php echo SITE_URL; ?>admin/logout">Logout</a>
				</div>
				
			</div><!-- #nav-bard -->
			
			<!-- Button for show responsive nav-bar -->
			<!-- Is hidden by default -->
			<div class="user nav-toggle">
				<a><span class="glyphicon glyphicon-list"></span></a>
			</div>
			
		</div><!-- #header-wrapper -->
		
	
	</header>
	
	
	
	
	<div id="wrapper">
	
	
		<ol class="level-nav" style="margin-bottom: 5px;">
		      <li><a href="<?php echo SITE_URL; ?>admin">Admin</a></li>
		      <li><a href="<?php echo SITE_URL; ?>admin/albums">Albums</a></li>
		      <?php if($controller->pageName == 'album') { ?>
		      <li class="active"><?php echo $controller->album->getName(); ?></li>
		      <?php } ?>
		</ol>
	
	<?php } 
	else {
	?>
	
	<div id="wrapper">
	
	<?php } ?>
	