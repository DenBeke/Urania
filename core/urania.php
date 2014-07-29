<?php 
/*
Simple CMS for image galleries

Author: Mathias Beke
Url: http://denbeke.be
Date: September 2013
*/

require_once( __DIR__ . '/error_handler.php');
require_once( __DIR__ . '/database.php');



/**
@brief Class for the Urania CMS core functions

This class takes care of:
- database access
- file management of uploads
- ...
*/
class Urania {
    
    private $debug = false;
     
    
    /**
    Add a new photo album to the database with the given name
    @param name
    @pre there is no album with the given name
    @pre album name cannot be empty
    */
    public function addAlbum($albumName) {
    
	    	if($this->albumNameExists($albumName)) {
	    		throw new Exception("There is already an album with the name '$albumName'");
	    	}
	    	if($albumName == '') {
	    		throw new Exception("Album name cannot be empty");
	    	}
	    	else {

			//Insert album in database        
	        Database\Album::addAlbum($albumName, time());
	        
	        //Add new directory to the upload folder
	        mkdir( __DIR__ . '/../' . UPLOAD_DIR . '/' . $this->simplifyFileName($albumName));
	        
	    }
        
    }
    
    
    /**
    Add the given image to the database
    
    @param image
    */
    public function addImage($image) {
    
        \Database\Image::addImage($image);
    
    }
    
    
    /**
    Get a list of all albums
    
    @return albums (with only the latest image included)
    */
    public function getAllAlbums() {
        
    		return Database\Album::getAllAlbums();
        
    }
    
    
    
    /**
    Get the album with the given id
    
    @param id
    @return album
    
    @pre id exists
    */
    public function getAlbum($id) {
        
        return Database\Album::getAlbum($id);
        
    }
    
    
    /**
    Get the image with the given id
    
    @param id
    @return image
    
    @pre image exists
    */
    public function getImage($id) {
        
        return Database\Image::getImageById($id);
        
    }
    
    
    
    /**
    Returns the latest images
    
    @param count
    @return array of images
    
    @pre count is greater than, or equal to zero
    */
    public function getLatestImages($count) {
    
	    	return Database\Image::getLatestImages($count);
    
    }
    
    
    
    
    /**
    Change the name of the image in the database
    
    @param image id
    @param new image name
    
    @pre image exists
    @pre new image name not empty
    */
    public function changeImageName($id, $imageName) {
            
    		Database\Image::changeImageName($id, $imageName);
            

    }
    
    
    /**
    Change update the information of the given album in the database
    
    @param album
    @param new album name
    
    @pre album exists
    @pre there is no album with the new name
    @pre new album name not empty
    */
    public function changeAlbumName($id, $albumName) {
        if(!$this->albumExists($id)) {
            throw new Exception("There is no album with the id $id");
        }
        elseif($this->albumNameExists($albumName)) {
        		throw new Exception("There is already an album with the new name '$albumName'");
        }
        elseif($albumName == '') {
        		throw new Exception("Album name cannot be empty");
        }
        else {
	        	//Get the old album name
	        	$oldAlbum = $this->getAlbumName($id);
	        	
	        	//Check if name is not the same, if so, we can return immediately
	        	if ($oldAlbum == $albumName) {
	        		return;
	        	}
        
            Database\Album::changeAlbumName($id, $albumName);

            rename( __DIR__ . '/../' . UPLOAD_DIR . '/' . $this->simplifyFileName($oldAlbum), __DIR__ . '/../' . UPLOAD_DIR . '/' . $this->simplifyFileName($albumName));
            
        }
    }
    
    
    
    /**
    Delete the image with the given id
    
    @param id   
    @pre image exists
    */
    public function deleteImage($id) {
        if(!$this->imageExists($id)) {
            throw new Exception("There is no image with the id $id");
        }
        else {
            
            //Get image from database
            $image = Database\Image::getImageById($id);
      
            //Delete file
            unlink( __DIR__ . '/../' . $image->getFileName() );
            
            //Delete image from database
            Database\Image::deleteImage($id);
            
        }
    }
    
    
    
