<?php
namespace MetaQuiz\Service\Form\Subject;

use MetaQuiz\Service\Validation\AbstractValidator;

class CreateSubjectFormValidator extends AbstractValidator {

	/**
	 * Validation Rules
	 * @var Array
	 */
	protected $rules = array('name' => "required", "description" => "required", 'course_id' => "required|exists:courses,id");

	/**
	 * Custom Validation Messages
	 * @var Array
	 */
	protected $messages = array();

}
