<?php 
/*
Class for managing user options.

Author: Mathias Beke
Url: http://denbeke.be
Date: July 2014
*/


require_once __DIR__ . '/database/config.php';
use \Database\Config;

/**
@brief Class for managing user options

User options are stored in the database and
must be accessed (and saved!) using this class.
*/
class Options {
	
	static private $options = [];
	
	
	/**
	Retrieve all the options from the database
	
	@post all options will be loaded
	*/
	static public function init() {
		self::$options = Config::read();
		
		//Create system options
		
		//Site url/title/footer
		define('SITE_TITLE', self::get('site_title'));
		define('SITE_URL', self::get('site_url')); //With slash!!
		define('COPYRIGHT', self::get('copyright'));
		
		//Theme
		define('THEME_DIR', BASE_DIR . '/theme/' . self::get('theme') );
		define('THEME_URL', SITE_URL . 'theme/' . self::get('theme') );
		define('THEME', self::get('theme'));
		
	}
	
	
	/**
	Get the given option
	
	@param key
	@return option
	*/
	static public function get($key) {
		
		if(!isset(self::$options[$key])) {
			throw new exception("Option($key) not found");
		}
		else {
			return self::$options[$key];
		}
		
	}
	
	
	/**
	Save the given options
	
	If an option doesn't exist,
	a new entry will be created in the database.
	
	The function will store an array of config data items
		[
			'config_key' => 'config_value'
		]
		
	This makes it easy to save a batch of configuration options
	
	@param options (array)
	@post options will be saved
	*/
	static public function set($data) {
		
		foreach ($data as $key => $value) {
			
			Config::save([$key => $value]);
			self::$options[$key] = $value;
			
		}
		
	}
	
	
	
}



Options::init();


?>