<?php
namespace MetaQuiz\Service\Form\Student;

use MetaQuiz\Service\Validation\AbstractValidator;

class UpdateStudentFormValidator extends AbstractValidator {

	/**
	 * Validation Rules
	 * @var Array
	 */
	protected $rules = array('roll_no' => "required|unique:students,roll_no,:current");

	/**
	 * Custom Validation Messages
	 * @var Array
	 */
	protected $messages = array();

}
