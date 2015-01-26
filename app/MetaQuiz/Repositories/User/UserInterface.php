<?php
namespace MetaQuiz\Repositories\User;

use MetaQuiz\Repositories\RepositoryInterface;

interface UserInterface extends RepositoryInterface{

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
