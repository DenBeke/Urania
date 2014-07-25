<?php
/*
Controller for the Admin Themes page

Author: Mathias Beke
Url: http://denbeke.be
Date: March 2014
*/


namespace Controller\Admin {


	class Themes extends \Controller\Controller {

	
		public $pageName = 'themes';
		public $albums = array();
		public $notification = NULL;
		public $themes = [];
		
		
		public function __construct() {
			parent::__construct();
			$this->themeDir = __DIR__ . '/../../../admin/theme/';
			$this->theme = 'themes.php';
			$this->pageTitle = 'Themes - ' . SITE_TITLE;
					
			
			$themes = __DIR__ . '/../../../theme/*';			
			foreach (glob( $themes ) as $dir) {
				$theme_name = explode('/', $dir);
				$theme_name = $theme_name[sizeof($theme_name) - 1];
				
				$this->themes[$theme_name] = json_decode( file_get_contents($dir . '/theme.json') );
				$this->themes[$theme_name]->dir = $dir;
			}
			
		}
			
			
		public function GET($args) {
			
			if(isset($args[1])) {
			
				//if there is an action provided
				switch ($args[1]) {
				
					case "activate":
					case "activate/":
						if(isset($args[2])) {
							$this->activate($args[2]);
						}
						break;
				
				}
				
			}
			
		}
		
		
		
		private function activate($theme) {
			
			\Options::set(['theme' => $theme]);
			header('Location: ' . SITE_URL . 'admin/themes/');
			
			
		}
		
	
	}

}

?>
