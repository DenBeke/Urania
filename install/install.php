<?php 
/*
Installation static public functions

Author: Mathias Beke
Url: http://denbeke.be
Date: February 2013
*/



class Install {

	static public $notifications = '';

	static public $form = 'forms/error.php';

	static private $link;
	
	static private $config_file = '/../core/config.php'; //relative to install dir
	
	static private $upload_dir = '/../upload/';
	
	static private $cache_dir = '/../cache/';
	
	static private $tables = [
		
		"CREATE TABLE IF NOT EXISTS `Albums` (
		  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id of the album',
		  `name` text NOT NULL COMMENT 'Name of the album',
		  `date` int(11) NOT NULL COMMENT 'Creation date',
		  `description` MEDIUMTEXT NULL COMMENT 'Optional album description',
		  PRIMARY KEY (`id`)
		)",
		
		"CREATE TABLE IF NOT EXISTS `Images` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `name` text NOT NULL,
		  `fileName` text NOT NULL,
		  `date` int(11) NOT NULL,
		  `albumId` int(11) NOT NULL,
		  PRIMARY KEY (`id`)
		)",
		
		"CREATE TABLE `Config` (
		  `config_key` varchar(64) NOT NULL,
		  `config_value` text NOT NULL,
		  PRIMARY KEY (`config_key`)
		)",
		
		"CREATE TABLE `User` (
  		  `id` int(11) NOT NULL AUTO_INCREMENT,
  		  `name` varchar(128) NOT NULL,
  		  `registered` int(11) NOT NULL,
  		  `salt` varchar(128) NOT NULL,
  		  `password` varchar(512) NOT NULL,
  		  PRIMARY KEY (`id`),
  		  UNIQUE KEY `name` (`name`)
		)"	
		
	];
	
	
	static private $config_defines = [
		
		'BASE_DIR'			 => "__DIR__ . '/..'",
		'DB_TABLE_ALBUMS' 	 => "'Albums'",
		'DB_TABLE_IMAGES' 	 => "'Images'",
		'UPLOAD_DIR' 		 => "'upload/'",
		
	];
	
	
	static private $config_strings = [
	
		'date_default_timezone_set(\'Europe/Brussels\');',
	
	];
	
	
	static public $checks = [];
	
	static public $everything_ok = true;

	/**
	Initializer.
	This static public function select the action corresponding to the static public function
	*/
	static public function init() {
	
		$default = 'checks';
	
		if(isset($_GET['step'])) {
			$func = $_GET['step'];
		}
		else {
			$func = $default;
		}
	
		@call_user_func('self::' . $func);
	
	}
	
	
	/**
	Check for valid installation.
	- PHP version
	- read/write access
	- ...
	*/
	static public function checks() {

		self::$everything_ok;

		if(self::checkVersion()) {
			self::$checks['PHP version >= 5.4'] = true;
		} else {
			self::$checks['PHP version >= 5.4'] = 'PHP version >= 5.5.0 required.';
			self::$everything_ok = false;
		}
		
		if(self::checkConfigFile()) {
			self::$checks['Config file writable'] = true;
		} else {
			self::$checks['Config file writable'] = "Couldn't write to core/config.php. Please fix the file permissions.";
			self::$everything_ok = false;
		}
		
		if(self::checkUploadDir()) {
			self::$checks['Upload directory writable'] = true;
		} else {
			self::$checks['Upload directory writable'] = "Couldn't write to upload/ directory. Please fix the directory permissions.";
			self::$everything_ok = false;
		}
		
		if(self::checkCacheDir()) {
			self::$checks['Cache directory writable'] = true;
		} else {
			self::$checks['Cache directory writable'] = "Couldn't write to cache/ directory. Please fix the directory permissions.";
			self::$everything_ok = false;
		}
		
		if(extension_loaded('gd')) {
			self::$checks['GD support'] = true;
		} else {
			self::$checks['GD enabled'] = "GD library not loaded.";
			self::$everything_ok = false;
		}
		
		if(extension_loaded('pdo_mysql')) {
			self::$checks['PDO MySQL support'] = true;
		} else {
			self::$checks['PDO MySQL support'] = "pdo_mysql library not loaded.";
			self::$everything_ok = false;
		}


		self::$form = __DIR__ . '/forms/checks.php';

	}
	
	
	/**
	Retrieve all the database information
	Save the information
	*/
	static public function database() {
	
		$success = false;
		$parameters = [
			'db_host' => 'Please provide database host',
			'db_database' => 'Please provide database name',
			'db_user' => 'Please provide database user',
			'db_password' => 'Please provide database user password',
		];
	
		if(self::form_filled($parameters)) {
			//If all fields provided:
			//Try to connect to the database
			try {
	
				//Check database connection
				$db_host = $_POST['db_host'];
				$db_user = $_POST['db_user'];
				$db_password = $_POST['db_password'];
				$db_database = $_POST['db_database'];
	
				self::$link = self::connectDatabase($db_host, $db_user, $db_password, $db_database);
	
				//Add the tables
				self::create_tables();
				
				//Add correct config details to config list
				self::$config_defines['DB_HOST'] = "'$db_host'";
				self::$config_defines['DB_USER'] = "'$db_user'";
				self::$config_defines['DB_PASSWORD'] = "'$db_password'";
				self::$config_defines['DB_DATABASE'] = "'$db_database'";
				
				//Write the file
				self::save_config_file();
				
				
				$success = true;
				
	
			}
			catch (exception $e) {
				self::notify($e->getMessage());
			}
		}
	
	
	
		if($success) {
			//Next step...
			header('Location: index.php?step=user');
		}
		else {
			//Theme file
			self::$form = __DIR__ . '/forms/database.php';
		}
	
	}
	
	
	/**
	Retrieve all the user information (+ site title)
	Save the information
	*/
	static public function user() {
		
		$success = false;
		$url = '';
		$parameters = [
			'user' => 'Please provide admin username',
			'password' => 'Please provide admin user password',
			'site_title' => 'Please provide a site title'
		];
		
		if(self::form_filled($parameters)) {
			
			//If all fields provided:
			try {
			
				//Default options
				$options = [
					'theme' => 'default',
					'site_title' => '',
					'site_url' => '',
					'copyright' => '',
					'analytics' => '',
				];
				
				//Retrieve options from input
				$options['site_url'] = substr(self::get_base_url(), 0, strlen(self::get_base_url()) - strlen('install') );
				$options['site_title'] = $_POST['site_title'];
				$options['copyright'] = '&copy; ' . $options['site_title'] . ' - Powered by [Urania](http://geturania.eu)';
				
				//Require config file
				require __DIR__ . self::$config_file;
				require __DIR__ . '/../core/database/database.php';
				require __DIR__ . '/../core/autoloader.php';
				
				try {
					require __DIR__ . '/../core/options.php';	
				}
				catch (exception $e) {
					
				}
				
				//Save options to database
				Options::set($options);
				
				//Create the user
				$id = 0;
				$name = $_POST['user'];
				$registered = time();
				$salt = Auth::generateSalt();
				$password = Auth::encrypt($_POST['password'], $salt);
				
				$user = new \Model\User($id, $name, $registered, $salt, $password);
				
				//Save user in database
				Database\User::addUser($user);
				
				
				$success = true;
				$url = $options['site_url'];
				
			
			}
			catch (exception $e) {
				self::notify($e->getMessage());
			}
			
			
		}
		
		
		if($success) {
			//Next step...
			header('Location: ' . $url . 'admin/');
		}
		else {
			//Theme file
			self::$form = __DIR__ . '/forms/user.php';
		}
		
	}
	
	
	static private function notify($text, $success = false) {
	
		if($success) {
			$type = 'ok';
		}
		else {
			$type = 'error';
		}
	
		self::$notifications = self::$notifications . '<p class="notice ' . $type . '">' . $text . '</p>';
	}
	
	
	static private function form_filled($parameters) {
	
		if(!isset($_GET['process'])) {
			return false;
		}
	
		$success = true;
	
		foreach ($parameters as $name => $text) {
			if(!isset($_POST[$name]) or $_POST[$name] == '') {
				self::notify($text);
				$success = false;
			}
		}
	
		return $success;
	
	}
	
	
	static private function create_tables() {
		
		foreach (self::$tables as $query) {
			if(!self::$link->query($query)) {
				throw new Exception('Database Error: ' . self::$link->error);
			}
		}
		
	}
	
	
	static private function save_config_file() {
		
		//Generate the string
		$config = "<?php \n";
		
		foreach (self::$config_defines as $constant => $value) {
			$config = $config . "\n" . "define('$constant', $value);";	
		}
		
		$config = $config . "\n";
		
		foreach (self::$config_strings as $string) {
			$config = $config . "\n" . $string;
		}
		
		$config = $config . "\n\n?>";
		
		
		//Check if file is readable
		@file_put_contents(__DIR__ . self::$config_file, 'test');
		
		if( !file_exists(__DIR__ . self::$config_file) ) {
			throw new exception('Config file does not exist');
		}
		else {
			if( file_get_contents(__DIR__ . self::$config_file) != 'test' ) {
				throw new exception("Can't write to config file");
			}
		}
		
		file_put_contents(__DIR__ . self::$config_file, $config);
		
	}
	
	
	static public function connectDatabase($db_host, $db_user, $db_password, $db_database) {
	
		//Connect
		$link = @new mysqli($db_host, $db_user, $db_password, $db_database);
	
		// check connection
		if (mysqli_connect_errno()) {
			$error = mysqli_connect_error();
			throw new Exception("Database Connection failed: $error");
		}
	
		return $link;
	
	}
	
	static public function get_base_url() {
		/* First we need to get the protocol the website is using */
		$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, 5)) == 'https' ? 'https://' : 'http://';
	
		/* returns /myproject/index.php */
		$path = $_SERVER['PHP_SELF'];
	
		/*
		* returns an array with:
		* Array (
		*  [dirname] => /myproject/
		*  [basename] => index.php
		*  [extension] => php
		*  [filename] => index
		* )
		*/
		$path_parts = pathinfo($path);
		$directory = $path_parts['dirname'];
		/*
		* If we are visiting a page off the base URL, the dirname would just be a "/",
		* If it is, we would want to remove this
		*/
		$directory = ($directory == "/") ? "" : $directory;
	
		/* Returns localhost OR mysite.com */
		$host = $_SERVER['HTTP_HOST'];
	
		/*
		* Returns:
		* http://localhost/mysite
		* OR
		* https://mysite.com
		*/
		return $protocol . $host . $directory;
	}
	
	
	static private function checkVersion() {
		if(version_compare(phpversion(), '5.4', '<')) {
			return false;
		}
		else {
			return true;
		}
	}
	
	static private function checkConfigFile() {
		if(file_exists(dirname(__FILE__) . self::$config_file)) {
			// file exists
			// check if it's writable
			return is_writable(dirname(__FILE__) . self::$config_file);
		}
		else{
			// check if we can create the file in the directory
			return is_writable(dirname(self::$config_file));
		}
	}
	
	static private function checkUploadDir() {
		return is_writable(dirname(__FILE__) . self::$upload_dir);
	}
	
	static private function checkCacheDir() {
		return is_writable(dirname(__FILE__) .self::$cache_dir);
	}


	
}




?>