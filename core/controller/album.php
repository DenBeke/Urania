<?php
/*
Controller for the Error page

Author: Mathias Beke
Url: http://denbeke.be
Date: March 2014
*/


namespace Controller {

	
	require_once(dirname(__FILE__) . '/controller.php');


	class Album extends Controller {

	
		public $pageName = 'album';
	
	
		public function __construct() {
			$this->theme = 'album.php';
		}
			
	
	}

}

?>
