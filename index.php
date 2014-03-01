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

$u = new Urania('./core/config.php');


//URL handling

$urls = array(
	'ERROR' => 'Controller\Error',
	INSTALL_DIR . 'player' => 'Controller\Player',
	INSTALL_DIR . 'register' => 'Controller\Register',
	INSTALL_DIR  => 'Controller\Home',
	INSTALL_DIR . 'login' => 'Controller\Login',
	INSTALL_DIR . 'coach' => 'Controller\Coach',
	INSTALL_DIR . 'competition' => 'Controller\Competition',
	INSTALL_DIR . 'match' => 'Controller\Match',
	INSTALL_DIR . 'referee' => 'Controller\Referee',
	INSTALL_DIR . 'tournament' => 'Controller\Tournament',
	INSTALL_DIR . 'news' => 'Controller\News',
	INSTALL_DIR . 'configPanel' => 'Controller\UserConfigPanel'
);


$controller = glue::stick($urls);




include(dirname(__FILE__) . '/theme/header.php');



$controller->template();	
	
	
include(dirname(__FILE__) . '/theme/footer.php');
 
 
 
 ?>