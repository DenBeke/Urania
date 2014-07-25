<?php
/*
Autoloader...
PHP will include the needed class files itself
*/

function autoloader($class) {
	if($class != 'Database\BUILDER') {
		spl_autoload($class);
	}
}

//Extensions
spl_autoload_extensions('.php');

//Define the autoload function
spl_autoload_register('autoloader');

?>