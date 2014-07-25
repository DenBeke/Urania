<?php 
/*
User Database Controller

Author: Mathias Beke
Url: http://denbeke.be
Date: June 2014
*/

namespace Database;

require_once(__DIR__ . '/../model/user.php');


/**
User Database Controller
*/
class User {

	const USERS = 'User';


	/**
	Check if the album with the given id exists

	@param id
	@return exists
	*/
	static public function exists($id) {

		$query = BUILDER::table(self::USERS)->where('id', '=', $id);
		$count = $query->count();

		if($count >= 1) {
			return true;
		}
		else {
			return false;
		}

	}



	/**
	Get the user with the given id

	@param id
	@return user
	@pre user exists
	*/
	static public function getUserById($id) {

		$query = BUILDER::table(self::USERS)->where('id', '=', $id);
		$result = $query->get();
		
		if(sizeof($result) != 1) {
			throw new \exception("Could not find user with the given id($id)");
		}
		else {
			return self::resultToUser($result)[0];	
		}

	}
	
	
	/**
	Get the user with the given name
	
	@param name
	@return user
	@pre user exists
	*/
	static public function getUserByName($name) {
	
		$query = BUILDER::table(self::USERS)->where('name', '=', $name);
		$result = $query->get();
		
		if(sizeof($result) != 1) {
			throw new \exception("Could not find user with the given name($name)");
		}
		else {
			return self::resultToUser($result)[0];	
		}
	
	}
	
	
	
	/**
	Add the given (new) user to the database
	
	@param user
	*/
	static public function addUser($user) {
		
		$data = [
			'id' => $user->getId(),
			'name' => $user->getName(),
			'registered' => $user->getRegistrationDate(),
			'salt' => $user->getSalt(),
			'password' => $user->getPassword(),
		];
		
		$insertId = BUILDER::table(self::USERS)->insert($data);
		
		return $insertId;
	
	
	}



	/**
	Change the password of a user in the database
	
	@param user id
	@param new user password
	
	@pre user exists
	@pre new password not empty
	*/
	static public function changePassword($id, $password) {
		if(!self::exists($id)) {
			throw new Exception("There is no user with the id $id");
		}
		elseif ($password == '') {
			throw new Exception('User password cannot be empty');
		}
		else {
			
			$data = array(
				'password' => $password
			);
			
			BUILDER::table(self::USERS)->where('id', '=', $id)->update($data);
			
		}
	}



	/**
	Convert the database result to an instance of Album

	@param result
	@return Album
	*/
	static public function resultToUser($result) {

		//User($id, $name, $registered, $salt, $password)

		$output = [];

		foreach ($result as $user) {

			$id = intval($user->id);
			$name = $user->name;
			$registered = intval($user->registered);
			$salt = $user->salt;
			$password = $user->password;

			$output[] = new \Model\User($id, $name, $registered, $salt, $password);

		}

		return $output;

	}

}



?>