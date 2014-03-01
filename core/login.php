<?php 

require_once(dirname(__FILE__).'/config.php');

/*
Add logged-in to user session
*/
function login() {
	session_start();
	$_SESSION['login'] = true;
}


/*
Logout user, destroy session
*/
function logout() {
	session_start();
	$_SESSION['login'] = false;
	session_destroy();
}


/*
Check if a user is logged in
*/
function loggedIn() {
	if(!isset($_SESSION['login'])) {
	    session_start();
	}
	
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


/*
Check if the username and password are correct
*/
function checkLoginDetails($userName, $passWord) {
	return USERNAME == $userName and PASSWORD == $passWord;
	
}




?>