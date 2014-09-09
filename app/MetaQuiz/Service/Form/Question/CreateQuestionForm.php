<?php
namespace MetaQuiz\Service\Form\Question;

use MetaQuiz\Repositories\Question\QuestionInterface;

class CreateQuestionForm {
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
	public function __construct(CreateQuestionFormValidator $validator, QuestionInterface $question) {
		$this -> validator = $validator;
		$this -> question = $question;
	}

	/**
	 * Create a new Question
	 * @param array Input data to be saved
	 * @return bool
	 */
	public function create(array $input) {
		if (!$this -> valid($input)) {
			return false;
		}
		$question = $this -> question -> create($input);
		return $question;
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
