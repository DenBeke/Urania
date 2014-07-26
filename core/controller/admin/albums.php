<?php
/*
Controller for the Admin Single Album page

Author: Mathias Beke
Url: http://denbeke.be
Date: March 2014
*/


namespace Controller\Admin {
	
	
	class Albums extends \Controller\Controller {
	
	
		public $pageName = 'albums';
		public $albums = array();
		public $notification = NULL;
	
	
		public function __construct() {
			parent::__construct();
			$this->themeDir = __DIR__ . '/../../../admin/theme/';
			$this->theme = 'albums.php';
			$this->pageTitle = 'Albums - ' . SITE_TITLE;
					
			foreach ($this->urania->getAllAlbums() as $album) {
				$this->albums[] = $this->urania->getAlbum($album->getId());
			}
		}
		

		
		public function POST() {
		
			if(isset($_POST['albumName'])) {
				try {
				    $this->urania->addAlbum(stripslashes($_POST['albumName']));
				    $this->notification = new \Model\Notification('Added album: ' . $_POST['albumName'], 'success');
				}
				catch (\exception $exception) {
				    $this->notification = new \Model\Notification('Could not add album: ' . $exception->getMessage(), 'error');
				}
			}
			elseif (isset($_POST['albumId'])) {
				try {
			    	for ($i = 0; $i <  count($_FILES['file']['name']); $i++) {
			    		$this->urania->uploadImage($_FILES['file']['name'][$i], $_FILES['file']['tmp_name'][$i], $_POST['albumId']);
			    	}
			    	$this->notification = new \Model\Notification('Image(s) successfully uploaded', 'success');
			    }
			    catch (\exception $exception) {
			        $this->notification = new \Model\Notification('Could not upload image: ' . $exception->getMessage(), 'error');
			    }
					
			}
			elseif (isset($_POST['deleteAlbum'])) {
			    try {
				    $this->urania->deleteAlbum(intval($_POST['deleteAlbum']));
				    $this->notification = new \Model\Notification('Album successfully deleted', 'success');
				}
				catch (\exception $exception) {
				    $this->notification = new \Model\Notification('Could not delete album: ' . $exception->getMessage(), 'error');
				}
			}
			elseif (isset($_POST['changeName'])) {
				//Change the name of the image
				try {
			    	$this->urania->changeAlbumName(intval($_POST['changeAlbumId']), stripslashes($_POST['changeName']));
			    	$this->notification = new \Model\Notification('Name of album successfully changed', 'success');
			    }
			    catch (\exception $exception) {
			        $this->notification = new \Model\Notification('Could not change album name: ' . $exception->getMessage(), 'error');
			    }
			}
			
			$this->albums = $this->urania->getAllAlbums(); //Update albums after POST
		
		}
		
	}
	
	

}

?>
