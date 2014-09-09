<?php
namespace MetaQuiz\Service\Form\Subject;

use MetaQuiz\Service\Validation\AbstractValidator;

class UpdateSubjectFormValidator extends AbstractValidator {

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
