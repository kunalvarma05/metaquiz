<?php
namespace MetaQuiz\Repositories\Answer;

use MetaQuiz\MetaQuiz\Repositories\RepositoryInterface;

interface AnswerInterface extends RepositoryInterface {

	/**
	 * byUserID Get a Single Answer by UserID
	 * @param string $user_id UserID of the Answer
	 * @return Object Answer Collection
	 */
	public function byUserID($user_id, $with = array());

	/**
	 * byQuizID Get a Single Answer by QuizID
	 * @param string $quiz_id QuizID of the Answer
	 * @return Object Answer Collection
	 */
	public function byQuizID($quiz_id, $with = array());

}
