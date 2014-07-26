<?php 
/*
Installation Setup for Urania

Author: Mathias Beke
Url: http://denbeke.be
Date: February 2014
*/

require_once( __DIR__ .'/install.php');


Install::init();


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Install Urania</title>
	
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<link rel="stylesheet" type="text/css" href="style.css" />
	<link rel="stylesheet" type="text/css" href="pure.css" />
	
</head>
<body>


	<div id="container">
	
		<?php echo Install::$notifications; ?>
	
		<?php include Install::$form; ?>
	
	</body>
	
</body>
</html>