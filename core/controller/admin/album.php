<?php
/*
Controller for Admin Index page with a list of the albums

Author: Mathias Beke
Url: http://denbeke.be
Date: March 2014
*/


/**
@brief Namespace containing all admin controller objects
*/
namespace Controller\Admin {
	
	
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
			
			if(!isset($args[1])) {
				throw new exception("No album id given");
			}
			
			$id = intval($args[1]);
			$this->album = \Urania::getAlbum($id);
			$this->pageTitle = $this->album->getName() . ' - ' . SITE_TITLE;
			
			
			if(isset($args[2])) {
			
				//if there is an action provided
				switch ($args[2]) {
				
					case "edit-description":
					case "edit-description/":
						$this->editDescription();
						break;
				
				}
				
				
				//Fetch the album again (with updated data)
				$this->album = \Urania::getAlbum($id);
				
			}
		}	
		
		public function POST() {
			
			if (isset($_POST['deleteImage'])) {
			    try {	
				    \Urania::deleteImage(intval($_POST['deleteImage']));
				    $this->notification = new \Model\Notification('Image successfully deleted', 'success');
				}
				catch (\exception $exception) {
				    $this->notification = new \Model\Notification('Could not delete image', 'error');
				}
			
			}
			elseif (isset($_POST['albumId'])) {
			    try {
			    	for ($i = 0; $i <  count($_FILES['file']['name']); $i++) {
			    		\Urania::uploadImage($_FILES['file']['name'][$i], $_FILES['file']['tmp_name'][$i], $_POST['albumId']);
			    	}
			    	$this->notification = new \Model\Notification('Image(s) successfully uploaded', 'success');
			    }
			    catch (\exception $exception) {
			        $this->notification = new \Model\Notification('Could not upload image: ' . $exception->getMessage(), 'error');
			    }
				
			}
			elseif (isset($_POST['changeName'])) {
				//Change the name of the image
				try {
				    \Urania::changeImageName(intval($_POST['changeImage']), stripslashes($_POST['changeName']));
				    $this->notification = new \Model\Notification('Name of image successfully changed', 'success');
				}
				catch (\exception $exception) {
				    $this->notification = new \Model\Notification('Could not change image name: ' . $exception->getMessage(), 'error');
				}
			}
			
		
			$this->album = \Urania::getAlbum($this->album->getId()); //Update album after post
		
		}
		
		
		public function editDescription() {
			
			if(!isset($_POST['description'])) {
				return;
			}
			else {
				
				//Update description
				$description = $_POST['description'];
				\Database\Album::changeAlbumDescription($this->album->getId(), $description);
				
			}
			
		}
		
	
	}
	

}

?>