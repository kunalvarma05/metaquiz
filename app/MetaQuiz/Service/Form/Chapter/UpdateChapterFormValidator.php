<?php
namespace MetaQuiz\Service\Form\Chapter;

use MetaQuiz\Service\Validation\AbstractValidator;

class UpdateChapterFormValidator extends AbstractValidator {

	/**
	 * Validation Rules
	 * @var Array
	 */
	protected $rules = array('name' => "required", "description" => "required");

	/**
	 * Custom Validation Messages
	 * @var Array
	 */
	protected $messages = array();

}
