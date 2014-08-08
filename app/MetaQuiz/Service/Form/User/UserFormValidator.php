<?php
namespace MetaQuiz\Service\Form\User;

use MetaQuiz\Service\Validation\AbstractValidator;

class UserFormValidator extends AbstractValidator {

	/**
	 * Validation Rules
	 * @var Array
	 */
	protected $rules = array('name' => "required", "email" => "required|unique:users", 'password' => "required", 'username' => "required|unique:users");

	/**
	 * Custom Validation Messages
	 * @var Array
	 */
	protected $messages = array('email.unique' => "An account with this email already exists.", 'username.unique' => "This username is already taken");

}
