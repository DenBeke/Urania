<?php 
/*
Database functions for Image

Author: Mathias Beke
Url: http://denbeke.be
Date: June 2014
*/

namespace Database;

require_once(__DIR__ . '/../pixie/includes.php');
require_once(__DIR__ . '/../model/image.php');


class Image {

	private $builder;


	public function __construct() {
		
		$config = array(
			'driver'    => 'mysql', // Db driver
			'host'      => 'localhost',
			'database'  => 'Urania',
			'username'  => 'root',
			'password'  => 'root',
		);
		
		$connection = new \Pixie\Connection('mysql', $config);
		$this->builder = new \Pixie\QueryBuilder\QueryBuilderHandler($connection);
	}



	/**
	Get the image with the given id
	
	@param id
	@return image
	@pre There exists an image with the given ID.
	*/
	public function getImageById($id) {
		
		$query = $this->builder->table('Images')->where('id', '=', $id);
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
		
		$query = $this->builder->table('Images')->where('albumId', '=', $albumId);
		$result = $query->get();
		
		return Image::resultToImage($result);
		
	}
	
	
	
	
	/**
	Get the latest image from the album with the given id
	
	@param album id
	@return image
	
	@pre album exists
	*/
	public function getLatestImage($albumId) {
		
		$query = $this->builder->table('Images')->where('albumId', '=', $albumId)->orderBy('date', 'DESC')->limit(1);
		$result = $query->get();
		
		if(sizeof($result) != 1) {
			throw new \exception("Could not find latest image of album with the given albumId($albumId)");
		}
		else {
			return Image::resultToImage($result)[0];	
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
			$fileName = $image->fileName;
			$name = $image->name;
			$date = intval($image->date);
			$albumId = intval($image->albumId);
			
			$output[] = new \Image($id, $fileName, $name, $date, $albumId);
		}
		
		return $output;
		
	}
	
}


$i = new Image;

echo $i->getLatestImage(5)


?>