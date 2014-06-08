<?php
/*
Controller for the Error page

Author: Mathias Beke
Url: http://denbeke.be
Date: March 2014
*/


namespace Controller {

	
	require_once( __DIR__ . '/controller.php');


	class Home extends Controller {

	
		public $pageName = 'home';
		public $pageTitle = '';
		public $albums;
	
	
		public function __construct() {
			parent::__construct();
			$this->theme = 'home.php';
			$this->pageTitle = SITE_TITLE;
			$this->albums = $this->urania->getAllAlbums();
		}
			
	
	}

}

?>
