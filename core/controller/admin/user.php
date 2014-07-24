<?php
/*
Controller for the Admin "Site Configuration" page

Author: Mathias Beke
Url: http://denbeke.be
Date: March 2014
*/


namespace Controller\Admin {

	
	require_once( __DIR__ . '/../controller.php');


	class User extends \Controller\Controller {

	
		public $pageName = 'user';
		public $albums = array();
		public $notification = NULL;
		
		
		public function __construct() {
			parent::__construct();
			$this->themeDir = __DIR__ . '/../../../admin/theme/';
			$this->theme = 'user.php';
			$this->pageTitle = 'User Control Panel - ' . SITE_TITLE;
					
			
		}
		
		
		
		public function GET($args) {
			
			if(isset($args[1])) {
			
				//if there is an action provided
				switch ($args[1]) {
				
					case "change-password":
					case "change-password/":
						$this->change_password();
						break;
				
				}
				
			}
			
		}
	
		
		private function change_password() {
			
			//TODO
			
		}
		
			
	
	}

}

?>
