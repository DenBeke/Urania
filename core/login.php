<?php 

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
function checkLoginDetails($username, $password) {
	
	try { 
		return \Database\User::getUserByName($username)->checkPassword($password);
	}
	catch (exception $e) {
		return false;
	}
	
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