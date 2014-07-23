<?php
/*
Controller for the Error page

Author: Mathias Beke
Url: http://denbeke.be
Date: March 2014
*/


namespace Controller {

	
	require_once( __DIR__ . '/controller.php');


	class Error extends Controller {

		public $pageName = 'error';
	
		public function __construct() {
			$this->theme = 'error.php';
			$this->pageTitle = 'Error - ' . SITE_TITLE;
		}
			
	
	}

}

?>
