<?php
namespace MetaQuiz\Service\Form\Faculty;

use MetaQuiz\Repositories\Faculty\FacultyInterface;

class CreateFacultyForm {
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
	 * Faculty Repository
	 * @var \MetaQuiz\Repo\Faculty\FacultyInterface
	 */
	protected $faculty;

	/**
	 * Constructor
	 */
	public function __construct(CreateFacultyFormValidator $validator, FacultyInterface $faculty) {
		$this -> validator = $validator;
		$this -> faculty = $faculty;
	}

	/**
	 * Create a new Faculty
	 * @param array Input data to be saved
	 * @return bool
	 */
	public function create(array $input) {
		if (!$this -> valid($input)) {
			return false;
		}
		$faculty = $this -> faculty -> create($input);
		if ($faculty) {
			//Sync the assigned subjects to the faculty
			if($input['subjects']){
				$faculty->subjects()->sync($input['subjects']);
			}
		}
		return $faculty;
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
