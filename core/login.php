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
	if(!isset($_SESSION['login'])) {
	    return false;
	}
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


/*
Generate a salt
*/
function generateSalt() {
	return uniqid(rand(0, 1000000));
}


/*
Encrypt a string with a salt
*/
function encrypt($text, $salt) {
	return hash('sha512', $salt . $text);	
}




?>