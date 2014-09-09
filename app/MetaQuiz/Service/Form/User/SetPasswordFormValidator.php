<?php
namespace MetaQuiz\Service\Form\User;

use MetaQuiz\Service\Validation\AbstractValidator;

class SetPasswordFormValidator extends AbstractValidator {

	/**
	 * Validation Rules
	 * @var Array
	 */
	protected $rules = array('password' => "required|min:5|confirmed");

	/**
	 * Custom Validation Messages
	 * @var Array
	 */
	protected $messages = array('password.confirmed' => "Both the passwords must match.");

}