    /**
    Delete the album with the given id
    
    @param id   
    @pre album exists
    */
    public function deleteAlbum($id) {
        if(!$this->albumExists($id)) {
            throw new Exception("There is no album with the id $id");
        }
        else {
            //Get the album
            $album = $this->getAlbum($id);
            
            //Delete all images
            for ($i = 0; $i < $album->getNumberOfImages(); $i++) {
            		$this->deleteImage($album->getImage($i)->getId());
            }
           
            //Delete album in the database
            \Database\Album::delete($id);
            
            //Delete album directory
            $dir = opendir( __DIR__ . '/../' . UPLOAD_DIR . '/' . $this->simplifyFileName($album->getName()));
            //do whatever you need
            closedir($dir);
            rmdir( __DIR__ . '/../' . UPLOAD_DIR . '/' . $this->simplifyFileName($album->getName()));
        }
    }
    
    
    
    private function albumExists($id) {
        
        return Database\Album::albumExists($id);       
    }
    
    
    
    
    /**
    Upload image to the server and add the info to the database
    
    @param image name (with extension)
    @param temp file location
    @param album id
    
    @pre Album with given albumId exists
    */
    public function uploadImage($imageName, $tempFile, $albumId) {
	    	//Check if upload file is image
	    	$info = getimagesize($tempFile);
	    	if ($info == FALSE) {
	    	   throw new exception('File is not of type image');
	    	}
	    	
	    	/* 
	    	Store
	    	- image name (without extension)
	    	- date
	    	- album name
	    	*/
	    	$imageTitle = $this->removeExtension($imageName);
	    	$albumName = $this->simplifyFileName($this->getAlbumName($albumId));
	    	$imageDate = time();
	    	
	    	//Get the filename of the image
	    	$fileName = $this->simplifyFileName($imageName);
	
			//Check if this file name is unique
			//If it exists, we add a suffix to it and check again if it's unique    	
	    	if($this->fileNameExists($fileName)) {
	    		$suffix = 2;
	    		while ($this->fileNameExists($this->addSuffix($fileName, "-" . $suffix))) {
	    			$suffix++;
	    		}
	    		$fileName = $this->addSuffix($fileName, "-" . $suffix);
	    	}
	    	
	    	//Upload the file
	    	move_uploaded_file($tempFile, __DIR__ . '/../' . UPLOAD_DIR . '/' . $albumName . '/' . $fileName);
	    	
	    	//Get image date from efix date
	    	//If it couldn't read the efix date, the current time will be used
	    	try {
		    	if(function_exists("exif_read_data") && exif_read_data( __DIR__ . '/../' . UPLOAD_DIR . '/' . $albumName . '/' . $fileName)){ 
					$efix = exif_read_data( __DIR__ . '/../' . UPLOAD_DIR . '/' . $albumName . '/' . $fileName);
					$imageDate = strtotime($efix['DateTimeOriginal']);
					if ($imageDate == 0) {
						$imageDate = time();
					}	
		    	}
		    }
		    catch (exception $exception) {
		    	$imageDate = time();
		    }
	    	
	    	//Insert the image in the database
	    	$image = new \Model\Image(0, $fileName, $imageTitle, $imageDate, $albumId);
	    	$this->addImage($image);
    	
    	
    }
    
    
    
    
    /**
    Get the name of the album with the given id
    
    @param id
    @return album  name
    @pre albume exists
    */
    private function getAlbumName($id) {
    
    		return Database\Album::getAlbumName($id);
        	
    }
    
    
    
    /**
    Remove the extention from a file name
    
    @param file name
    @return string
    */
    private static function removeExtension($fileName) {
		$dotIndex = 0;
		for ($i = strlen($fileName)-1; $i > 0; $i--) {
			if($fileName[$i] == '.'){
				$dotIndex = $i;
				break;
			}
		}
		return substr($fileName, 0, $dotIndex);
    }
    
    
    
