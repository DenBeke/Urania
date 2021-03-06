<?php 
/*
Index file for image CMS

Author: Mathias Beke
Url: http://denbeke.be
Date: September 2013
*/

//Initialize configuration
require __DIR__ . '/../core/config.php';

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



//Initialize authentication
Auth::init();


//URL handling
$urls = array(
	'ERROR' 												=> 'Controller\Admin\Error',
	INSTALL_DIR . '/admin/' 								=> 'Controller\Admin\Albums',
	INSTALL_DIR . '/admin/albums' 						=> 'Controller\Admin\Albums',
	INSTALL_DIR . '/admin/album/(\d+)' 					=> 'Controller\Admin\Album',
	INSTALL_DIR . '/admin/album/(\d+)/([a-z\-]+)' 		=> 'Controller\Admin\Album',
	INSTALL_DIR . '/admin/login' 						=> 'Controller\Admin\Login',
	INSTALL_DIR . '/admin/logout' 						=> 'Controller\Admin\Logout',
	INSTALL_DIR . '/admin/themes' 						=> 'Controller\Admin\Themes',
	INSTALL_DIR . '/admin/themes/([a-z\-]+)/([a-z\-_]+)' 	=> 'Controller\Admin\Themes',
	INSTALL_DIR . '/admin/configuration'					=> 'Controller\Admin\Configuration',
	INSTALL_DIR . '/admin/configuration/([a-z\-]+)'		=> 'Controller\Admin\Configuration',
	INSTALL_DIR . '/admin/user'							=> 'Controller\Admin\User',
	INSTALL_DIR . '/admin/user/([a-z\-]+)'				=> 'Controller\Admin\User',
);
	

$controller = glue::stick($urls);

if(!Auth::loggedIn() && $controller->pageName != 'login' && $controller->pageName != 'logout') {

	$controller = new Controller\Admin\Login;
	$controller->notification = new \Model\Notification('Access Denied.<br>You must be logged in for admin access', 'error');

}


include( __DIR__ . '/theme/header.php');



$controller->template();	
	
	
include( __DIR__ . '/theme/footer.php');
 
 
 
 ?>