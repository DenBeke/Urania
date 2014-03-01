<?php
//Connection details for the database
define( 'DB_HOST', 'localhost');
define( 'DB_USER', 'root');
define( 'DB_PASSWORD', 'root');
define( 'DB_DATABASE', 'Urania');

define('DB_TABLE_ALBUMS', 'Albums');
define('DB_TABLE_IMAGES', 'Images');


//User login
$user_name = 'root';
$user_password = 'root';


//Upload directory with slash!!
define('UPLOAD_DIR', 'upload/');

//General Site Information
define('SITE_TITLE', 'DenBeke Images');
define('SITE_URL', 'http://localhost:8888/Urania/'); //With slash!!
define('INSTALL_DIR', '/Urania'); //Without slash
define('THEME_DIR', dirname(__FILE__) . '/../theme/');

//Time zone
date_default_timezone_set('Europe/Brussels');

//Copyright
define('COPYRIGHT', '&copy; Mathias Beke - <a href="http://denbeke.be">DenBeke.be</a>');
?>