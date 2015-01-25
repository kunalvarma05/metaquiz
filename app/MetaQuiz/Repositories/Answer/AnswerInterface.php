<?php
namespace MetaQuiz\Repositories\Answer;

interface AnswerInterface {

	/**
	 * all Fetch all the Answers
	 * @param  array $with Related Models for Eager Loading
	 * @return Object The Answer Collection
	 */
	public function all($with = array());

	/**
	 * byID Find Answer by ID
	 * @param  Integer $id   The ID of the Answer
	 * @param  array  $with Related Models for Eager Loading
	 * @return Object The Answer Collection
	 */
	public function byID($id, $with = array());

	/**
	 * requireByID Get a single Answer by ID and show if not found
	 * @param Integer ID of the Answer
	 * @param Array $with [Related Models for Eager Loading]
	 * @return Object Answer Collection
	 */
	public function requireByID($id, $with = array());

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

	/**
	 * create Create a Answer
	 * @param Array $input Input Data to be stored
	 * @return The Newly created Answer Model Instance
	 */
	public function create(array $input);

}
