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


	define('SUBMITTED', true);

	try {
	
		//Connect to database
		$db_host = $_POST['db_host'];
		$db_user = $_POST['db_user'];
		$db_password = $_POST['db_password'];
		$db_database = $_POST['db_database'];
		
		if($db_host == '') {
			throw new exception('Please provide a database host');
		}
		elseif($db_user == '') {
			throw new exception('Please provide a database username');
		}
		elseif($db_password == '') {
			throw new exception('Please provide the database password');
		}
		elseif($db_database == '') {
			throw new exception('Please provide the database name');
		}
		
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
		
		define('ERROR', false);
	
	}
	
	catch (exception $e) {
		$error = $e->getMessage();
		define('ERROR', true);
	}
}
else {
	define('SUBMITTED', false);
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
	<link rel="stylesheet" type="text/css" href="pure.css" />
	
</head>
<body>


	<div id="container">


		<h2>Install Urania Photo CMS</h2>
	
		<?php
		if(SUBMITTED) {
			if( !ERROR ) {
				echo '<p class="notice ok">';
				echo 'The database was successfully initialized. Please remove the installation directory for security reasons.';
				echo '</p>';
			}
			else {
				echo '<p class="notice error">';
				echo $error;
				echo '</p>';
			}
		}
		
		if((SUBMITTED && ERROR) || !SUBMITTED) {
		?>
	
		<form method="post" action="index.php" class="pure-form">
		
			<fieldset class="pure-group">
				<input type="text" name="db_host" value="localhost" class="pure-input-1-2" placeholder="host" required="required"/>
				<input type="text" name="db_database" value="" class="pure-input-1-2" placeholder="database name" required="required" />
			</fieldset>
			
			<fieldset class="pure-group">
				<input type="text" name="db_user" value="" class="pure-input-1-2" placeholder="username" required="required" />
				<input type="password" name="db_password" value="" class="pure-input-1-2" placeholder="password" required="required" />
			</fieldset>
			
			<input type="submit" name="submit" value="Submit" class="pure-button pure-input-1-2 pure-button-primary" />
		
		
		</form>
		
		
		<?php } ?>
	
	
	</body>
	
</body>
</html>