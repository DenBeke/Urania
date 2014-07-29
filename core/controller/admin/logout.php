<?php
/*
Controller for the Error page

Author: Mathias Beke
Url: http://denbeke.be
Date: March 2014
*/


namespace Controller\Admin {


	class Logout extends \Controller\Controller {

		public $pageName = 'logout';
		public $notification = NULL;
	
		public function __construct() {
			$this->themeDir = __DIR__ . '/../../../admin/theme/';
			$this->theme = 'logout.php';
			$this->pageTitle = 'Logout - ' . SITE_TITLE;
			$this->notification = new \Model\Notification('You are successfully logged out', 'success');
			\Auth::logout();
		}
			
	
	}

}

?>