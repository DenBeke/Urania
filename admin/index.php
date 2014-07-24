<?php 
/*
Index file for image CMS

Author: Mathias Beke
Url: http://denbeke.be
Date: September 2013
*/

//Initialize configuration
require_once( __DIR__ . '/../core/config.php' );

//Include GluePHP for url handling
require_once( __DIR__ . '/../core/glue.php');

//Create Urania instance
require_once( __DIR__ . '/../core/urania.php');

//Include general functions
require_once( __DIR__ . '/../core/functions.php');

//Include database controller
require_once( __DIR__ . '/../core/database/database.php');

//Include options
require_once BASE_DIR .'/core/options.php';


//Include controllers
require_once( __DIR__ . '/../core/controller/admin/error.php' );
require_once( __DIR__ . '/../core/controller/admin/albums.php' );
require_once( __DIR__ . '/../core/controller/admin/album.php' );
require_once( __DIR__ . '/../core/controller/admin/login.php' );
require_once( __DIR__ . '/../core/controller/admin/logout.php' );
require_once( __DIR__ . '/../core/controller/admin/themes.php' );
require_once( __DIR__ . '/../core/controller/admin/configuration.php' );
require_once( __DIR__ . '/../core/controller/admin/user.php' );


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
	$controller->notification = new Notification('Access Denied.<br>You must be logged in for admin access', 'error');

}


include( __DIR__ . '/theme/header.php');



$controller->template();	
	
	
include( __DIR__ . '/theme/footer.php');
 
 
 
 ?>