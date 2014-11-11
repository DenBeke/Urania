<?php

//Get the base dir of the installation
define( 'BASE_DIR', __DIR__ . '/..' );

//Connection details for the database
define( 'DB_HOST', 'localhost');
define( 'DB_USER', 'root');
define( 'DB_PASSWORD', 'root');
define( 'DB_DATABASE', 'Urania');

define('DB_TABLE_ALBUMS', 'Albums');
define('DB_TABLE_IMAGES', 'Images');

//Upload directory with slash!!
define('UPLOAD_DIR', 'upload/');

//Time zone
date_default_timezone_set('Europe/Brussels');

//Flag that tells if Urania is installed or not
define('INSTALLED', false);

?>