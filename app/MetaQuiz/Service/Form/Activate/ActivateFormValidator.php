<?php
namespace MetaQuiz\Service\Form\Activate;

use MetaQuiz\Service\Validation\AbstractValidator;

class ActivateFormValidator extends AbstractValidator {

	/**
	 * Validation Rules
	 * @var Array
	 */
	protected $rules = array('code' => "required|exists:activations");

	/**
	 * Custom Validation Messages
	 * @var Array
	 */
	protected $messages = array('code.exists' => "The entered activation code doesn't exist");

}
