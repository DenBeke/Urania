<?php
/*
Controller for Admin Index page with a list of the albums

Author: Mathias Beke
Url: http://denbeke.be
Date: March 2014
*/


namespace Controller\Admin {


	
	require_once( __DIR__ . '/../controller.php');
	require_once( __DIR__ . '/../../model/notification.php');
	
	
	class Album extends \Controller\Controller {
	
	
		public $pageName = 'album';
		public $album;
		public $notification = NULL;
	
	
		public function __construct() {
			parent::__construct();
			$this->themeDir = __DIR__ . '/../../../admin/theme/';
			$this->theme = 'album.php';
			$this->pageTitle = 'Album - ' . SITE_TITLE;
		}	
		
		
		public function GET($args) {
			$id = intval($args[1]);
			$this->album = $this->urania->getAlbum($id);
		}	
		
		public function POST() {
			
			if (isset($_POST['deleteImage'])) {
			    try {	
				    $this->urania->deleteImage(intval($_POST['deleteImage']));
				    $this->notification = new \Notification('Image successfully deleted', 'success');
				}
				catch (\exception $exception) {
				    $this->notification = new \Notification('Could not delete image', 'error');
				}
			
			}
			elseif (isset($_POST['albumId'])) {
			    try {
			    	for ($i = 0; $i <  count($_FILES['file']['name']); $i++) {
			    		$this->urania->uploadImage($_FILES['file']['name'][$i], $_FILES['file']['tmp_name'][$i], $_POST['albumId']);
			    	}
			    	$this->notification = new \Notification('Image(s) successfully uploaded', 'success');
			    }
			    catch (\exception $exception) {
			        $this->notification = new \Notification('Could not upload image: ' . $exception->getMessage(), 'error');
			    }
				
			}
			elseif (isset($_POST['changeName'])) {
				//Change the name of the image
				try {
				    $this->urania->changeImageName(intval($_POST['changeImage']), stripslashes($_POST['changeName']));
				    $this->notification = new \Notification('Name of image successfully changed', 'success');
				}
				catch (\exception $exception) {
				    $this->notification = new \Notification('Could not change image name: ' . $exception->getMessage(), 'error');
				}
			}
			
		
			$this->album = $this->urania->getAlbum($this->album->getId()); //Update album after post
		
		}	
	
	}
	

}

?>
