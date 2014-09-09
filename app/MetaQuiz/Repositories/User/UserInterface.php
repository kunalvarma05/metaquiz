<?php
namespace MetaQuiz\Repositories\User;

interface UserInterface {

	/**
	 * All
	 * Get All the Users
	 * @return object Object of the users information
	 */
	public function all($with = array());

	/**
	 * byID
	 * Get a Single user by ID
	 * @param Integer ID of the user
	 * @param array Related Models for Eager Loading
	 * @return object Object of user information
	 */
	public function byID($id, $with = array());

	/**
	 * requireByID Get a single user by ID and show if not found
	 * @param Integer ID of the user
	 * @param Array $with [Related Models for Eager Loading]
	 * @return Object User Collection
	 */
	public function requireByID($id, $with = array());

	/**
	 * byUsername
	 * Get a Single user by Username
	 * @param string Username of the user
	 * @param array Related Models for Eager Loading
	 * @return object Object of user information
	 */
	public function byUsername($username, $with = array());

	/**
	 * The Activity feed of a given user
	 * @param  int $id The UserID
	 */
	public function feed($id);

	/**
	 * Create
	 * Create a User
	 * @param Input Data to be stored
	 * @return bool
	 */
	public function create(array $input);

}
