<?php
/*
Returns JSON object containing a photo stream with the latest pictures

Author: Mathias Beke
Url: http://denbeke.be
Date: September 2013
*/


require_once(dirname(__FILE__) . '/../core/urania.php');
require_once(dirname(__FILE__) . '/json.php');

$output = array();


try {


	//Parse the arguments
	if(!isset($_GET['count'])) {
		throw new exception("No arguments provided");
	}
	$count = intval(htmlspecialchars($_GET['count']));
	$debug = false;
	
	if(isset($_GET['debug']) && htmlspecialchars($_GET['debug']) == 'true') {
		$debug = true;
	}

	//Get the image
	$u = new Urania(dirname(__FILE__).'/../core/config.php');
	$stream = $u->getLatestImages($count);
	
	$output = array();
	
	foreach ($stream as $image) {
		$last = sizeof($output) + 1;
		$output[$last]['name'] = $image->getName();
	}
	
	
	$out = json_encode($output);
	
	
	if($debug) {
		echo '<pre>';
		echo formatJson($out);
		echo '</pre>';
	}
	else {
		echo $out;
	}
	
	
	
	

}
catch(exception $exception) {

	$output['error'] = true;
	echo json_encode($output);
	
}






?>