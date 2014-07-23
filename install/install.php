<?php 
/*
Installation functions

Author: Mathias Beke
Url: http://denbeke.be
Date: February 2013
*/



function connectDatabase($db_host, $db_user, $db_password, $db_database) {

	//Connect
	$link = new mysqli($db_host, $db_user, $db_password, $db_database);
	
	// check connection
	if (mysqli_connect_errno()) {
	    $error = mysqli_connect_error();
	    throw new Exception("Database Connection failed: $error");
	}
	
	return $link;

}



function createAlbumsTable($link) {

	$query = "CREATE TABLE IF NOT EXISTS `Albums` (
	  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id of the album',
	  `name` text NOT NULL COMMENT 'Name of the album',
	  `date` int(11) NOT NULL COMMENT 'Creation date',
	  PRIMARY KEY (`id`)
	)";
	
	if(!$link->query($query)) {
		throw new Exception('Database Error: ' . $link->error);
	}
}




function createImagesTable($link) {
	
	$query = "CREATE TABLE IF NOT EXISTS `Images` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `name` text NOT NULL,
	  `fileName` text NOT NULL,
	  `date` int(11) NOT NULL,
	  `albumId` int(11) NOT NULL,
	  PRIMARY KEY (`id`)
	)";
	
	
	if(!$link->query($query)) {
		throw new Exception('Database Error: ' . $link->error);
	}
	
}




function createConfigTable($link) {
	
	/*
	CREATE TABLE `Config` (
	  `key` varchar(64) NOT NULL,
	  `value` text NOT NULL,
	  PRIMARY KEY (`key`)
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;
	*/
	
	$query = "CREATE TABLE `Config` (
  		`config_key` varchar(64) NOT NULL,
  		`config_value` text NOT NULL,
  		PRIMARY KEY (`key`)
		)";
	
	
	if(!$link->query($query)) {
		throw new Exception('Database Error: ' . $link->error);
	}
	
}



function createUsersTable() {
	//TODO
	/*
	CREATE TABLE `User` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `name` varchar(128) NOT NULL,
	  `registered` int(11) NOT NULL,
	  `salt` varchar(128) NOT NULL,
	  `password` varchar(128) NOT NULL,
	  PRIMARY KEY (`id`),
	  UNIQUE KEY `name` (`name`)
	);
	*/
}




function saveDefaultOptions() {
	
	//TODO!!!
	
	$options = [
		'theme' => 'default',
		'site_title' => '',
		'site_url' => '',
		'copyright' => '',
		'analytics' => '',
	];
	
}




?>