<?php
namespace MetaQuiz\Service\Form\Chapter;

use MetaQuiz\Repositories\Chapter\ChapterInterface;

class CreateChapterForm {
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
	 * Chapter Repository
	 * @var \MetaQuiz\Repo\Chapter\ChapterInterface
	 */
	protected $chapter;

	/**
	 * Constructor
	 */
	public function __construct(CreateChapterFormValidator $validator, ChapterInterface $chapter) {
		$this -> validator = $validator;
		$this -> chapter = $chapter;
	}

	/**
	 * Create a new Chapter
	 * @param array Input data to be saved
	 * @return bool
	 */
	public function create(array $input) {
		if (!$this -> valid($input)) {
			return false;
		}
		return $this -> chapter -> create($input);
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
