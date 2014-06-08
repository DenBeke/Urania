<?php
/*
Controller for Login page

Author: Mathias Beke
Url: http://denbeke.be
Date: March 2014
*/


namespace Controller\Admin {


	
	require_once( __DIR__ . '/../controller.php');
	require_once( __DIR__ . '/../../model/notification.php');
	require_once( __DIR__ . '/../../login.php');
	
	
	class Login extends \Controller\Controller {
	
	
		public $pageName = 'login';
		public $album;
		public $notification = NULL;
	
	
		public function __construct() {
			parent::__construct();
			$this->themeDir = __DIR__ . '/../../../admin/theme/';
			$this->theme = 'login.php';
			$this->pageTitle = 'Login - ' . SITE_TITLE;
		}	
			
		
		public function POST() {
			
			if(isset($_POST['username']) && isset($_POST['password'])) {
			
				if($_POST['username'] == '' or $_POST['password'] == '') {
					$this->notification = new \Notification('Please provide username and password', 'error');
				}
				else {
					if(checkLoginDetails($_POST['username'], $_POST['password'])) {
						login();
						$this->notification = new \Notification('You are successfully logged in', 'success');
					}
					else {
						$this->notification = new \Notification('Wrong username or password', 'error');
					}
				}
				
			
			}
		
		}	
	
	}
	

}

?>
