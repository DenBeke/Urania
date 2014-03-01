<?php 
/*
Simple CMS for image galleries

Author: Mathias Beke
Url: http://denbeke.be
Date: September 2013
*/

require_once(dirname(__FILE__).'/error_handler.php');
require_once(dirname(__FILE__).'/model/album.php');
require_once(dirname(__FILE__).'/model/image.php');
require_once(dirname(__FILE__).'/model/imageExif.php');
require_once(dirname(__FILE__).'/database.php');



/**
@brief Class for the Urania CMS core functions

This class takes care of:
- database access
- file management of uploads
- ...
*/
class Urania {
    
    private $debug = false;
    private $database;
    private $db_table_albums;
    private $db_table_images;
    private $uploadDir;
    private $siteTitle;
    private $siteUrl;
    private $copyright;
    
    /**
    Constructor
    
    @param path to config file
    */
    public function __construct() {
        $this->db_table_albums = DB_TABLE_ALBUMS;
        $this->db_table_images = DB_TABLE_IMAGES;
        $this->database = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE, dirname(__FILE__).'/../cache/');
        $this->uploadDir = UPLOAD_DIR;
        $this->siteTitle = SITE_TITLE;
        $this->siteUrl = SITE_URL;
        $this->copyright = COPYRIGHT;
    }
     
    
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
    
	        //Create query
	        $albums = $this->database->escape($this->db_table_albums);
	        $albumName = $this->database->escape($albumName);
	        $date = time();
	        
	        $query = 
	        "
	        INSERT INTO  `$albums` (
	        `id` ,
	        `name` ,
	        `date`
	        )
	        VALUES (
	        NULL ,  '$albumName',  '$date'
	        );
	        ";
	        
	        $affectedRows = $this->database->doQuery($query);
	        
	        //Debug
	        if($this->debug) {
	            echo "$affectedRows affected rows with query<br>$query";
	        }
	        
	        //Add new directory to the upload folder
	        mkdir($this->uploadDir . '/' . $this->simplifyFileName($albumName));
	        
	    }
        
    }
    
    
    /**
    Add the given image to the database
    
    @param image
    */
    public function addImage($image) {
    
        //Escape strings
        $fileName = $this->database->escape($image->getFileName());
        $name = $this->database->escape($image->getName());
        $date = $this->database->escape($image->getDate());
        $albumId = $this->database->escape($image->getAlbumId());
    
        $query = 
        "
        INSERT INTO  `Images` (
        `id` ,
        `fileName` ,
        `name` ,
        `date` ,
        `albumId`
        )
        VALUES (
        NULL ,  '$fileName',  '$name',  '$date',  '$albumId'
        );
        ";
        
        $affectedRows = $this->database->doQuery($query);
        
        if($this->debug) {
            echo "$affectedRows affected rows with query<br>$query";
        }
    
    }
    
    
    /**
    Get a list of all albums
    
    @return albums (with only the latest image included)
    */
    public function getAllAlbums() {
        
        //Create query
        $albums = $this->database->escape($this->db_table_albums);
    
        $query = 
        "
        SELECT * 
        FROM  `$albums` 
        ORDER BY  `Albums`.`date` DESC 
        ";
        
        $result = $this->database->getQuery($query);
        
        //Debug           
        if($this->debug) {
            echo $query;
        }
        
        $albums = array();
        
        foreach ($result as $row => $album) {
            $albums[] = new Album($album['id'], $album['name'], $album['date']);
        }
        foreach ($albums as $album) {
        	$album->addImage($this->getLatestImage($album->getId()));
        }
        
        return $albums;
        
    }
    
    
    
    /**
    Get the album with the given id
    
    @param id
    @return album
    
    @pre id exists
    */
    public function getAlbum($id) {
        if(!$this->albumExists($id)) {
            throw new Exception("There is no album with the id $id");
        }
        else {
            
            //Get all images from the album
            $images = $this->getImagesFromAlbum($id);
        
        
            //Get album information
            //Create query
            $albums = $this->database->escape($this->db_table_albums);
            $id = $this->database->escape($id);
            
            $query = 
            "
            SELECT * 
            FROM  `$albums` 
            WHERE id = $id
            ";
            
            //Debug
            if($this->debug) {
                echo $query;
            }
            
            //Fetch query
            $result = $this->database->getQuery($query);
            $album = new Album($result[0]['id'], $result[0]['name'], $result[0]['date']);
            
            foreach ($images as $image) {
                $album->addImage($image);
            }
            
            return $album;
            
        }
    }
    
    
    /**
    Get the image with the given id
    
    @param id
    @return image
    
    @pre image exists
    */
    public function getImage($id) {
        if(!$this->imageExists($id)) {
            throw new Exception("There is no image with the id $id");
        }
        else {
            
            //Create query
            $images = $this->database->escape($this->db_table_images);
            $id = $this->database->escape($id);
            
            $query = 
            "
            SELECT * 
            FROM  `$images` 
            WHERE id = $id
            ";
            
            //Debug
            if($this->debug) {
                echo $query;
            }
            
            //Fetch query
            $result = $this->database->getQuery($query);
            $image = new Image($result[0]['id'], $this->uploadDir . $this->simplifyFileName($this->getAlbumName($result[0]['albumId'])) . '/' . $result[0]['fileName'], $result[0]['name'], $result[0]['date'], $result[0]['albumId']);
            
            return $image;
        }
    }
    
    
    
    /**
    Returns the latest images
    
    @param count
    @return array of images
    
    @pre count is greater than, or equal to zero
    */
    public function getLatestImages($count) {
    
    	if(intval($count) < 1) {
    		throw new Exception("Number of images must be at least 1");
    	}
    	else {
    		
    		//Create query
    		$count = $this->database->escape($count);
    		$images = $this->database->escape($this->db_table_images);
    		
    		$query = 
    		"
    		SELECT *
    		FROM `$images`
    		ORDER BY `date` DESC
    		LIMIT 0, $count
    		";
    		
    		$result = $this->database->getQuery($query);
    		$outputArray = array();
    		
    		for($i = 0; $i < sizeof($result); $i++) {
    		
    			$outputArray[] = new Image($result[$i]['id'], $this->uploadDir . $this->simplifyFileName($this->getAlbumName($result[$i]['albumId'])) . '/' . $result[$i]['fileName'], $result[$i]['name'], $result[$i]['date'], $result[$i]['albumId']);
    		
    		}
    		
    		return $outputArray;
    		
    	}
    
    }
    
    
    
    
    /**
    Change the name of the image in the database
    
    @param image id
    @param new image name
    
    @pre image exists
    @pre new image name not empty
    */
    public function changeImageName($id, $imageName) {
        if(!$this->imageExists($id)) {
            throw new Exception("There is no image with the id $id");
        }
        elseif ($imageName == '') {
            throw new Exception('Image name cannot be empty');
        }
        else {
            //Create query from image
            $id = $this->database->escape($id);
            $name = $this->database->escape($imageName);
            $images = $this->database->escape($this->db_table_images);
            
            $query = 
            "
            UPDATE  `$images` SET
            `name` =  '$name'
            WHERE `id` = $id
            ";
            
            $affectedRows = $this->database->doQuery($query);
            
            //Debug
            if($this->debug) {
                echo "$affectedRows affected rows with query<br>$query";
            }
            
        }
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
        
            //Create query from image to change the info in the database
            $id = $this->database->escape($id);
            $name = $this->database->escape($albumName);
            $albums = $this->database->escape($this->db_table_albums);
            
            $query = 
            "
            UPDATE  `$albums` SET `name` =  '$name'
            WHERE  `$albums`.`id` = $id;
            ";
            
            $affectedRows = $this->database->doQuery($query);
            
            //Debug
            if($this->debug) {
                echo "$affectedRows affected rows with query<br>$query";
            }

            rename($this->uploadDir . $this->simplifyFileName($oldAlbum), $this->uploadDir . $this->simplifyFileName($albumName));
            
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
            //Find image
            //Create query
            $images = $this->database->escape($this->db_table_images);
            $id = $this->database->escape($id);
            
            $query = 
            "
            SELECT * 
            FROM  `$images` 
            WHERE  `id` = $id
            LIMIT 0 , 30
            ";
            
            //DEBUG
            if($this->debug) {
                echo $query;
            }
            
            //Fetch query
            $result = $this->database->getQuery($query);
            $image = new Image($result[0]['id'], $result[0]['fileName'], $result[0]['name'], $result[0]['date'], $result[0]['albumId']);
            
            unlink($this->uploadDir . $this->simplifyFileName($this->getAlbumName($image->getAlbumId())) . '/' . $image->getFileName());
            
            //Delete image in the database
            $query = "DELETE FROM `$images` WHERE `$images`.`id` = $id";
            $this->database->doQuery($query);
            
           
            //Debug           
            if($this->debug) {
                echo $query;
            }
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
            $id = $this->database->escape($id);
            $albums = $this->database->escape($this->db_table_albums);
            $query = "DELETE FROM `$albums` WHERE `$albums`.`id` = $id";
            $this->database->doQuery($query);
            
            //Delete album directory
            $dir = opendir($this->uploadDir . $this->simplifyFileName($album->getName()));
            //do whatever you need
            closedir($dir);
            rmdir($this->uploadDir . $this->simplifyFileName($album->getName()));
        }
    }
    
    
    
    private function albumExists($id) {
        
        //Create query
        $albums = $this->database->escape($this->db_table_albums);
        $id = $this->database->escape($id);
        
        $query = 
        "
        SELECT * 
        FROM  `$albums` 
        WHERE  `id` = $id
        LIMIT 0 , 30
        ";
    
        //DEBUG
        if($this->debug) {
            echo $query;
        }
        
        //Fetch query
        $result = $this->database->getQuery($query);
        
        //Check if there is a result (album)
        if(sizeof($result) > 0) {
            return true;
        }
        else {
            return false;
        }
        
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
    	if ($info === FALSE) {
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
    	move_uploaded_file($tempFile, $this->uploadDir . $albumName . '/' . $fileName);
    	
    	//Get image date from efix date
    	//If it couldn't read the efix date, the current time will be used
    	try {
	    	if(function_exists("exif_read_data") && exif_read_data($this->uploadDir . $albumName . '/' . $fileName)){ 
				$efix = exif_read_data($this->uploadDir . $albumName . '/' . $fileName);
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
    	$image = new Image(0, $fileName, $imageTitle, $imageDate, $albumId);
    	$this->addImage($image);
    	
    	
    }
    
    
    
    
    /**
    Get the name of the album with the given id
    
    @param id
    @return album  name
    @pre albume exists
    */
    private function getAlbumName($id) {
    	if(!$this->albumExists($id)) {
    	    throw new Exception("There is no album with the id $id");
    	}
    	else {
    	
 
    	    //Create query
    	    $albums = $this->database->escape($this->db_table_albums);
    	    $id = $this->database->escape($id);
    	    
    	    $query = 
    	    "
    	    SELECT * 
    	    FROM  `$albums` 
    	    WHERE id = $id
    	    ";
    	    
    	    //Debug
    	    if($this->debug) {
    	        echo $query;
    	    }
    	    
    	    //Fetch query
    	    $result = $this->database->getQuery($query);
    	    $album = new Album($result[0]['id'], $result[0]['name'], $result[0]['date']);
    	    
    	    return $album->getName();
    	    
    	}
    	
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
    	return file_exists($this->uploadDir . $fileName);
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
        
        //Create query
        $images = $this->database->escape($this->db_table_images);
        $id = $this->database->escape($id);
        
        $query = 
        "
        SELECT * 
        FROM  `$images` 
        WHERE  `id` = $id
        LIMIT 0 , 30
        ";
        
        //DEBUG
        if($this->debug) {
            echo $query;
        }
        
        //Fetch query
        $result = $this->database->getQuery($query);
        
        //Check if there is a result (album)
        if(sizeof($result) > 0) {
            return true;
        }
        else {
            return false;
        }
        
    }
    
    
    /**
    Check if the album with the given id exists
    
    @param id
    @return exists
    */
    private function albumNameExists($albumName) {
    	//Create query
    	$albums = $this->database->escape($this->db_table_albums);
    	$albumName = $this->database->escape($albumName);
    	
    	$query = 
    	"
    	SELECT * 
    	FROM  `$albums` 
    	WHERE  `name` = '$albumName'
    	LIMIT 0 , 30
    	";
    	
    	//DEBUG
    	if($this->debug) {
    	    echo $query;
    	}
    	
    	//Fetch query
    	$result = $this->database->getQuery($query);
    	
    	//Check if there is a result (album)
    	if(sizeof($result) > 0) {
    	    return true;
    	}
    	else {
    	    return false;
    	}
    	
    }
    
    
    private function getImagesFromAlbum($albumId) {
        
        //Create query
        $images = $this->database->escape($this->db_table_images);
        $albumId = $this->database->escape($albumId);
        
        $query = 
        "
        SELECT * 
        FROM  `$images` 
        WHERE  `albumId` = $albumId
        ORDER BY  `$images`.`date` DESC
        ";
        
        //DEBUG
        if($this->debug) {
            echo $query;
        }
        
        //Fetch query
        $result = $this->database->getQuery($query);
        
        //Create images from result
        $images = array();
        
        foreach ($result as $row => $image) {
            $images[] = new Image($image['id'], $this->uploadDir . $this->simplifyFileName($this->getAlbumName($albumId)) . '/' . $image['fileName'], $image['name'], $image['date'], $image['albumId']);
        }
        
        return $images;
    }
    
    
    
    /**
    Get the latest image from the album with the given id
    
    @param album id
    @return image
    
    @pre album exists
    */
    private function getLatestImage($id) {
        if(!$this->albumExists($id)) {
            throw new Exception("There is no album with the id $id");
        }
        else {
            
            //Create query
            $images = $this->database->escape($this->db_table_images);
            $id = $this->database->escape($id);
            
            $query = 
            "
            SELECT * 
            FROM  `$images` 
            WHERE albumId = $id
            ORDER BY  `$images`.`date` DESC 
            LIMIT 0,1
            ";
            
            //Debug
            if($this->debug) {
                echo $query;
            }
            
            //Fetch query
            $result = $this->database->getQuery($query);
            if(!$result) {
                $image = new Image(0, 'notfound.jpg', 'error', 0, $id);
                return $image;
            }
            else {
                $image = new Image($result[0]['id'], $this->uploadDir . $this->simplifyFileName($this->getAlbumName($id)) . '/' . $result[0]['fileName'], $result[0]['name'], $result[0]['date'], $result[0]['albumId']);
                 return $image;
            }
        
        }
    }
}



?>