<?php
/*
Returns JSON object containing all albums with their URL

Author: Mathias Beke
Url: http://denbeke.be
Date: September 2013
*/

//Initialize configuration
require_once( __DIR__ . '/../core/config.php' );

//Include auto loader
require BASE_DIR . '/core/autoloader.php';

//Include general functions
require_once( __DIR__ . '/../core/functions.php');

//Include database controller
require_once( __DIR__ . '/../core/database/database.php');

//Include options
require_once BASE_DIR .'/core/options.php';


$output = array();


try {


	$debug = false;

	if(isset($_GET['debug']) && htmlspecialchars($_GET['debug']) == 'true') {
		$debug = true;
	}


	//Get the image
	$u = new Urania;
	$albums = $u->getAllAlbums();
    $output = [];

	foreach ($albums as $album) {
		
		$navId = $album->getId();
		$name = $album->getName();
		$simpleName = Urania::simplifyFileName($name);
		
		$output[] = ['name' => $name, 'url' => SITE_URL . "album/$navId/$simpleName"];
		
	}


	$out = json_encode($output, JSON_PRETTY_PRINT);
	if($debug) {
		echo '<pre>';
		echo $out;
		echo '</pre>';
	}
	else {
		echo $out;
	}


}
catch(exception $exception) {

	$output['error'] = true;
	echo json_encode($output);
	echo $exception;

}





?>