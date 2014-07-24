<?php 
/*
Login functions

Author: Mathias Beke
Url: http://denbeke.be
Date: July 2014
*/


/**
User Authentication
*/
class Auth {
	
	
	static public $user;
	static private $loggedIn = NULL;
	

	/**
	Initialize auth
	*/
	static public function init() {
		
		self::loggedIn();
		
	}


	/**
	Login a user
	
	@param user id
	*/
	static public function login($userId) {
		
		if(session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		$_SESSION['login'] = true;
		$_SESSION['userId'] = $userId;
		self::$user = \Database\User::getUserById($userId);
		
	}
	
	
	/**
	Logout user, destroy session
	*/
	static public function logout() {
		
		if(session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		$_SESSION['login'] = false;
		$_SESSION['userId'] = 0;
		session_destroy();
	}
	
	
	/**
	Check if a user is logged in
	
	@return logged in
	*/
	static public function loggedIn() {
		
		if(self::$loggedIn != NULL) {
			return self::$loggedIn;
		}
		
		if(session_status() == PHP_SESSION_NONE) {
		    session_start();
		}
		
		if(!isset($_SESSION['login'])) {
			self::$loggedIn = false;
			return false;
		}
		elseif($_SESSION['login'] && isset($_SESSION['userId'])) {
			self::$user = \Database\User::getUserById($_SESSION['userId']);
			self::$loggedIn = true;
			return true;
		}
		else {
			self::$loggedIn = false;
			return false;
		}
	}
	

		
	/**
	Check if the username and password are correct
	
	@return correct
	*/
	static public function checkLoginDetails($username, $password) {
		
		try { 
			return \Database\User::getUserByName($username)->checkPassword($password);
		}
		catch (exception $e) {
			return false;
		}
		
	}
	
	
	/**
	Generate a salt
	
	@return salt
	*/
	static public function generateSalt() {
		return uniqid(rand(0, 1000000));
	}
	
	
	/**
	Encrypt a string with a salt
	
	Encryption is done with SHA512
	
	@param text
	@param salt
	@return encrypted string
	*/
	static public function encrypt($text, $salt) {
		return hash('sha512', $salt . $text);	
	}


}

?>