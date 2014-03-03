<?php
/*
Controller for the Error page

Author: Mathias Beke
Url: http://denbeke.be
Date: March 2014
*/


namespace Controller {

	
	require_once(dirname(__FILE__) . '/controller.php');
	require_once(dirname(__FILE__) . '/../model/image.php');
	require_once(dirname(__FILE__) . '/../model/imageExif.php');


	class Image extends Controller {

	
		public $pageName = 'image';
		public $image;
	
	
		public function __construct() {
			parent::__construct();
			$this->theme = 'image.php';
			$this->pageTitle = 'Image - ' . SITE_TITLE;
		}
		
		
		public function GET($args) {
			if(isset($args[1])) {
				$this->image = new \ImageExif($this->urania->getImage($args[1]));
				$this->image->readExifFromFile();
			}
		}
			
	
	}

}

?>
