<?php
namespace MetaQuiz\Service\Form\Activate;

use MetaQuiz\Repositories\Activation\ActivationInterface;
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
	 * Activation Repository
	 * @var \MetaQuiz\Repo\Activation\ActivationInterface
	 */
	protected $activation;

	/**
	 * Constructor
	 */
	public function __construct(ActivateFormValidator $validator, ActivationInterface $activation) {
		$this -> validator = $validator;
		$this -> activation = $activation;
	}

	/**
	 * Activate a User
	 * @param array Input data to be saved
	 * @return bool
	 */
	public function activate($id, $code) {
		if (!$this -> valid(array('code' => $code))) {
			return false;
		}
		$activation = $this -> activation -> activate($id, $code);
		return $activation;
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
