<?php
namespace MetaQuiz\Service\Form\Course;

use MetaQuiz\Service\Validation\AbstractValidator;

class CreateCourseFormValidator extends AbstractValidator {

	/**
	 * Validation Rules
	 * @var Array
	 */
	protected $rules = array('name' => "required", "description" => "required", 'organization_id' => "required|exists:organizations,id");

	/**
	 * Custom Validation Messages
	 * @var Array
	 */
	protected $messages = array();

}
