<?php 
/*
Index file for image CMS

Author: Mathias Beke
Url: http://denbeke.be
Date: September 2013
*/


//Initialize configuration
require_once( __DIR__ . '/core/config.php' );

//Include general functions
require_once( __DIR__ . '/core/functions.php');

//Include database controller
require_once( __DIR__ . '/core/database/database.php');

//Include GluePHP for url handling
require_once( __DIR__ . '/core/glue.php');

//Include Urania class
require_once( __DIR__ . '/core/urania.php');

//Include controllers
require_once( __DIR__ . '/core/controller/error.php' );
require_once( __DIR__ . '/core/controller/home.php' );
require_once( __DIR__ . '/core/controller/album.php' );
require_once( __DIR__ . '/core/controller/image.php' );


$u = new Urania('./core/config.php');


//URL handling

$urls = array(
	'ERROR' => 'Controller\Error',
	INSTALL_DIR . '/' => 'Controller\Home',
	INSTALL_DIR . '/home' => 'Controller\Home',
	INSTALL_DIR . '/album/(\d+)/[a-zA-Z\-0-9]*' => 'Controller\Album',
	INSTALL_DIR . '/album/(\d+)' => 'Controller\Album',
	INSTALL_DIR . '/image/(\d+)/[a-zA-Z\-0-9]*' => 'Controller\Image',
	INSTALL_DIR . '/image/(\d+)' => 'Controller\Image'
);

$controller = glue::stick($urls);



//Include header template
include(THEME_DIR . '/header.php');

//Include content template
$controller->template();	
	
//Include footer template
include(THEME_DIR . '/footer.php');
 
 
 ?>