<?php
namespace MetaQuiz\Service\Form\Chapter;

use MetaQuiz\Repositories\Chapter\ChapterInterface;

class UpdateChapterForm {
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
	public function __construct(UpdateChapterFormValidator $validator, ChapterInterface $chapter) {
		$this -> validator = $validator;
		$this -> chapter = $chapter;
	}

	/**
	 * Update an Chapter
	 * @param integer ID of the Chapter
	 * @param array Input data to be saved
	 * @return bool
	 */
	public function update($id, array $input) {
		if (!$this -> valid($input)) {
			return false;
		}
		$chapter = $this -> chapter -> requireByID($id);
		return $chapter -> update($input);
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
