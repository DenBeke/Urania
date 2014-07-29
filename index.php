<?php 
/*
Index file for image CMS

Author: Mathias Beke
Url: http://denbeke.be
Date: September 2013
*/


//Initialize configuration
require __DIR__ . '/core/config.php';

//Include auto loader
require BASE_DIR . '/core/autoloader.php';

//Include general functions
require BASE_DIR . '/core/functions.php';

//Include database controller
require BASE_DIR . '/core/database/database.php';

//Include options
require BASE_DIR . '/core/options.php';

//Include Theme functions
require BASE_DIR . '/core/theme_functions.php';



//URL handling

$urls = array(
	'ERROR' 										=> 'Controller\Error',
	INSTALL_DIR . '/' 							=> 'Controller\Home',
	INSTALL_DIR . '/home' 						=> 'Controller\Home',
	INSTALL_DIR . '/album/(\d+)/[a-zA-Z\-0-9]*' 	=> 'Controller\Album',
	INSTALL_DIR . '/album/(\d+)' 				=> 'Controller\Album',
	INSTALL_DIR . '/image/(\d+)/[a-zA-Z\-0-9]*' 	=> 'Controller\Image',
	INSTALL_DIR . '/image/(\d+)' 				=> 'Controller\Image'
);

$controller = glue::stick($urls);



//Include header template
include(THEME_DIR . '/header.php');

//Include content template
$controller->template();	
	
//Include footer template
include(THEME_DIR . '/footer.php');
 
 
 ?>