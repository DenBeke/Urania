<?php
/*
PHP Unit Tes framework

Author: Mathias Beke
Url: http://denbeke.be
Date: March 2014
*/


require_once( __DIR__ . '/unit-test.php' );
require_once( __DIR__ . '/preprocess.php');

$t = new \UnitTest\UnitTest;

preprocess();

foreach (glob( __DIR__ . '/tests/preprocessed/*.php') as $file) {
	require_once($file);
}


$t->run();




include( __DIR__ . '/theme/header.php');

$t->write();

include( __DIR__ . '/theme/footer.php');

?>