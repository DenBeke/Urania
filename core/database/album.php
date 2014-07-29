<?php 
/*
Image Database Controller

Author: Mathias Beke
Url: http://denbeke.be
Date: June 2014
*/

namespace Database;


/**
Image Database Controller
*/
class Album {

	const ALBUMS = 'Albums';

		
	/**
	Check if the album with the given id exists
	
	@param id
	@return exists
	*/
	static public function albumNameExists($name) {
		
		$query = BUILDER::table(self::ALBUMS)->where('name', '=', $name);
		$count = $query->count();
		
		if($count >= 1) {
			return true;
		}
		else {
			return false;
		}
		
	}
	
	
	/**
	Check if the album with the given id exists
	
	@param id
	@return exists(true) or not(false)
	*/
	static public function albumExists($id) {
	
		$query = BUILDER::table(self::ALBUMS)->where('id', '=', $id);
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
 	@param date
 	
	@pre there is no album with the given name
	@pre album name cannot be empty
	*/
	static public function addAlbum($albumName, $date) {
		
		if(self::AlbumNameExists($albumName)) {
			
			throw new Exception("There is already an album with the name '$albumName'");
		
		}
		if($albumName == '') {
			
			throw new Exception("Album name cannot be empty");
			
		}
		else {
		
			$data = array(
				'name' => $albumName,
				'date' => $date
			);
			$insertId = BUILDER::table(self::ALBUMS)->insert($data);
			
			return $insertId;
		
		}
		
	}
	
	
	/**
	Get a list of all albums
	
	@return albums (with only the latest image included)
	*/
	static public function getAllAlbums() {
		
		//Get all albums		
		$query = BUILDER::table(self::ALBUMS)->select('*')->orderBy('date', 'DESC');
		$result = $query->get();
		
		$albums = self::resultToAlbum($result);
		
		//Add the latest image to each album
		foreach ($albums as $album) {
			try {
				$album->addImage(Image::getLatestImage($album->getId()));
			}
			catch (\exception $e) {
				continue;
			}
		}
		
		return $albums;
		
	}
	
	
	
	/**
	Get the album with the given id
	
	@param id
	@return album
	
	@pre id exists
	*/
	static public function getAlbum($id) {
		
		$query = BUILDER::table(self::ALBUMS)->where('id', '=', $id);
		$result = $query->get();
		
		if(sizeof($result) != 1) {
			throw new \exception("Could not find album with the given id($id)");
		}
		else {
			
			$album =  Album::resultToAlbum($result)[0];	
			$images = Image::getImagesFromAlbum($id);
			
			foreach ($images as $image) {
				$album->addImage($image);
			}
			
			return $album;
			
		}
		
	}
	
	
	
	/**
	Delete the album with the given id
	
	Note: this function does not delete the album folder
	
	@param id   
	@pre album exists
	*/
	public function deleteAlbum($id) {
		if(!$this->albumExists($id)) {
			throw new Exception("There is no album with the id $id");
		}
		else {
			//Delete the images from the database
			Image::deleteImagesFromAlbum($id);
			
			//Delete the album from the database
			$query = BUILDER::table(self::ALBUMS)->where('id', '=', $id);
			$result = $query->delete();
		}
		
		//TODO NOT YET TESTED
		
	}

	
	
	/**
	Get the name of the album with the given id
	
	@param id
	@return album  name
	@pre albume exists
	*/
	static public function getAlbumName($id) {
		
		if(!self::albumExists($id)) {
			throw new Exception("There is no album with the id $id");
		}
		else {
	
			$query = BUILDER::table(self::ALBUMS)->where('id', '=', $id);
			$result = $query->get();
			$name = $result[0]->name;
			
			return $name;
			
		}
		
	}
	
	
	
	/**
	Change the information of the given album in the database

	@param album
	@param new album name

	@pre there is no album with the new name
	@pre new album name not empty
	*/
	static public function changeAlbumName($id, $albumName) {
			
		$data = array(
			'name' => $albumName
		);
		
		BUILDER::table(self::ALBUMS)->where('id', '=', $id)->update($data);
		
	}
	
	
	/**
	Change the description of an album
	
	@param Album id
	@param description
	
	@pre album exists
	*/
	static public function changeAlbumDescription($id, $description) {
		
		if(!self::albumExists($id)) {
			throw new Exception("There is no album with the id $id");
		}
		else {
		
			$data = array(
				'description' => $description
			);
			
			BUILDER::table(self::ALBUMS)->where('id', '=', $id)->update($data);
			
		}
		
		
	}
	
	
	
	/**
	Delete the album with the given id
	
	@param id
	*/
	static public function delete($id) {
	
		$query = BUILDER::table(self::ALBUMS)->where('id', '=', $id);
		$result = $query->delete();
	
	}
	
	
	
	/**
	Convert the database result to an instance of Album

	@param result
	@return Album
	*/
	static public function resultToAlbum($result) {

		$output = [];

		foreach ($result as $album) {

			$id = intval($album->id);
			$name = $album->name;
			$date = intval($album->date);
			$description = $album->description;

			$output[] = new \Model\Album($id, $name, $date, $description);
			
		}

		return $output;

	}

}



?>