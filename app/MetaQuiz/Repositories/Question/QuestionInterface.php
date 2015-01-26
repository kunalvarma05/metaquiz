<?php
namespace MetaQuiz\Repositories\Question;

use MetaQuiz\Repositories\RepositoryInterface;

interface QuestionInterface extends RepositoryInterface {

	/**
	 * byChapterID Find Question by ChapterID
	 * @param  Integer $chapter_id   The ChapterID of the Question
	 * @param  array  $with Related Models for Eager Loading
	 * @return Object The Question Collection
	 */
	public function byChapterID($chapter_id, $with = array());

}
