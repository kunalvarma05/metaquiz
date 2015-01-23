<?php
namespace MetaQuiz\Repositories\Challenge;

interface ChallengeInterface {

	/**
	 * all Fetch all the Challenges
	 * @param  array $with Related Models for Eager Loading
	 * @return Object The Challenge Collection
	 */
	public function all($with = array());

	/**
	 * byID Find Challenge by ID
	 * @param  Integer $id   The ID of the Challenge
	 * @param  array  $with Related Models for Eager Loading
	 * @return Object The Challenge Collection
	 */
	public function byID($id, $with = array());

	/**
	 * requireByID Get a single Challenge by ID and show if not found
	 * @param Integer ID of the Challenge
	 * @param Array $with [Related Models for Eager Loading]
	 * @return Object Challenge Collection
	 */
	public function requireByID($id, $with = array());

	/**
	 * create Create a Challenge
	 * @param Array $input Input Data to be stored
	 * @return The Newly created Challenge Model Instance
	 */
	public function create(array $input);

}
