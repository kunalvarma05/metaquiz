<?php
namespace MetaQuiz\Service\Form\User;

use MetaQuiz\Repositories\User\UserInterface;
use Hash;

class UserForm {
	/**
	 * Form Data
	 * @var Array
	 */
	protected $data;

	/**
	 * Validator
	 * @var \MetaQuiz\Servie\Validation\ValidableInterface
	 */
	protected $validator;

	/**
	 * User Repository
	 * @var \MetaQuiz\Repo\User\UserInterface
	 */
	protected $user;

	/**
	 * Constructor
	 */
	public function __construct(UserFormValidator $validator, UserInterface $user) {
		$this -> validator = $validator;
		$this -> user = $user;
	}

	/**
	 * Create a new User
	 * @param array Input data to be saved
	 * @return bool
	 */
	public function save(array $input) {
		if (!$this -> valid($input)) {
			return false;
		}
		return $this -> user -> create(array('name' => $input['name'], 'email' => $input['email'], 'password' => Hash::make($input['password']), 'username' => $input['username']));
	}

	/**
	 * Validation Errors
	 * @return array
	 */
	public function errors() {
		return $this -> validator -> errors();
	}

	/**
	 * Test if form validator passes
	 */
	public function valid(array $input) {
		return $this -> validator -> with($input) -> passes();
	}

}
