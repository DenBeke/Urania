<?php 
/*
Index file for image CMS

Author: Mathias Beke
Url: http://denbeke.be
Date: September 2013
*/

session_start();

//require_once('./core/config.php');
require_once('./core/urania.php');
require_once('./core/glue.php');

//Include controllers
require_once( dirname(__FILE__) . '/core/controller/error.php' );
require_once( dirname(__FILE__) . '/core/controller/home.php' );
require_once( dirname(__FILE__) . '/core/controller/album.php' );


$u = new Urania('./core/config.php');


//URL handling

$urls = array(
	'ERROR' => 'Controller\Error',
	INSTALL_DIR . '/' => 'Controller\Home',
	INSTALL_DIR . '/home' => 'Controller\Home',
	INSTALL_DIR . '/album/(\d+)/[a-zA-Z\-0-9]*' => 'Controller\Album'
);


$controller = glue::stick($urls);




include(dirname(__FILE__) . '/theme/header.php');



$controller->template();	
	
	
include(dirname(__FILE__) . '/theme/footer.php');
 
 
 
 ?>