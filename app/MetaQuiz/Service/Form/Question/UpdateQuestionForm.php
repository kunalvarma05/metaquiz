<?php
namespace MetaQuiz\Service\Form\Question;

use MetaQuiz\Repositories\Question\QuestionInterface;

class UpdateQuestionForm {
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
	 * Question Repository
	 * @var \MetaQuiz\Repo\Question\QuestionInterface
	 */
	protected $question;

	/**
	 * Constructor
	 */
	public function __construct(UpdateQuestionFormValidator $validator, QuestionInterface $question) {
		$this -> validator = $validator;
		$this -> question = $question;
	}

	/**
	 * Update an Question
	 * @param integer ID of the Question
	 * @param array Input data to be saved
	 * @return bool
	 */
	public function update($id, array $input) {
		if (!$this -> valid($input)) {
			return false;
		}
		$question = $this -> question -> requireByID($id);
		return $question -> update($input);
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
