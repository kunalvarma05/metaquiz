<?php
namespace MetaQuiz\Service\Form\Faculty;

use MetaQuiz\Repositories\Faculty\FacultyInterface;

class UpdateFacultyForm {
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
	public function __construct(UpdateFacultyFormValidator $validator, FacultyInterface $faculty) {
		$this -> validator = $validator;
		$this -> faculty = $faculty;
	}

	/**
	 * Update an Faculty
	 * @param integer ID of the Faculty
	 * @param array Input data to be saved
	 * @return bool
	 */
	public function update($id, array $input) {
		$rules = array('gr_no' => "required|unique:faculties,gr_no,$id");
		if (!$this -> valid($input, $rules)) {
			return false;
		}
		$faculty = $this -> faculty -> requireByID($id);
		return $faculty -> update($input);
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
