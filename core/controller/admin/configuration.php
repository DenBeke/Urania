<?php
/*
Controller for the Admin "Site Configuration" page

Author: Mathias Beke
Url: http://denbeke.be
Date: March 2014
*/


namespace Controller\Admin {

	
	require_once( __DIR__ . '/../controller.php');


	class Configuration extends \Controller\Controller {

	
		public $pageName = 'configuration';
		public $albums = array();
		public $notification = NULL;
		public $themes = [];
		
		
		public function __construct() {
			parent::__construct();
			$this->themeDir = __DIR__ . '/../../../admin/theme/';
			$this->theme = 'configuration.php';
			$this->pageTitle = 'Site Configuration - ' . SITE_TITLE;
					
			
		}
			
	
	}

}

?>
