<?php 


/*
Add logged-in to user session
*/
function login() {
	$_SESSION['login'] = true;
}


/*
Logout user, destroy session
*/
function logout() {
	$_SESSION['login'] = false;
	session_destroy();
}


/*
Check if a user is logged in
*/
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


/*
Check if the username and password are correct
*/
function checkLoginDetails($userName, $passWord) {
	require(dirname(__FILE__).'/config.php');
	return $user_name == $userName and $user_password == $passWord;
	
}




?>