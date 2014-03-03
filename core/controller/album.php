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
		public $album;
	
	
		public function __construct() {
			parent::__construct();
			$this->theme = 'album.php';
			$this->pageTitle = 'Album - ' . SITE_TITLE;
		}
		
		
		public function GET($args) {
			$id = intval($args[1]);
			$this->album = $this->urania->getAlbum($id);
		}
			
	
	}

}

?>
