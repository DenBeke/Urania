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

//Include controllers
require_once( __DIR__ . '/../core/controller/admin/error.php' );
require_once( __DIR__ . '/../core/controller/admin/albums.php' );
require_once( __DIR__ . '/../core/controller/admin/album.php' );
require_once( __DIR__ . '/../core/controller/admin/login.php' );
require_once( __DIR__ . '/../core/controller/admin/logout.php' );
require_once( __DIR__ . '/../core/controller/admin/themes.php' );
require_once( __DIR__ . '/../core/controller/admin/configuration.php' );



//URL handling
$urls = array(
	'ERROR' 								=> 'Controller\Admin\Error',
	INSTALL_DIR . '/admin/' 				=> 'Controller\Admin\Albums',
	INSTALL_DIR . '/admin/albums' 		=> 'Controller\Admin\Albums',
	INSTALL_DIR . '/admin/album/(\d+)' 	=> 'Controller\Admin\Album',
	INSTALL_DIR . '/admin/login' 		=> 'Controller\Admin\Login',
	INSTALL_DIR . '/admin/logout' 		=> 'Controller\Admin\Logout',
	INSTALL_DIR . '/admin/themes' 		=> 'Controller\Admin\Themes',
	INSTALL_DIR . '/admin/configuration'	=> 'Controller\Admin\Configuration',
);
	
	
$controller = glue::stick($urls);
	

if(!loggedIn() && $controller->pageName != 'login' && $controller->pageName != 'logout') {

	$controller = new Controller\Admin\Login;
	$controller->notification = new Notification('Access Denied.<br>You must be logged in for admin access', 'error');

}



include( __DIR__ . '/theme/header.php');



$controller->template();	
	
	
include( __DIR__ . '/theme/footer.php');
 
 
 
 ?>