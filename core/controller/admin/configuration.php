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
		
		
		
		public function GET($args) {
			
			if(isset($args[1])) {
			
				//if there is an action provided
				switch ($args[1]) {
				
					case "edit-site-options":
					case "edit-site-options/":
						$this->edit_site_options();
						break;
				
				}
				
				
			}
			
		}
		
		
		private function edit_site_options() {
			
			$options = [
				'site_url' => SITE_URL,
				'site_title' => SITE_TITLE,
				'copyright' => COPYRIGHT
			];
			
			if(isset($_POST['site-url']) and $_POST['site-url'] != '') {
				$options['site_url'] = $_POST['site-url'];
			}
			
			if(isset($_POST['site-title']) and $_POST['site-title'] != '') {
				$options['site_title'] = $_POST['site-title'];
			}
			
			if(isset($_POST['footer']) and $_POST['footer'] != '') {
				$options['copyright'] = $_POST['footer'];
			}
			
			\Options::set($options);
			
			header('Location: ' . SITE_URL . 'admin/configuration');
			
		}
		
			
	
	}

}

?>
