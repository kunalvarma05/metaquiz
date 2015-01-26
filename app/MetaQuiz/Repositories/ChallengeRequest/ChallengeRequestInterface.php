<?php
namespace MetaQuiz\Repositories\ChallengeRequest;

use MetaQuiz\Repositories\RepositoryInterface;

interface ChallengeRequestInterface extends RepositoryInterface {

	/**
	 * Accept a given challenge request
	 * @param  int $id ID of the ChallengeRequest
	 * @return Object ChallengeRequest     Collection
	 */
	public function accept($id);

	/**
	 * Reject a given challenge request
	 * @param  int $id ID of the ChallengeRequest
	 * @return Object ChallengeRequest     Collection
	 */
	public function reject($id);

}
