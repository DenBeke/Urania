<?php 
/*
Database Controller

Author: Mathias Beke
Url: http://denbeke.be
Date: June 2014
*/

namespace Database;

require_once(__DIR__ . '/../pixie/includes.php');
require_once(__DIR__ . '/image.php');
require_once(__DIR__ . '/album.php');


//Create a new query builder object
$config = array(
	'driver'    => 'mysql', // Db driver
	'host'      => 'localhost',
	'database'  => 'Urania',
	'username'  => 'root',
	'password'  => 'root',
);

new \Pixie\Connection('mysql', $config, '\Database\BUILDER');


?>