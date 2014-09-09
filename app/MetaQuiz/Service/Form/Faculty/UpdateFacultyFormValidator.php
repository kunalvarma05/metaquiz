<?php
namespace MetaQuiz\Service\Form\Faculty;

use MetaQuiz\Service\Validation\AbstractValidator;

class UpdateFacultyFormValidator extends AbstractValidator {

	/**
	 * Validation Rules
	 * @var Array
	 */
	protected $rules = array('gr_no' => "required|unique:faculties,gr_no,:current");

	/**
	 * Custom Validation Messages
	 * @var Array
	 */
	protected $messages = array();

}
