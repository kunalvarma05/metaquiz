<?php
namespace MetaQuiz\Service\Form\User;

use MetaQuiz\Repositories\User\UserInterface;
use Hash;

class CreateUserForm {
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
	public function __construct(CreateUserFormValidator $validator, UserInterface $user) {
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
		$input['password'] = Hash::make($input['password']);
		$input['password_set'] = true;
		return $this -> user -> create($input);
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
