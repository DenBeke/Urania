<?php 
/*
Image Database Controller

Author: Mathias Beke
Url: http://denbeke.be
Date: June 2014
*/

namespace Database;

require_once(__DIR__ . '/../model/album.php');


/**
Image Database Controller
*/
class Album {

	const ALBUM = 'Albums';

		
	/**
	Check if the album with the given id exists
	
	@param id
	@return exists
	*/
	static public function albumNameExists($name) {
		
		$query = BUILDER::table(self::ALBUM)->where('name', '=', $name);
		$count = $query->count();
		
		if($count >= 1) {
			return true;
		}
		else {
			return false;
		}
		
	}
	
	
	
	/**
	Add a new photo album to the database with the given name
	@param name
	@pre there is no album with the given name
	@pre album name cannot be empty
	*/
	static public function addAlbum($albumName) {
		
		if(self::albumNameExists($albumName)) {
			
			throw new Exception("There is already an album with the name '$albumName'");
		
		}
		if($albumName == '') {
			
			throw new Exception("Album name cannot be empty");
			
		}
		else {
		
			//TODO!!!
		
		}
		
	}
	
	
	/**
	Get a list of all albums
	
	@return albums (with only the latest image included)
	*/
	static public function getAllAlbums() {
		
		//Get all albums		
		$query = BUILDER::table(self::ALBUM)->select('*')->orderBy('date', 'DESC');
		$result = $query->get();
		
		$albums = self::resultToAlbum($result);
		
		//Add the latest image to each album
		foreach ($albums as $album) {
			$album->addImage(Image::getLatestImage($album->getId()));
		}
		
		return $albums;
		
	}
	
	
	
	
	
	/**
	Convert the database result to an instance of Album

	@param result
	@return Album
	*/
	static private function resultToAlbum($result) {

		$output = [];

		foreach ($result as $album) {

			$id = intval($album->id);
			$name = $album->name;
			$date = intval($album->date);

			$output[] = new \Album($id, $name, $date);
		}

		return $output;

	}

}



?>