<?php namespace MetaQuiz\Service\Process\Challenge;

interface ChallengeProcessInterface{

	/**
	 * Add Players to the Challenge
	 * @param Challenge $challenge
	 * @param array $friend_ids IDs of the friends to add to the challenge
	 * @param array $user
	 * @return Object Saved Challenge Requests
	 */
	public function addPlayers($challenge, $friend_ids, $user);

}