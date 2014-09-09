<?php
namespace MetaQuiz\Service\Form\Faculty;

use MetaQuiz\Service\Validation\AbstractValidator;

class CreateFacultyFormValidator extends AbstractValidator {

	/**
	 * Validation Rules
	 * @var Array
	 */
	protected $rules = array('gr_no' => "required|unique:faculties");

	/**
	 * Custom Validation Messages
	 * @var Array
	 */
	protected $messages = array();

}
