<?php
use MetaQuiz\Repositories\User\UserInterface;
use MetaQuiz\Repositories\Organization\OrganizationInterface;
use MetaQuiz\Repositories\Course\CourseInterface;
use MetaQuiz\Repositories\Subject\SubjectInterface;
use MetaQuiz\Repositories\Challenge\ChallengeInterface;

class ChallengeController extends \BaseController {

	//The User Interface Object
	private $user;

	//The Organization Interface Object
	private $organization;

	//The Course Interface Object
	private $course;

	//The Subject Interface Object
	private $subject;

	public function __construct(UserInterface $user, ChallengeInterface $challenge){
		$this->user = $user;
		$this->challenge = $challenge;
		// $this->organization = $organization;
		// $this->course = $course;
		// $this->subject = $subject;
	}

	/**
	 * Create a challenge
	 * @return Response
	 */
	public function create(){
		//Fetch the input
		$input = Input::only('friends', 'quiz_id');
		$quiz_id = $input['quiz_id'];

		//Find and verify the authenticated user
		$user = $this->user->requireByID(Auth::user()->id);

		//Find and verify the quiz submitted
		$quiz = $user->quizes()->find($quiz_id);

		//Find and check if this quiz is already part of a challenge
		$challenge = $this->challenge->getFirstBy('quiz_id', $quiz->id);

		//Check if the challenge exists
		if(!$challenge){
			//The Challene doesn't exist
			//Create the challenge
			$data = array('status' => "ongoing", 'challenger_id' => $user->id, 'quiz_id' => $quiz->id);
			$challenge = $this->challenge->create($data);

			//Attach the current quiz to the challenge
			$challenge->quizes()->attach($quiz->id);
		}

		//Send the requests to all the users
		$requests = array();

		//Traverse over all the friends selected
		foreach($input['friends'] as $friend){
			//Check if the friend has already been requested
			if(!$challenge->requests()->where('user_id', $friend)->first()){
				//No request was sent, so
				//Find and verify the user
				$u = $this->user->requireByID($friend);
				//If the user exists
				if($u){
					//Send a ChallengeRequest
					$requests[] = new ChallengeRequest(array('status' => "pending", 'user_id' => $friend));
				}
			}
		}

		//Associate the created requests with the challenge
		$challenge->requests()->saveMany($requests);

		return $challenge->requests;
	}
}