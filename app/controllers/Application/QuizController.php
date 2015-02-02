<?php
use MetaQuiz\Repositories\User\UserInterface;
use MetaQuiz\Repositories\Quiz\QuizInterface;
use MetaQuiz\Repositories\Answer\AnswerInterface;
use MetaQuiz\Service\Process\Quiz\QuizProcessInterface;
use MetaQuiz\Repositories\QuestionQuiz\QuestionQuizInterface;

class QuizController extends \BaseController {

	//The User Interface Object
	private $user;

	//The Quiz Interface Object
	private $quiz;

	//The Answer Interface Object
	private $answer;

	//The QuestionQuiz Interface Object
	private $question_quiz;

	//The QuizProcess Object
	private $quizProcess;

	public function __construct(UserInterface $user, QuizInterface $quiz, QuestionQuizInterface $question_quiz, QuizProcessInterface $quizProcess){
		$this->user = $user;
		$this->quiz = $quiz;
		$this->question_quiz = $question_quiz;
		$this->quizProcess = $quizProcess;
	}

	/**
	 * Display a listing of the quiz.
	 * GET /application/quiz
	 *
	 * @return Response
	 */
	public function index()
	{
		$quizzes = Auth::user()->quizes;
		$pageTitle = "Your Quiz List";
		return View::make('app.quiz.index', compact('pageTitle','quizzes'));
	}

	/**
	 * Show the form for creating a new quiz.
	 * GET /application/quiz/create
	 *
	 * @return Response
	 */
	public function create($course_id, $subject_id)
	{
		//Get the logged in user
		$user = Auth::user();
		//Get the Organization of the logged in user
		$organization = $user->organization;
		//Find the course
		$course = $organization->courses()->findOrFail($course_id);
		//Find the subject
		$subject = $course->subjects()->findOrFail($subject_id);
		//Chapters
		$chapters = array();
		foreach ($subject->chapters as $chapter) {
			$chapters[$chapter->id] = $chapter->name;
		}
		//Page Title
		$pageTitle = "Start a New Quiz";

		//Make the response
		return View::make('app.quiz.new', compact('pageTitle', 'organization', 'course', 'subject', 'chapters'));
	}

	/**
	 * Store a newly created quiz in storage.
	 * POST /application/quiz
	 *
	 * @return Response
	 */
	public function generate()
	{
		//The Input
		$input = Input::only('chapters');

		//ID of the logged in user
		$user_id = Auth::user()->id;

		//IDs of the chapters to be included in the quiz
		$chapter_ids = $input['chapters'];

		//Generate
		$quiz = $this->quizProcess->generate($user_id, $chapter_ids);

		//If the quiz was generated
		if($quiz){
			//Fire the quiz play event
			$data = array('message' => "started playing a", 'user_id' => Auth::user()->id, 'quiz_id' => $quiz->id);
			Event::fire('quiz.play', array($data));
			//Redirect the user to the play quiz page
			return Redirect::to(URL::route('app.quiz.play', array($quiz->id)));
		}else{
			App::abort(500, "Unable to generate quiz!");
		}
	}

	/**
	 * Display the specified quiz.
	 * GET /application/quiz/{quiz_id}
	 *
	 * @param  int  $quiz_id
	 * @return Response
	 */
	public function play($quiz_id)
	{
		$quiz = Auth::user()->quizes()->findOrFail($quiz_id);
		$marks = $quiz->marks;
		$pageTitle = "Play Quiz";
		$bodyClass = "play-quiz-body";
		return View::make('app.quiz.play', compact('pageTitle','quiz','bodyClass', 'marks'));
	}

	/**
	 * Generate results of a Quiz
	 * @return Response
	 */
	public function result($quiz_id){
		//Find the user
		$user = Auth::user();
		//Check if the quiz is unfinished
		$quiz = $user->quizes()->where('status','finished')->findOrFail($quiz_id);
		//If the quiz was finished
		if($quiz){
			//All the questions asked
			$questions_asked = $this->question_quiz->make(array("question", "question.options", "answer"))->where("quiz_id",$quiz->id)->where("is_answered", "=", 1)->get();

			//Friends of the user
			$friends = $this->user->getFriends($user->id);
			//Friend List
			$friend_list = friend_list($friends);

			$bodyClass = "play-quiz-body";

			$pageTitle = "Quiz Result";

			//Marks per question
			$marksPerQuestion =  array_fetch($questions_asked->toArray(), 'answer.marks');
			return View::make('app.quiz.result')->with(compact('quiz', 'questions_asked', 'friends', 'friend_list', 'bodyClass', 'pageTitle', 'marksPerQuestion'));
		}
	}

	/**
	 * Get an Unanswered Question from the given quiz
	 * @return Questions Collection
	 */
	public function getQuestion(){
		//QuizID
		$quiz_id = Input::get("quiz_id");
		//Find the user
		$user = Auth::user();

		//Fetch the next unanswered question
		$question_asked = $this->quizProcess->getNextQuestion($user->id, $quiz_id);

		//If the question was found
		if($question_asked){
			return $question_asked->toArray();
		}else{
			//Finish
			if($this->quizProcess->finish($user->id, $quiz_id)){
				//No questions left to answer
				return array("all_answered" => true);
			}else{
				//Error!
				return array("Cannot mark quiz as complete!");
			}
		}
	}

	/**
	 * Check the answer submitted my the user
	 * @return Response
	 */
	public function checkAnswer(){
		//Input Data
		$input = Input::only(array('quiz_id', 'option_id', 'question_id', 'time_remaining'));

		//Marks per question
		$input['marks_per_question'] = Config::get("metaquiz.marks_per_question");

		//Time per question
		$time_per_question = Config::get("metaquiz.time_per_question");

		//Time taken
		$input['time_taken'] = $time_per_question - $input['time_remaining'];

		//Attempted
		$input['attempted'] = true;

		//Check the answer
		$response = $this->quizProcess->checkAnswer(Auth::user()->id, $input);

		//Return the response
		return $response;
	}


	/**
	 * Check the answer submitted my the user
	 * @return Response
	 */
	public function noAnswerChosen(){
		//Input Data
		$input = Input::only(array('quiz_id', 'option_id', 'question_id', 'time_remaining'));

		//Marks per question
		$input['marks_per_question'] = Config::get("metaquiz.marks_per_question");

		//Time per question
		$time_per_question = Config::get("metaquiz.time_per_question");

		//Time taken
		$input['time_taken'] = $time_per_question - $input['time_remaining'];

		//Attempted
		$input['attempted'] = false;

		//Check the answer
		$response = $this->quizProcess->checkAnswer(Auth::user()->id, $input);

		//Return the response
		return $response;
	}

}