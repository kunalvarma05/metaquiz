<?php
namespace MetaQuiz\Service\Validation;

use Illuminate\Validation\Factory as Validator;

abstract class AbstractValidator implements ValidableInterface {

	/**
	 * Validator
	 * @var \Illuminate\Validation\Factory
	 */
	protected $validator;

	/**
	 * Validation data key => value array
	 * @var Array
	 */
	protected $data = array();

	/**
	 * Validation Rules
	 * @var Array
	 */
	protected $rules = array();

	/**
	 * Validation Errors
	 * @var Array
	 */
	protected $errors = array();

	/**
	 * Custom Validation Messages
	 * @var Array
	 */
	protected $messages = array();

	/**
	 * Constructor
	 */
	public function __construct(Validator $validator) {
		$this -> validator = $validator;
	}

	/**
	 * Set data to validate
	 * @return \MetaQuiz\Service\Validation\AbstractValidator
	 */
	public function with(array $data) {
		$this -> data = $data;
		return $this;
	}

	/**
	 * Validation passes or fails
	 * @return bool
	 */
	public function passes() {
		$validator = $this -> validator -> make($this -> data, $this -> rules, $this -> messages);
		if ($validator -> fails()) {
			$this -> errors = $validator -> messages();
			return false;
		}
		return true;
	}

	/**
	 * Return validation errors, if any
	 * @return array
	 */
	public function errors() {
		return $this -> errors;
	}

}
