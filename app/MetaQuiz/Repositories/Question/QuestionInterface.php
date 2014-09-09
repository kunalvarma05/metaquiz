<?php
namespace MetaQuiz\Repositories\Question;

interface QuestionInterface {

	/**
	 * all Fetch all the Questions
	 * @param  array $with Related Models for Eager Loading
	 * @return Object The Question Collection
	 */
	public function all($with = array());

	/**
	 * byID Find Question by ID
	 * @param  Integer $id   The ID of the Question
	 * @param  array  $with Related Models for Eager Loading
	 * @return Object The Question Collection
	 */
	public function byID($id, $with = array());

	/**
	 * requireByID Get a single Question by ID and show if not found
	 * @param Integer ID of the Question
	 * @param Array $with [Related Models for Eager Loading]
	 * @return Object Question Collection
	 */
	public function requireByID($id, $with = array());

	/**
	 * create Create a Question
	 * @param Array $input Input Data to be stored
	 * @return The Newly created Question Model Instance
	 */
	public function create(array $input);

}
