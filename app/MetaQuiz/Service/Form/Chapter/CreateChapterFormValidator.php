<?php
namespace MetaQuiz\Service\Form\Chapter;

use MetaQuiz\Service\Validation\AbstractValidator;

class CreateChapterFormValidator extends AbstractValidator {

	/**
	 * Validation Rules
	 * @var Array
	 */
	protected $rules = array('name' => "required", "description" => "required", 'subject_id' => "required|exists:subjects,id");

	/**
	 * Custom Validation Messages
	 * @var Array
	 */
	protected $messages = array();

}
