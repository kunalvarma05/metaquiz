<?php
namespace MetaQuiz\Service\Form\Student;

use MetaQuiz\Repositories\Student\StudentInterface;

class UpdateStudentForm {
	/**
	 * Form Data
	 * @var Array
	 */
	protected $data;

	/**
	 * Validator
	 * @var \MetaQuiz\Servie\Validation\ValidableInterface
	 */
	protected $validator;

	/**
	 * Student Repository
	 * @var \MetaQuiz\Repo\Student\StudentInterface
	 */
	protected $student;

	/**
	 * Constructor
	 */
	public function __construct(UpdateStudentFormValidator $validator, StudentInterface $student) {
		$this -> validator = $validator;
		$this -> student = $student;
	}

	/**
	 * Update an Student
	 * @param integer ID of the Student
	 * @param array Input data to be saved
	 * @return bool
	 */
	public function update($id, array $input) {
		$rules = array('roll_no' => "required|unique:students,roll_no,$id");
		if (!$this -> valid($input, $rules)) {
			return false;
		}
		$student = $this -> student -> requireByID($id);
		return $student -> update($input);
	}

	/**
	 * Validation Errors
	 * @return array
	 */
	public function errors() {
		return $this -> validator -> errors();
	}

	/**
	 * Test if form validator passes
	 */
	public function valid(array $input, array $rules) {
		return $this -> validator -> with($input, $rules) -> passes();
	}

}
