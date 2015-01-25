<?php
namespace MetaQuiz\Repositories\Quiz;

interface QuizInterface {

	/**
	 * all Fetch all the Quizs
	 * @param  array $with Related Models for Eager Loading
	 * @return Object The Quiz Collection
	 */
	public function all($with = array());

	/**
	 * byID Find Quiz by ID
	 * @param  Integer $id   The ID of the Quiz
	 * @param  array  $with Related Models for Eager Loading
	 * @return Object The Quiz Collection
	 */
	public function byID($id, $with = array());

	/**
	 * requireByID Get a single Quiz by ID and show if not found
	 * @param Integer ID of the Quiz
	 * @param Array $with [Related Models for Eager Loading]
	 * @return Object Quiz Collection
	 */
	public function requireByID($id, $with = array());

	/**
	 * byUserID Get a Single Quiz by UserID
	 * @param string $user_id UserID of the Quiz
	 * @return Object Quiz Collection
	 */
	public function byUserID($user_id, $with = array());

	/**
	 * create Create a Quiz
	 * @param Array $input Input Data to be stored
	 * @return The Newly created Quiz Model Instance
	 */
	public function create(array $input);

}
