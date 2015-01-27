<?php
use MetaQuiz\Repositories\User\UserInterface;
use MetaQuiz\Repositories\Quiz\QuizInterface;
use MetaQuiz\Repositories\Challenge\ChallengeInterface;
use MetaQuiz\Service\Process\Quiz\QuizProcessInterface;
use MetaQuiz\Repositories\QuestionQuiz\QuestionQuizInterface;
use MetaQuiz\Service\Process\Challenge\ChallengeProcessInterface;
use MetaQuiz\Repositories\ChallengeRequest\ChallengeRequestInterface;

class ChallengeController extends \BaseController {

	//The User Interface Object
	private $user;

	//The ChallengeRequest Object
	private $challengeRequest;

	//The Challenge Interface Object
	private $challenge;

	//The Quiz Interface Object
	private $quiz;

	//The QuestionQuiz Interface Object
	private $question_quiz;

	//The QuizProcess Object
	private $quizProcess;

	//The ChallengeProcess Object
	private $challengeProcess;

	/**
	 * The Constructor
	 * @param UserInterface             $user
	 * @param ChallengeInterface        $challenge
	 * @param ChallengeRequestInterface $challengeRequest
	 * @param QuizInterface             $quiz
	 * @param QuestionQuizInterface     $question_quiz
	 * @param QuizProcessInterface      $quizProcess
	 * @param ChallengeProcessInterface $challengeProcess
	 */
	public function __construct(UserInterface $user, ChallengeInterface $challenge, ChallengeRequestInterface $challengeRequest, QuizInterface $quiz, QuestionQuizInterface $question_quiz, QuizProcessInterface $quizProcess, ChallengeProcessInterface $challengeProcess){
		$this->user = $user;
		$this->quiz = $quiz;
		$this->challenge = $challenge;
		$this->quizProcess = $quizProcess;
		$this->challengeProcess = $challengeProcess;
		$this->question_quiz = $question_quiz;
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

		//Check if the challenge doesn't exists
		if(!$challenge){
			//The Challene doesn't exist, therefore
			//Create the challenge
			$data = array('status' => "ongoing", 'challenger_id' => $user->id, 'quiz_id' => $quiz->id, 'winner_id' => $user->id);
			$challenge = $this->challenge->create($data);

			//Attach the challenger to the challenge as a player
			$challenge->users()->attach($user->id);
			//Associate the current quiz to the challenge
			$challenge->quizes()->save($quiz);
		}

		$addPlayers = $this->challengeProcess->addPlayers($challenge, $input['friends']);

		if(!$addPlayers){
			App::abort(500);
		}

		//Redirect to the created challenge's page
		return Redirect::route('app.challenges.show', array($challenge->id));
	}

	/**
	 * Add Players to a Challenge
	 * @return Response
	 */
	public function addPlayers(){
		//Input
		$input = Input::only('friends','challenge_id');

		//Authorized User
		$user = $this->user->requireByID(Auth::user()->id);

		//Challenge created by the user
		$challenge = $user->challenges->find($input['challenge_id']);

		//Error!
		if(!$challenge){
			App::abort(500);
		}

		//Add players to the challenge
		$addPlayers = $this->challengeProcess->addPlayers($challenge, $input['friends'], $user);

		//If there was an error
		if(!$addPlayers){
			App::abort(500);
		}

		//Redirect Back
		return Redirect::route('app.challenges.show', array($challenge->id));
	}



	/**
	 * Show a sinlge challenge
	 * @return Response
	 */
	public function show($id){
		//Authorized user
		$user = $this->user->requireByID(Auth::user()->id);
		//The Challenge
		$challenge = $user->challenges->find($id);

		//Not yet part of the challenge
		if(!$challenge){
			return Redirect::route('app.challenges');
		}

		//All the quizes part of the challenge
		$quizes = $challenge->quizes()->where('status','finished')->get();

		//Questions Asked
		$questions_asked = array();
		//Marks per question
		$marksandLabels =  array();

		//Aggregate quiz questions
		foreach ($quizes as $quiz) {
			//Question Asked
			$question_asked = $this->question_quiz->make(array("question", "question.options", "answer"))->where("quiz_id",$quiz->id)->where("is_answered", "=", 1)->get();
			//All the questions asked
			$questions_asked[] = $question_asked;
			//Label and Marks
			$marksandLabels[] = array('label' => $quiz->user->name, 'points' => array_fetch($question_asked->toArray(), 'answer.marks'));
		}
		$players = $challenge->users;
		$status = $challenge->status;
		$challenger = $challenge->challenger;
		$winner = $challenge->winner ? $challenge->winner->name : "-";
		$friends = $this->user->getFriends($user->id);
		$friend_list = friend_list($friends);
		$pageTitle = "Quiz Challenge";

		return View::make('app.quiz.challenge.show')->with(compact('challenge','pageTitle','status','challenger','winner','players','friend_list','quiz','marksandLabels'));
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

			//The referenceQuiz
			$referenceQuiz = $challenge->referenceQuiz;
			//Fetch chapters from the referenceQuiz
			$chapters = $referenceQuiz->chapters;
			$chapter_ids = array_pluck($chapters, 'id');

			//Fetch Questions asked in the reference quiz
			$questionsAsked = $referenceQuiz->questionsAsked;
			//Pluck the IDs of the questions asked
			$questions = array_pluck($questionsAsked, 'id');

			//Generate
			$quiz = $this->quizProcess->generate($user->id, $chapter_ids, $questions, $challenge->id);

			//If the quiz was generated
			if($quiz){
				//Attach the challenger to the challenge as a player
				$challenge->users()->attach($user->id);

				//Send the challenger the notification that the user has accepted their challenge
				$data = array(
					'message' => $user->name . " accepted your challenge.",
					'challenge_id' => $challenge->id,
					'user_id' => $challenge->challenger_id
					);

				Event::fire('challenge.accept', array($data));
				//Redirect the user to the play quiz page
				return Redirect::to(URL::route('app.quiz.play', array($quiz->id)));
			}else{
				App::abort(500, "Unable to generate quiz!");
			}
		}else{
			//Abort!
			App::abort(500, "Looks like something is wrong. Please try again later!");
		}
	}

	/**
	 * Accept a given challenge
	 * @return Response
	 */
	public function reject(){
		$id = Input::get('challenge_request_id');
		$user = Auth::user();
		$challengeRequest = $user->challengeRequests()->find($id);
		$challenge = $challengeRequest->challenge;
		$reject = $this->challengeRequest->reject($challengeRequest->id);
		//If the challenge request is marked as rejected
		if($reject){
			//Send the challenger the notification that the user has rejected their challenge
			$data = array(
				'message' => $user->name . " rejected your challenge.",
				'challenge_id' => $challenge->id,
				'user_id' => $challenge->challenger_id
				);
			Event::fire('challenge.reject', array($data));

			//Redirect the user to the play quiz page
			return Redirect::to(URL::route('app.challenges'));
		}else{
			//Abort!
			App::abort(500, "Looks like something is wrong. Please try again later!");
		}
	}
}