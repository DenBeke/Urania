<?php
/*
Controller for the Admin "Site Configuration" page

Author: Mathias Beke
Url: http://denbeke.be
Date: March 2014
*/


namespace Controller\Admin {


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
			if(isset($_POST['old-password']) and $_POST['new-password'] and $_POST['confirm-password']) {
				//All fields are filled, proceed!
				if(\Auth::$user->checkPassword($_POST['old-password'])) {
					//User authenticated
					
					if($_POST['new-password'] == $_POST['confirm-password']) {
						
						//Passwords are the same
						
						if($_POST['new-password'] != '') {
							
							//Save new password...
							$newEncrypted = \Auth::encrypt($_POST['new-password'], \Auth::$user->getSalt());
							
							\Database\User::changePassword(\Auth::$user->getId(), $newEncrypted);
							
							$this->notification = new \Model\Notification('Password changed.', 'success');
						
						}
						else {
							//Password cannot be empty
							$this->notification = new \Model\Notification('Password cannot be empty', 'error');
						}
						
						
						
						
					}
					else {
						//Passwords are not the same
						$this->notification = new \Model\Notification('Passwords are not the same. Please verify you type two times the same password', 'error');
					}
					
				}
				else {
					//Wrong password
					$this->notification = new \Model\Notification('Wrong password.', 'error');
				}
				
			}
			else {
				//Please fill all fields... :)
				$this->notification = new \Model\Notification('Please fill all fields', 'error');
			}
			
		}
		
			
	
	}

}

?>