<?php 
/*
Class for managing user options.

Author: Mathias Beke
Url: http://denbeke.be
Date: July 2014
*/


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
		
		$install_dir = explode('/', SITE_URL);
		$install_dir = array_slice($install_dir, 3);
		if($install_dir[sizeof($install_dir)-1] == '') {
			unset($install_dir[sizeof($install_dir)-1]);
		}
		$install_dir = '/' . implode('/', $install_dir);
		
		define('INSTALL_DIR', $install_dir);
		
		//Theme
		define('THEME_DIR', BASE_DIR . '/themes/' . self::get('theme') );
		define('THEME_URL', SITE_URL . 'themes/' . self::get('theme') );
		define('THEME', self::get('theme'));
		
		//Analytics
		define('ANALYTICS', self::get('analytics'));
		
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
		
		Config::save($data);
		
		foreach ($data as $key => $value) {
			
			self::$options[$key] = $value;
			
		}
		
	}
	
	
	
}



Options::init();


?>