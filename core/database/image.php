<?php 
/*
Image Database Controller

Author: Mathias Beke
Url: http://denbeke.be
Date: June 2014
*/

namespace Database;

require_once(__DIR__ . '/../model/image.php');


/**
Image Database Controller
*/
class Image {


	const IMAGES = 'Images';


	/**
	Check if the image with the given id exists
	
	@param id
	@return image exist (true/false)
	*/
	static public function imageExists($id) {
	
		$query = BUILDER::table(self::IMAGES)->where('id', '=', $id);
		$count = $query->count();
		
		if($count == 1) {
			return true;
		}
		else {
			return false;
		}
	
	}



	/**
	Get the image with the given id
	
	@param id
	@return image
	@pre There exists an image with the given ID.
	*/
	static public function getImageById($id) {
		
		$query = BUILDER::table(self::IMAGES)->where('id', '=', $id);
		$result = $query->get();
		
		if(sizeof($result) != 1) {
			throw new \exception("Could not find image with the given id($id)");
		}
		else {
			return Image::resultToImage($result)[0];	
		}
		
	}
	
	
	
	/**
	Get the images from the album with the given id
	
	@param album id
	@return images
	*/
	static public function getImagesFromAlbum($albumId) {
		
		$query = BUILDER::table(self::IMAGES)->where('albumId', '=', $albumId);
		$result = $query->get();
		
		return Image::resultToImage($result);
		
	}
	
	
	
	
	/**
	Get the latest image from the album with the given id
	
	@param album id
	@return image
	
	@pre album exists
	*/
	static public function getLatestImage($albumId) {
		
		$query = BUILDER::table(self::IMAGES)->where('albumId', '=', $albumId)->orderBy('date', 'DESC')->limit(1);
		$result = $query->get();
		
		if(sizeof($result) != 1) {
			throw new \exception("Could not find latest image of album with the given albumId($albumId)");
		}
		else {
			return Image::resultToImage($result)[0];	
		}
		
	}
	
	
	
	/**
	Delete the image with the given id
	
	@param id
	*/
	static public function deleteImage($id) {
	
		$query = BUILDER::table(self::IMAGES)->where('id', '=', $id);
		$result = $query->delete();
	
	}
	
	
	/**
	Delete all images of the given album
	
	@param album id
	*/
	static public function deleteImagesFromAlbum($albumId) {
		
		$query = BUILDER::table(self::IMAGES)->where('albumId', '=', $albumId);
		$result = $query->delete();
		
	}
	
	
	/**
	Add the given (new) image to the database
	
	@param image
	*/
	static public function addImage($image) {
	
		$data = array(
			'name' => $image->getName(),
			'fileName' => $image->getFileName(),
			'date' => $image->getDate(),
			'albumId' => $image->getAlbumId()
		);
		
		$insertId = BUILDER::table(self::IMAGES)->insert($data);
		
		return $insertId;

	
	}
	
	
	
	/**
	Change the name of the image in the database
	
	@param image id
	@param new image name
	
	@pre image exists
	@pre new image name not empty
	*/
	static public function changeImageName($id, $imageName) {
		if(!self::imageExists($id)) {
			throw new Exception("There is no image with the id $id");
		}
		elseif ($imageName == '') {
			throw new Exception('Image name cannot be empty');
		}
		else {
			
			$data = array(
				'name' => $imageName
			);
			
			BUILDER::table(self::IMAGES)->where('id', '=', $id)->update($data);
			
		}
	}
	
	
	
	
	/**
	Convert the database result to an instance of Image
	
	@param result
	@return Image
	*/
	static private function resultToImage($result) {
		
		$output = [];
		
		foreach ($result as $image) {
			
			$id = intval($image->id);
			$albumId = intval($image->albumId);
			$fileName = $image->fileName;
			$fileName = UPLOAD_DIR . simplifyFileName( Album::getAlbumName($albumId) ) . '/' . $fileName;
			$name = $image->name;
			$date = intval($image->date);
			
			$output[] = new \Model\Image($id, $fileName, $name, $date, $albumId);
		}
		
		return $output;
		
	}
	
}



?>