<?php
namespace MetaQuiz\Service\Form\Subject;

use MetaQuiz\Repositories\Subject\SubjectInterface;

class UpdateSubjectForm {
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
	 * Subject Repository
	 * @var \MetaQuiz\Repo\Subject\SubjectInterface
	 */
	protected $subject;

	/**
	 * Constructor
	 */
	public function __construct(UpdateSubjectFormValidator $validator, SubjectInterface $subject) {
		$this -> validator = $validator;
		$this -> Subject = $subject;
	}

	/**
	 * Update an Subject
	 * @param integer ID of the Subject
	 * @param array Input data to be saved
	 * @return bool
	 */
	public function update($id, array $input) {
		if (!$this -> valid($input)) {
			return false;
		}
		$subject = $this -> Subject -> requireByID($id);
		return $subject -> update($input);
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
