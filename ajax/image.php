<?php
/*
Returns JSON object containing all the info of an image

Author: Mathias Beke
Url: http://denbeke.be
Date: September 2013
*/


require_once(dirname(__FILE__).'/../core/urania.php');

$output = array();


try {


	//Parse the arguments
	if(!isset($_GET['image'])) {
		throw new exception("No arguments provided");
	}
	$image = intval(htmlspecialchars($_GET['image']));
	$outputImage;


	//Get the image
	$u = new Urania(dirname(__FILE__).'/../core/config.php');
	$outputImage = new imageExif($u->getImage($image));
	$outputImage->readExifFromFile();
	

	//Return the json object
	$output = array();
	
	$output['name'] = $outputImage->getName();
	$output['fileName'] = $outputImage->getFileName();
	$output['date'] = date('d-m-Y', $outputImage->getDate());
	
	$output['shutterSpeed'] = $outputImage->getShutterSpeed();
	$output['aperture'] = $outputImage->getAperture();
	$output['iso'] = $outputImage->getIso();
	$output['focallength'] = $outputImage->getFocalLength();
	$output['camera'] = $outputImage->getCamera();
	
	$output['longitude'] = $outputImage->getGpsLongitude();
	$output['latitude'] = $outputImage->getGpsLatitude();
	
	$output['error'] = false;
	
	echo json_encode($output);
	

}
catch(exception $exception) {

	$output['error'] = true;
	echo json_encode($output);
	
}





?>