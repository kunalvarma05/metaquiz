<?php
use MetaQuiz\Repositories\User\UserInterface;
use MetaQuiz\Repositories\Quiz\QuizInterface;
use MetaQuiz\Repositories\Answer\AnswerInterface;
use MetaQuiz\Repositories\Course\CourseInterface;
use MetaQuiz\Repositories\Subject\SubjectInterface;
use MetaQuiz\Repositories\Organization\OrganizationInterface;

class QuizController extends \BaseController {

	//The User Interface Object
	private $user;

	//The Organization Interface Object
	private $organization;

	//The Course Interface Object
	private $course;

	//The Subject Interface Object
	private $subject;

	//The Quiz Interface Object
	private $quiz;

	//The Answer Interface Object
	private $answer;

	public function __construct(UserInterface $user, OrganizationInterface $organization, CourseInterface $course, SubjectInterface $subject, QuizInterface $quiz, AnswerInterface $answer){
		$this->user = $user;
		$this->organization = $organization;
		$this->course = $course;
		$this->subject = $subject;
		$this->quiz = $quiz;
		$this->answer = $answer;
	}

	/**
	 * Display a listing of the quiz.
	 * GET /application/quiz
	 *
	 * @return Response
	 */
	public function index()
	{
		//
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
		$organization_id = $user->organization_id;
		$organization = $this->organization->requireByID($organization_id);

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

		//Find the authorize the logged in user
		$user = $this->user->requireByID(Auth::user()->id);

		//Create a new Quiz
		$quiz = $this->quiz->create(array(
			'status' => "unfinished",
			'user_id' => $user->id,
			'marks' => 0
			));

		//Attach the selected chapters to the quiz
		$quiz->chapters()->sync($input['chapters']);

		//Fetch 5 random questions each from the selected chapters
		$chapters = $quiz->chapters()->with(array('questions' => function($query){
			$query->orderByRaw('RAND()')->take(5)->get();
		}))->get();

		//Questions to be included in the quiz
		$questions = array();
		foreach ($chapters as $chapter) {
			foreach ($chapter->questions as $question) {
				$questions[] = $question->id;
			}
		}
		//Attach the aggregated questions to the quiz
		$quiz->questionsAsked()->sync($questions);

		//Redirect the user to the play quiz page
		return Redirect::to(URL::route('app.quiz.play', array($quiz->id)));
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
		$marks = 0;
		$answers = $this->answer->byQuizID($quiz->id);
		foreach ($answers as $answer) {
			$marks += $answer->marks;
		}
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
		$quiz = $user->quizes()->where("id", $quiz_id)->where('status','finished')->first();
		//If the quiz was finished
		if($quiz){
		//All the questions asked
			$questions_asked = QuestionQuiz::with(array("question", "question.options", "answer"))->where("quiz_id",$quiz->id)->where("is_answered", "=", 1)->get();
			//Friends of the user
			$friends = $this->user->getFriends($user->id);
			$friend_list = friend_list($friends);
			$bodyClass = "play-quiz-body";
			$pageTitle = "Quiz Result";
			$marksPerQuestion =  array_fetch($questions_asked->toArray(), 'answer.marks');
			return View::make('app.quiz.result')->with(compact('quiz', 'questions_asked', 'friends', 'friend_list', 'bodyClass', 'pageTitle', 'marksPerQuestion'));
		}
	}

	/**
	 * Get an Unanswered Question from the given quiz
	 * @return Questions Collection
	 */
	public function getQuestion(){
		$quiz_id = Input::get("quiz_id");
		$quiz = Auth::user()->quizes()->findOrFail($quiz_id);
		$question_asked = QuestionQuiz::where("quiz_id",$quiz->id)->where("is_answered", "<>", 1)->first();
		//If the question was found
		if($question_asked){
			//Find the Asked Question's details
			$question = Question::with(array("options" => function($query){
				$query->orderByRaw('Rand()');
			}))->findOrFail($question_asked->question_id);
			return $question->toArray();
		}else{
			//The quiz finished!
			$quiz->status = "finished";
			if($quiz->save()){
				//Finish
				if($this->finish($quiz)){
					//No questions left to answer
					return array("all_answered" => true);
				}
			}else{
				return array("Cannot mark quiz as complete!");
			}
		}
	}

