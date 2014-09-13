<?php
namespace MetaQuiz\Service\Form\Student;

use MetaQuiz\Repositories\Student\StudentInterface;

class CreateStudentForm {
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
	public function __construct(CreateStudentFormValidator $validator, StudentInterface $student) {
		$this -> validator = $validator;
		$this -> student = $student;
	}

	/**
	 * Create a new Student
	 * @param array Input data to be saved
	 * @return bool
	 */
	public function create(array $input) {
		if (!$this -> valid($input)) {
			return false;
		}
		$student = $this -> student -> create($input);
		return $student;
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
	public function valid(array $input) {
		return $this -> validator -> with($input) -> passes();
	}

}
