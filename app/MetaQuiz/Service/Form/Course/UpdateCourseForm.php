<?php
namespace MetaQuiz\Service\Form\Course;

use MetaQuiz\Repositories\Course\CourseInterface;

class UpdateCourseForm {
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
	 * Course Repository
	 * @var \MetaQuiz\Repo\Course\CourseInterface
	 */
	protected $course;

	/**
	 * Constructor
	 */
	public function __construct(UpdateCourseFormValidator $validator, CourseInterface $course) {
		$this -> validator = $validator;
		$this -> course = $course;
	}

	/**
	 * Update an Course
	 * @param integer ID of the Course
	 * @param array Input data to be saved
	 * @return bool
	 */
	public function update($id, array $input) {
		if (!$this -> valid($input)) {
			return false;
		}
		$course = $this -> course -> requireByID($id);	
		return $course -> update($input);		
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