    /**
    Simplify a file name to store the file on the disk
    
    @param file name
    @return string
    */
    public static function simplifyFileName($fileName) {
	    	$table = array(
	    	    'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a',
	    	    'ă' => 'a', 'ā' => 'a', 'ą' => 'a', 'æ' => 'a', 'ǽ' => 'a', 'þ' => 'b',
	    	    'ç' => 'c', 'č' => 'c', 'ć' => 'c', 'ĉ' => 'c', 'ċ' => 'c', 'ż' => 'z',
	    	    'đ' => 'd', 'ď' => 'd', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e',
	    	    'ĕ' => 'e', 'ē' => 'e', 'ę' => 'e', 'ė' => 'e', 'ĝ' => 'g', 'ğ' => 'g',
	    	    'ġ' => 'g', 'ģ' => 'g', 'ĥ' => 'h', 'ħ' => 'h', 'ì' => 'i', 'í' => 'i',
	    	    'î' => 'i', 'ï' => 'i', 'į' => 'i', 'ĩ' => 'i', 'ī' => 'i', 'ĭ' => 'i',
	    	    'ı' => 'i', 'ĵ' => 'j', 'ķ' => 'k', 'ĸ' => 'k', 'ĺ' => 'l', 'ļ' => 'l',
	    	    'ľ' => 'l', 'ŀ' => 'l', 'ł' => 'l', 'ñ' => 'n', 'ń' => 'n', 'ň' => 'n',
	    	    'ņ' => 'n', 'ŋ' => 'n', 'ŉ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o',
	    	    'õ' => 'o', 'ö' => 'o', 'ø' => 'o', 'ō' => 'o', 'ŏ' => 'o', 'ő' => 'o',
	    	    'œ' => 'o', 'ð' => 'o', 'ŕ' => 'r', 'ř' => 'r', 'ŗ' => 'r', 'š' => 's',
	    	    'ŝ' => 's', 'ś' => 's', 'ş' => 's', 'ŧ' => 't', 'ţ' => 't', 'ť' => 't',
	    	    'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ũ' => 'u', 'ū' => 'u',
	    	    'ŭ' => 'u', 'ů' => 'u', 'ű' => 'u', 'ų' => 'u', 'ŵ' => 'w', 'ẁ' => 'w',
	    	    'ẃ' => 'w', 'ẅ' => 'w', 'ý' => 'y', 'ÿ' => 'y', 'ŷ' => 'y', 'ž' => 'z',
	    	    'ź' => 'z',
	    	);
	    	
	    	// We don't deal with uppercase characters
	    	$fileName = strtolower($fileName);
	    	
	    	// Strip accents
	    	$fileName = strtr($fileName, $table);
	    	
	    	// Non-alphanumericals characters become spaces
	    	$fileName = preg_replace('/[^a-z0-9.]/', ' ', $fileName);
	    	
	    	// Remove trailing and ending spaces
	    	$fileName = trim($fileName);
	    	
	    	// Spaces become -
	    	$fileName = preg_replace('#\s+#', '-', $fileName);
	    	
	    	return $fileName;
    }
    
    
    
    /**
    Check if the image with the given file name exists in the upload folder
    
    @param file name
    @return true/false
    */
    private function fileNameExists($fileName) {
	    
    		return file_exists( __DIR__ . '/../' . UPLOAD_DIR . '/' . $fileName);
    		
    }
    
    
    /**
    Adds a suffix after the file name, but before the extension
    
    @param file name
    @param suffix
    @return string
    */
    private static function addSuffix($fileName, $suffix) {
	    	$dotIndex = 0;
	    	for ($i = strlen($fileName)-1; $i > 0; $i--) {
	    		if($fileName[$i] == '.'){
	    			$dotIndex = $i;
	    			break;
	    		}
	    	}
	    	$baseName = substr($fileName, 0, $dotIndex);
	    	$extension = substr($fileName, $dotIndex);
	    	return $baseName . $suffix . $extension;
    }
    
    
    
    /**
    Check if the image with the given id exists
    
    @param id
    @return exists
    */
    private function imageExists($id) {
        
        return Database\Image::imageExists($id);
        
    }
    
    
    /**
    Check if the album with the given id exists
    
    @param id
    @return exists
    */
    private function albumNameExists($albumName) {
	    	
	    return Database\Album::albumNameExists($albumName);
    	
    }
    
    
    private function getImagesFromAlbum($albumId) {
        
        return Database\Album::getImagesFromAlbum($albumId);
        
    }
    
    
    
    /**
    Get the latest image from the album with the given id
    
    @param album id
    @return image
    
    @pre album exists
    */
    private function getLatestImage($id) {
        
        return Database\Image::getLatestImage($id);
        
    }

}



?>