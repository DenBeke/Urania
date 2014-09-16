<?php 
/*
Database Controller

Author: Mathias Beke
Url: http://denbeke.be
Date: June 2014
*/

/**
@brief Namespace containing all database classes
*/
namespace Database;

require_once(__DIR__ . '/../pixie/includes.php');


//Create a new query builder object
$config = array(
	'driver'    => 'mysql', // Db driver
	'host'      => DB_HOST,
	'database'  => DB_DATABASE,
	'username'  => DB_USER,
	'password'  => DB_PASSWORD,
);

new \Pixie\Connection('mysql', $config, '\Database\BUILDER');


?>