<?php
namespace MetaQuiz\Repositories\Challenge;

use MetaQuiz\Repositories\RepositoryInterface;

interface ChallengeInterface extends RepositoryInterface {

	/**
	 * byQuizID Find Challenge by QuizID
	 * @param  Integer $quiz_id   The QuizID of the Challenge
	 * @param  array  $with Related Models for Eager Loading
	 * @return Object The Challenge Collection
	 */
	public function byQuizID($quiz_id, $with = array());

}
