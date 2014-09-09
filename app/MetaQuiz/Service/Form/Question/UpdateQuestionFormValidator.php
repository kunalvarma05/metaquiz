<?php
namespace MetaQuiz\Service\Form\Question;

use MetaQuiz\Service\Validation\AbstractValidator;

class UpdateQuestionFormValidator extends AbstractValidator {

	/**
	 * Validation Rules
	 * @var Array
	 */
	protected $rules = array('name' => "required");

	/**
	 * Custom Validation Messages
	 * @var Array
	 */
	protected $messages = array();

}
