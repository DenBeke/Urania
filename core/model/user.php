<?php
/*
PHP Cache

Author: Mathias Beke
Url: http://denbeke.be
Date: June 2013
*/


require_once( __DIR__ .'/../login.php');


/**
@brief Class representing a user
*/
class User {
	
	private $id;
	private $name;
	private $registered;
	private $salt;
	private $password;
	
	
	/**
	Create new user object
	
	@param id
	@param user name
	@param registration date
	@param salt
	@param encrypted password
	*/
	public function __construct($id, $name, $registered, $salt, $password) {
		$this->id = $id;
		$this->name = $name;
		$this->registered = $registered;
		$this->salt = $salt;
		$this->password = $password;
	}
	
	
	/**
	Check if the given password corresponds to the password.
	
	@param password
	@return bool: true (correct password) / false (incorrect)
	*/
	public function checkPassword($enteredPassword) {
		return ($this->password == \Auth::encrypt($enteredPassword, $this->salt));
	}
	
	
	/**
	Get the user id
	
	@return id
	*/
	public function getId() {
		return $this->id;
	}
	
	
	/**
	Get the name of the user
	
	@param user name
	*/
	public function getName() {
		return $this->name;
	}
	
	
	/**
	Get the registration date
	
	@return registration date
	*/
	public function getRegistrationDate() {
		return $this->registered;
	}
	
	
	/**
	Get the salt
	
	@return salt
	*/
	public function getSalt() {
		return $this->salt;
	}
	
	
	/**
	Get the password
	
	@return password
	*/
	public function getPassword() {
		return $this->password;
	}
	
	
}


?>