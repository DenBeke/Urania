<?php
/*
Controller for the Error page

Author: Mathias Beke
Url: http://denbeke.be
Date: March 2014
*/


namespace Controller\Admin {

	
	require_once(dirname(__FILE__) . '/../controller.php');


	class Logout extends \Controller\Controller {

		public $pageName = 'logout';
		public $notification = NULL;
	
		public function __construct() {
			$this->themeDir = dirname(__FILE__) . '/../../../admin/theme/';
			$this->theme = 'logout.php';
			$this->pageTitle = 'Logout - ' . SITE_TITLE;
			$this->notification = new \Notification('You are successfully logged out', 'success');
			logout();
		}
			
	
	}

}

?>
