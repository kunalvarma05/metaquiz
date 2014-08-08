<?php
namespace MetaQuiz\Service\Form\Activate;

use MetaQuiz\Repositories\User\UserInterface;
use Hash;

class ActivateForm {
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
	public function __construct(ActivateFormValidator $validator, UserInterface $user) {
		$this -> validator = $validator;
		$this -> user = $user;
	}

	/**
	 * Activate a User
	 * @param array Input data to be saved
	 * @return bool
	 */
	public function activate($id, $code) {
		if (!$this -> valid($code)) {
			return false;
		}
		return $this -> user -> activate($id, $code);
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
