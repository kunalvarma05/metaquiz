<?php
namespace MetaQuiz\Service\Form\Student;

use MetaQuiz\Service\Validation\AbstractValidator;

class CreateStudentFormValidator extends AbstractValidator {

	/**
	 * Validation Rules
	 * @var Array
	 */
	protected $rules = array('roll_no' => "required|unique:students", 'course_id' => "required|exists:courses,id");

	/**
	 * Custom Validation Messages
	 * @var Array
	 */
	protected $messages = array("course_id.exists" => "No such course found!");

}
