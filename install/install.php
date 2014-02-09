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
	    throw new Exception("Connect failed: $error");
	}
	
	return $link;

}



function createAlbumsTable($link) {

	$query = "CREATE TABLE `Albums` (
	  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id of the album',
	  `name` text NOT NULL COMMENT 'Name of the album',
	  `date` int(11) NOT NULL COMMENT 'Creation date',
	  PRIMARY KEY (`id`)
	)";
	
	if(!$link->query($query)) {
		throw new Exception('MySQL Error: ' . $link->error);
	}
}




function createImagesTable($link) {
	
	$query = "CREATE TABLE `Images` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `name` text NOT NULL,
	  `fileName` text NOT NULL,
	  `date` int(11) NOT NULL,
	  `albumId` int(11) NOT NULL,
	  PRIMARY KEY (`id`)
	)";
	
	
	if(!$link->query($query)) {
		throw new Exception('MySQL Error: ' . $link->error);
	}
	
}



?>