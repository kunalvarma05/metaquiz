<?php
use MetaQuiz\Repositories\User\UserInterface;
use MetaQuiz\Repositories\Organization\OrganizationInterface;
use MetaQuiz\Repositories\Course\CourseInterface;
use MetaQuiz\Repositories\Subject\SubjectInterface;
use MetaQuiz\Repositories\Challenge\ChallengeInterface;
use MetaQuiz\Repositories\ChallengeRequest\ChallengeRequestInterface;

class ChallengeController extends \BaseController {

	//The User Interface Object
	private $user;

	//The ChallengeRequest Object
	private $challengeRequest;

	//The Challenge Interface Object
	private $challenge;

	/**
	 * The Constructor
	 * @param UserInterface             $user
	 * @param ChallengeInterface        $challenge
	 * @param ChallengeRequestInterface $challengeRequest
	 */
	public function __construct(UserInterface $user, ChallengeInterface $challenge, ChallengeRequestInterface $challengeRequest){
		$this->user = $user;
		$this->challenge = $challenge;
		$this->challengeRequest = $challengeRequest;
	}

	/**
	 * Show all the challenges of the logged in user
	 * @return Response
	 */
	public function index(){
		//Find the user
		$user = $this->user->requireByID(Auth::user()->id);
		//Fetch the challenges
		$challenges = $user->challenges;
		//Fetch the challenge requests
		$challengeRequests = $user->challengeRequests()->where('status', 'pending')->get();
		//Page Title
		$pageTitle = "Challenges";
		//Make the view
		return View::make('app.quiz.challenge.index')->with(compact('user','challenges','challengeRequests','pageTitle'));
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

			//Attach the challenger to the challenge as a player
			$challenge->users()->attach($user->id);
			//Attach the current quiz to the challenge
			$challenge->quizes()->attach($quiz->id);
		}

		//Send the requests to all the users
		$requests = array();

		//Traverse over all the friends selected
		foreach($input['friends'] as $friend){
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
		$challenge->requests()->saveMany($requests);

		//Redirect to the created challenge's page
		return Redirect::route('app.challenges.show', array($challenge->id));
	}



	/**
	 * Show a sinlge challenge
	 * @return Response
	 */
	public function show($id){
		$user = $this->user->requireByID(Auth::user()->id);
		$challenge = $user->challenges->find($id);
		$players = $challenge->users;
		$status = $challenge->status;
		$challenger = $challenge->challenger;
		$winner = $challenge->winner ? $challenge->winner->name : "-";
		$friends = $this->user->getFriends($user->id);
		//$friend_list = friend_list($friends);
		$pageTitle = "Quiz Challenge";

		return View::make('app.quiz.challenge.show')->with(compact('challenge','pageTitle','status','challenger','winner','players','friend_list','quiz'));
	}


	/**
	 * Accept a given challenge
	 * @return Response
	 */
	public function accept(){
		$id = Input::get('challenge_request_id');
		$user = Auth::user();
		$challengeRequest = $user->challengeRequests()->find($id);
		$challenge = $challengeRequest->challenge;
		$accept = $this->challengeRequest->accept($challengeRequest->id);
		//If the challenge request is marked as accepted
		if($accept){
			//Attach the challenger to the challenge as a player
			$challenge->users()->attach($user->id);

			//Send the challenger the notification that the user has accepted their challenge
			$data = array(
				'message' => $user->name . " accepted your challenge.",
				'challenge_id' => $challenge->id,
				'user_id' => $challenge->challenger_id
				);
			Event::fire('challenge.accept', array($data));

			//The referenceQuiz
			$referenceQuiz = $challenge->referenceQuiz;
			//Fetch chapters from the referenceQuiz
			$chapters = $referenceQuiz->chapters;
			$chapter_ids = array_pluck($chapters, 'id');


			//Create a new Quiz
			$quiz = new Quiz;
			//Set Status as Unfinished
			$quiz->status = "unfinished";
			//Associate the user with the quiz
			$quiz->user()->associate($user);
			//Save the quiz
			$quiz->save();
			//Attach the selected chapters to the quiz
			$quiz->chapters()->sync($chapter_ids);



			//Questions to be included in the quiz
			$questionsAsked = $referenceQuiz->questionsAsked;
			$questions = array_pluck($questionsAsked, 'id');

			//Attach the aggregated questions to the quiz
			$quiz->questionsAsked()->sync($questions);
			//Redirect the user to the play quiz page
			return Redirect::to(URL::route('app.quiz.play', array($quiz->id)));
		}else{
			App::abort(500, "Looks like something is wrong. Please try again later!");
		}
	}
}