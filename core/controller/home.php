<?php
/*
Controller for the Error page

Author: Mathias Beke
Url: http://denbeke.be
Date: March 2014
*/


namespace Controller {


	class Home extends Controller {

	
		public $pageName = 'home';
		public $pageTitle = '';
		public $albums;
	
	
		public function __construct() {
			
			if(INSTALLED === false) {
				header('Location: ./install/');
			}
			
			parent::__construct();
			$this->theme = 'home.php';
			$this->pageTitle = SITE_TITLE;
			$this->albums = \Urania::getAllAlbums();
		}
			
	
	}

}

?>