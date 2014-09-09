<?php
namespace MetaQuiz\Service\Form\Course;

use MetaQuiz\Repositories\Course\CourseInterface;

class CreateCourseForm {
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
	public function __construct(CreateCourseFormValidator $validator, CourseInterface $Course) {
		$this -> validator = $validator;
		$this -> course = $Course;
	}

	/**
	 * Create a new Course
	 * @param array Input data to be saved
	 * @return bool
	 */
	public function create(array $input) {
		if (!$this -> valid($input)) {
			return false;
		}		
		return $this -> course -> create($input);
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
