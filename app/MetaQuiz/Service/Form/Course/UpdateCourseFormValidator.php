<?php
namespace MetaQuiz\Service\Form\Course;

use MetaQuiz\Service\Validation\AbstractValidator;

class UpdateCourseFormValidator extends AbstractValidator {

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
