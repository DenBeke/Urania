<?php 

	
function login() {
	$_SESSION['login'] = true;
}


function logout() {
	$_SESSION['login'] = false;
	session_destroy();
}


function loggedIn() {
	//session_start();
	if($_SESSION['login']) {
		return true;
	}
	else {
		return false;
	}
}


function checkLoginDetails($userName, $passWord) {
	require(dirname(__FILE__).'/config.php');
	return $user_name == $userName and $user_password == $passWord;
	
}




?>