<?php
/*
PHP Unit Tes framework

Author: Mathias Beke
Url: http://denbeke.be
Date: March 2014
*/


require_once( dirname(__FILE__) . '/unit-test.php' );


$t = new \UnitTest\UnitTest;


foreach (glob(dirname(__FILE__) . '/tests/*.php') as $file) {
	require_once($file);
}


$t->run();




include(dirname(__FILE__) . '/theme/header.php');

$t->write();

include(dirname(__FILE__) . '/theme/footer.php');

?>