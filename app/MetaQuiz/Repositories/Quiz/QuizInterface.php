<?php
namespace MetaQuiz\Repositories\Quiz;

use MetaQuiz\Repositories\RepositoryInterface;

interface QuizInterface extends RepositoryInterface{

	/**
	 * byUserID Get a Single Quiz by UserID
	 * @param string $user_id UserID of the Quiz
	 * @return Object Quiz Collection
	 */
	public function byUserID($user_id, $with = array());

}
