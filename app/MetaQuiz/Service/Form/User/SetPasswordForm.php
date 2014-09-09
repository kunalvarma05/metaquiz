<?php
namespace MetaQuiz\Service\Form\User;

use MetaQuiz\Repositories\User\UserInterface;
use Hash;
use Auth;

class SetPasswordForm {
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
	public function __construct(SetPasswordFormValidator $validator, UserInterface $user) {
		$this -> validator = $validator;
		$this -> user = $user;
	}

	/**
	 * Set the password
	 * @param array Input data to be saved
	 * @return bool
	 */
	public function set(array $input) {
		if (!$this -> valid($input)) {
			return false;
		}
		$user = $this -> user -> byID(Auth::user() -> id);
		return $user -> update(array('password_set' => true, 'password' => Hash::make($input['password'])));
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
