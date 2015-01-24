<?php
namespace MetaQuiz\Repositories\ChallengeRequest;

interface ChallengeRequestInterface {

	/**
	 * all Fetch all the ChallengeRequests
	 * @param  array $with Related Models for Eager Loading
	 * @return Object The ChallengeRequest Collection
	 */
	public function all($with = array());

	/**
	 * byID Find ChallengeRequest by ID
	 * @param  Integer $id   The ID of the ChallengeRequest
	 * @param  array  $with Related Models for Eager Loading
	 * @return Object The ChallengeRequest Collection
	 */
	public function byID($id, $with = array());

	/**
	 * requireByID Get a single ChallengeRequest by ID and show if not found
	 * @param Integer ID of the ChallengeRequest
	 * @param Array $with [Related Models for Eager Loading]
	 * @return Object ChallengeRequest Collection
	 */
	public function requireByID($id, $with = array());

	/**
	 * create Create a ChallengeRequest
	 * @param Array $input Input Data to be stored
	 * @return The Newly created ChallengeRequest Model Instance
	 */
	public function create(array $input);

}
