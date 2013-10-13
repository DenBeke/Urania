<?php
/*
PHP Cache

Author: Mathias Beke
Url: http://denbeke.be
Date: June 2013
*/


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
		
	}
	
	
	/**
	Check if the given password corresponds to the password.
	
	@param password
	@return bool: true (correct password) / false (incorrect)
	*/
	public function checkPassword($password) {
		//TODO Check hash value
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
	
}


?>