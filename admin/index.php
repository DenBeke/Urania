<?php 
/*
Index file for image CMS

Author: Mathias Beke
Url: http://denbeke.be
Date: September 2013
*/

//require_once('./core/config.php');
require_once( dirname(__FILE__) . '/../core/urania.php');
require_once( dirname(__FILE__) . '/../core/glue.php');
require_once( dirname(__FILE__) . '/../core/glue.php');

//Include controllers
require_once( dirname(__FILE__) . '/../core/controller/error.php' );
require_once( dirname(__FILE__) . '/../core/controller/admin_albums.php' );
require_once( dirname(__FILE__) . '/../core/controller/admin_album.php' );
require_once( dirname(__FILE__) . '/../core/controller/login.php' );
require_once( dirname(__FILE__) . '/../core/controller/logout.php' );



//URL handling
$urls = array(
	'ERROR' => 'Controller\Error',
	INSTALL_DIR . '/admin/' => 'Controller\Admin\Albums',
	INSTALL_DIR . '/admin/album/(\d+)' => 'Controller\Admin\Album',
	INSTALL_DIR . '/admin/login' => 'Controller\Admin\Login',
	INSTALL_DIR . '/admin/logout' => 'Controller\Admin\Logout'
);
	
	
$controller = glue::stick($urls);
	

if(!loggedIn() && $controller->pageName != 'login' && $controller->pageName != 'logout') {

	$controller = new Controller\Admin\Login;
	$controller->notification = new Notification('Access Denied.<br>You must be logged in for admin access', 'error');

}



include(dirname(__FILE__) . '/theme/header.php');



$controller->template();	
	
	
include(dirname(__FILE__) . '/theme/footer.php');
 
 
 
 ?>