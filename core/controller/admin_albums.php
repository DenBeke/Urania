<?php
/*
Controller for the Admin Single Album page

Author: Mathias Beke
Url: http://denbeke.be
Date: March 2014
*/


namespace Controller\Admin {

	
	require_once(dirname(__FILE__) . '/controller.php');
	
	
	class Albums extends \Controller\Controller {
	
	
		public $pageName = 'albums';
		public $albums;
		public $notification = NULL;
	
	
		public function __construct() {
			parent::__construct();
			$this->themeDir = dirname(__FILE__) . '/../../admin/theme/';
			$this->theme = 'albums.php';
			$this->pageTitle = 'Album - ' . SITE_TITLE;
			$this->albums = $this->urania->getAllAlbums();
		}
		

		
		public function POST() {
		
			if(isset($_POST['albumName'])) {
				try {
				    $this->urania->addAlbum(stripslashes($_POST['albumName']));
				    $this->notification = new \Notification('Added album: ' . $_POST['albumName'], 'success');
				}
				catch (\exception $exception) {
				    $this->notification = new \Notification('Could not add album: ' . $exception->getMessage(), 'error');
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
			elseif (isset($_POST['deleteAlbum'])) {
			    try {
				    $this->urania->deleteAlbum(intval($_POST['deleteAlbum']));
				    $this->notification = new \Notification('Album successfully deleted', 'success');
				}
				catch (\exception $exception) {
				    $this->notification = new \Notification('Could not delete album: ' . $exception->getMessage(), 'error');
				}
			}
			elseif (isset($_POST['changeName'])) {
				//Change the name of the image
				try {
			    	$this->urania->changeAlbumName(intval($_POST['changeAlbumId']), stripslashes($_POST['changeName']));
			    	$this->notification = new \Notification('Name of album successfully changed', 'success');
			    }
			    catch (\exception $exception) {
			        $this->notification = new \Notification('Could not change album name: ' . $exception->getMessage(), 'error');
			    }
			}
			
			$this->albums = $this->urania->getAllAlbums(); //Update albums after POST
		
		}
		
	}
	
	

}

?>
