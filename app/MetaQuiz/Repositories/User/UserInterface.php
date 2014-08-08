<?php
namespace MetaQuiz\Repositories\User;

interface UserInterface {

	/**
	 * All
	 * Get All the Users
	 * @return object Object of the users information
	 */
	public function all();

	/**
	 * byUsername
	 * Get a Single user by Username
	 * @param string Username of the user
	 * @return object Object of user information
	 */
	public function byUsername($username);

	/**
	 * getFriends
	 * Get a the friends of the user
	 * @param Integer ID of the user
	 * @return object Object of user information
	 */
	public function getFriends($id);

	/**
	 * getInfo
	 * Get a the info of the given user
	 * @param Integer ID of the user
	 * @return object Object of user information
	 */
	public function getInfo($id);

	/**
	 * byID
	 * Get a Single user by ID
	 * @param Integer ID of the user
	 * @return object Object of user information
	 */

	public function byID($id);

	/**
	 * Create
	 * Create a User
	 * @param Input Data to be stored
	 * @return bool
	 */
	public function create(array $input);

	/**
	 * Activate
	 * Activate a User
	 * @param Integer $id
	 * @param String $code
	 */
	public function activate($id, $code);

}
