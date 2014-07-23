<?php 
/*
Config Database Controller

Author: Mathias Beke
Url: http://denbeke.be
Date: July 2014
*/

namespace Database;

require_once(__DIR__ . '/../model/album.php');


/**
Config Database Controller
*/
class Config {

	const CONFIG = 'Config';


	/**
	Read the stored config data
	
	@return `["config_key" => "config_value"]`
	*/
	static public function read() {

		$query = BUILDER::table(self::CONFIG)->select('*');
		
		$result = $query->get();
		$output = [];

		foreach ($result as $item) {
			
			$output[$item->config_key] = $item->config_value;
			
		}

		return $output;

	}


}



?>