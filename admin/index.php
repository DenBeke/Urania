<?php 
/*
Index file for image CMS

Author: Mathias Beke
Url: http://denbeke.be
Date: September 2013
*/

session_start();

//require_once('./core/config.php');
require_once( dirname(__FILE__) . '/../core/urania.php');
require_once( dirname(__FILE__) . '/../core/glue.php');

//Include controllers
require_once( dirname(__FILE__) . '/../core/controller/error.php' );
require_once( dirname(__FILE__) . '/../core/controller/admin_albums.php' );
require_once( dirname(__FILE__) . '/../core/controller/admin_album.php' );


$u = new Urania();


//URL handling

$urls = array(
	'ERROR' => 'Controller\Error',
	INSTALL_DIR . '/admin/' => 'Controller\Admin\Albums',
	INSTALL_DIR . '/admin/album/(\d+)' => 'Controller\Admin\Album'
);


$controller = glue::stick($urls);




include(dirname(__FILE__) . '/theme/header.php');



$controller->template();	
	
	
include(dirname(__FILE__) . '/theme/footer.php');
 
 
 
 ?>