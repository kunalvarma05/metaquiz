<?php
namespace MetaQuiz\Service\Form\Question;

use MetaQuiz\Service\Validation\AbstractValidator;

class UpdateQuestionFormValidator extends AbstractValidator {

	/**
	 * Validation Rules
	 * @var Array
	 */
	protected $rules = array('title' => "required", 'option_one' => "required", 'option_two' => "required", 'option_three' => "required", 'answer' => "required");

	/**
	 * Custom Validation Messages
	 * @var Array
	 */
	protected $messages = array();

}
