<?php
/*
Controller for the Admin Error page
It will forward the admin to the default error page of the main site

Author: Mathias Beke
Url: http://denbeke.be
Date: March 2014
*/


namespace Controller\Admin {

	
	require_once(dirname(__FILE__) . '/controller.php');


	class Error extends \Controller\Controller {

	
		public function __construct() {
			header('Location: ' . SITE_URL . 'error' );
		}
			
	
	}

}

?>
