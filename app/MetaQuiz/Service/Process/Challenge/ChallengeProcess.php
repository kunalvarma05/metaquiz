<?php namespace MetaQuiz\Service\Process\Challenge;

use \Event;
use MetaQuiz\Repositories\User\UserInterface;
use MetaQuiz\Repositories\ChallengeRequest\ChallengeRequestInterface;

class ChallengeProcess implements ChallengeProcessInterface{

	//The User Interface Object
	private $user;

	//The ChallengeRequest Object
	private $challengeRequest;

	/**
	 * The Constructor
	 * @param UserInterface   $user
	 * @param ChallengeRequestInterface   $challengeRequest
	 */
	public function __construct(UserInterface $user, ChallengeRequestInterface $challengeRequest){
		$this->user = $user;
		$this->challengeRequest = $challengeRequest;
	}

	/**
	 * Add Players to the Challenge
	 * @param Challenge $challenge
	 * @param array $friend_ids IDs of the friends to add to the challenge
	 * @param array $user
	 * @return Object Saved Challenge Requests
	 */
	public function addPlayers($challenge, $friend_ids, $user){
		//Send the requests to all the users
		$requests = array();

		//Traverse over all the friends selected
		foreach($friend_ids as $friend){
			//Check if the friend has already been requested
			if(!$challenge->requests()->where('user_id', $friend)->first()){
				//No request was sent, so:
				//Find and verify the user
				$u = $this->user->requireByID($friend);
				//If the user exists
				if($u){
					//Send a ChallengeRequest
					$requests[] = $this->challengeRequest->create(array('status' => "pending", 'challenge_id' => $challenge->id, 'user_id' => $friend));
					//Send a notification as well
					$data = array( 'message' => $user->name . " challenged you for a quiz.", 'challenge_id' => $challenge->id, 'user_id' => $u->id);
					Event::fire( 'challenge.create', array( $data ) );
				}
			}
		}

		//Associate the created requests with the challenge
		return $challenge->requests()->saveMany($requests);
	}

}