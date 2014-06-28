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
	public function getImagesFromAlbum($albumId) {
		
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
	Convert the database result to an instance of Image
	
	@param result
	@return Image
	*/
	static private function resultToImage($result) {
		
		$output = [];
		
		foreach ($result as $image) {
			
			$id = intval($image->id);
			$fileName = $image->fileName;
			$name = $image->name;
			$date = intval($image->date);
			$albumId = intval($image->albumId);
			
			$output[] = new \Image($id, $fileName, $name, $date, $albumId);
		}
		
		return $output;
		
	}
	
}



?>