	/**
	 * Check the answer submitted my the user
	 * @return Response
	 */
	public function checkAnswer(){
		//Marks per question
		$marks_per_question = Config::get("metaquiz.marks_per_question");
		//Time per question
		$time_per_question = Config::get("metaquiz.time_per_question");

		$quiz_id = Input::get("quiz_id");
		$option_id = Input::get("option_id");
		$question_id = Input::get("question_id");
		$time_remaining = Input::get("time_remaining");
		$time_taken = $time_per_question - $time_remaining;
		$marks = ($marks_per_question-$time_taken);
		$marks = ($marks <= 0) ? 0 : $marks;
		$response = array("is_correct" => "", "marks" => "0", "error" => false);

		//Find the user
		$user = User::find(Auth::user()->id);
		//Check if the quiz is unfinished
		$quiz = $user->quizes()->where('status','unfinished')->findOrFail($quiz_id);
		//Find the Question Asked which is unanswered
		$question_quiz = QuestionQuiz::where("quiz_id",$quiz->id)->where("question_id",$question_id)->where("is_answered",0)->first();
		//Find the Asked Question's details
		$question = Question::findOrFail($question_quiz->question_id);
		//Find the selected option
		$option = $question->options()->findOrFail($option_id);

		//Check if the question is already answered
		$alreadyAnswered = Answer::where("quiz_id", $quiz_id)->where('question_quiz_id',$question_quiz->id)->where("user_id", $user->id)->first();
		if($alreadyAnswered){
			$response['error'] = "Slow down buddy! You've already answered this question!";
			return $response;
		}

		//If the answer is correct
		if($option->is_answer){
				//Set the answer as correct
			$response['is_correct'] = true;
				//Give the marks
			$response['marks'] = $marks;
		}else{
				//If the answer is incorrect
			$response['is_correct'] = false;
			$marks = 0;
			$response['marks'] = 0;
		}

		//Add the answer
		$answer = new Answer;
		//Associate the user answering
		$answer->user()->associate($user);
		//Associate the answer to the quiz
		$answer->quiz()->associate($quiz);
		//Associate the option chosen
		$answer->option()->associate($option);
		//Associate the question asked
		$answer->quizQuestion()->associate($question_quiz);
		//Set the time taken
		$answer->time_taken = $time_taken;
		//Set the marks
		$answer->marks = $marks;
		//Set as attempted
		$answer->attempted= true;

		//Save the answer
		if($answer->save()){

			//Set total marks on the quiz
			$quiz->marks = $quiz->marks + $marks;

			//Save the quiz
			if(!$quiz->save()){
				$response['error'] = "Looks like there is something wrong. Please try again!";
			}

			//Set the question asked as answered
			$question_quiz->is_answered = 1;

			//If the question asked is not saved
			if(!$question_quiz->save()){
				$response['error'] = "Looks like there is something wrong. Please try again!";
			}
		}else{
			//Unable to save the answer
			$response['error'] = "Looks like there is something wrong. Please try again!";
		}
		//Return the response
		return $response;
	}


	/**
	 * Check the answer submitted my the user
	 * @return Response
	 */
	public function noAnswerChosen(){
		//Marks per question
		$marks_per_question = Config::get("metaquiz.marks_per_question");
		//Time per question
		$time_per_question = Config::get("metaquiz.time_per_question");

		$quiz_id = Input::get("quiz_id");
		$option_id = Input::get("option_id");
		$question_id = Input::get("question_id");
		$time_remaining = Input::get("time_remaining");
		$time_taken = $time_per_question - $time_remaining;
		$marks = ($marks_per_question-$time_taken);
		$marks = ($marks <= 0) ? 0 : $marks;
		$response = array("is_correct" => "", "marks" => "0", "error" => false);

		//Find the user
		$user = User::find(Auth::user()->id);
		//Check if the quiz is unfinished
		$quiz = $user->quizes()->where('status','unfinished')->findOrFail($quiz_id);
		//Find the Question Asked which is unanswered
		$question_quiz = QuestionQuiz::where("quiz_id",$quiz->id)->where("question_id",$question_id)->where("is_answered",0)->first();
		//Find the Asked Question's details
		$question = Question::findOrFail($question_quiz->question_id);
		//Find the selected option
		$option = $question->options()->findOrFail($option_id);

		//Check if the question is already answered
		$alreadyAnswered = Answer::where("quiz_id", $quiz_id)->where('question_quiz_id',$question_quiz->id)->where("user_id", $user->id)->first();
		if($alreadyAnswered){
			$response['error'] = "Slow down buddy! You've already answered this question!";
			return $response;
		}

		//If the answer is incorrect
		$response['is_correct'] = false;
		$marks = 0;
		$response['marks'] = 0;

		//Add the answer
		$answer = new Answer;
		//Associate the user answering
		$answer->user()->associate($user);
		//Associate the answer to the quiz
		$answer->quiz()->associate($quiz);
		//Associate the option chosen
		$answer->option()->associate($option);
		//Associate the question asked
		$answer->quizQuestion()->associate($question_quiz);
		//Set the time taken
		$answer->time_taken = $time_taken;
		//Set the marks
		$answer->marks = $marks;
		//Set as attempted
		$answer->attempted= false;

		//Save the answer
		if($answer->save()){
			//Set the question asked as answered
			$question_quiz->is_answered = 1;
			//If the question asked is not saved
			if(!$question_quiz->save()){
				$response['error'] = "Looks like there is something wrong. Please try again!";
			}
		}else{
			//Unable to save the answer
			$response['error'] = "Looks like there is something wrong. Please try again!";
		}
		//Return the response
		return $response;
	}

	/**
	 * Finish The Quiz
	 * @param  Eloquent $quiz Quiz Model
	 */
	private function finish($quiz){
		//Challenge, the quiz belongs to
		$challenge = $quiz->challenge;
		//If the quiz is part of a challenge
		if($challenge){
			//The current winner of the quiz
			$currentWinnerQuiz = $challenge->quizes()->where('user_id', $challenge->winner_id)->first();
			//Marks of the current winner
			$currentWinnerMarks = $currentWinnerQuiz->marks;

			//If the marks of the current user is more than that of the current winner's marks
			if($currentWinnerMarks < $quiz->marks){
				//Swap the winner
				$challenge->winner_id = $quiz->user_id;
				//Send the challenger the notification that the user won the challenge
				$data = array(
					'message' => $quiz->user->name . " won against you.",
					'challenge_id' => $challenge->id,
					'user_id' => $challenge->challenger_id
					);
				Event::fire('challenge.winner', array($data));
			}
			//Save the challenge
			return $challenge->save();
		}else{
			return true;
		}
	}

}