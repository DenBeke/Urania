<?php 
/*
Installation Setup for Urania

Author: Mathias Beke
Url: http://denbeke.be
Date: February 2014
*/

require_once(dirname(__FILE__).'/install.php');

$error;

if(isset($_POST['db_host']) && isset($_POST['db_user']) && isset($_POST['db_password']) && isset($_POST['db_database'])) {

	try {
	
		//Connect to database
		$db_host = $_POST['db_host'];
		$db_user = $_POST['db_user'];
		$db_password = $_POST['db_password'];
		$db_database = $_POST['db_database'];
		
		$link = connectDatabase($db_host, $db_user, $db_password, $db_database);
		
		//Add the tables
		createAlbumsTable($link);
		createImagesTable($link);
		
		//Create the 'upload' dir
		mkdir(dirname(__FILE__).'/../upload');
		
		
		//TODO
		//Fetch username
		//Fetch the site url
		//Write everything to the config file
	
	}
	
	catch (exception $e) {
		$error = $e->getMessage();
	}
}

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
	
</head>
<body>

	<?php 
	if(isset($error)) {
		echo '<div class="error">';
		echo $error;
		echo '</div>';
	}
	?>

	<form method="post" action="index.php">
	
		<input type="text" name="db_host" value="localhost" />
		<input type="text" name="db_database" value="" />
		<input type="text" name="db_user" value="" />
		<input type="password" name="db_password" value="" />
		
		<input type="submit" name="submit" value="Submit" />
	
	
	</form>
	
</body>
</html>