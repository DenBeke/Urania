<?php
/*
Controller for the Error page

Author: Mathias Beke
Url: http://denbeke.be
Date: March 2014
*/


namespace Controller {


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
				$this->image = new \Model\ImageExif($this->urania->getImage($args[1]));
				$this->image->readExifFromFile();
				$this->pageTitle = $this->image->getName() . ' - ' . SITE_TITLE;
			}
		}
			
	
	}

}

?>
