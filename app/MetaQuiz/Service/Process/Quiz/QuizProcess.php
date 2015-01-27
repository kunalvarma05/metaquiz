<?php namespace MetaQuiz\Service\Process\Quiz;

use \Event;
use MetaQuiz\Repositories\User\UserInterface;
use MetaQuiz\Repositories\Quiz\QuizInterface;
use MetaQuiz\Repositories\Answer\AnswerInterface;

class QuizProcess implements QuizProcessInterface{

	//The User Interface Object
	private $user;

	//The Quiz Interface Object
	private $quiz;

	//The Answer Interface Object
	private $answer;

	/**
	 * The Constructor
	 * @param UserInterface   $user
	 * @param QuizInterface   $quiz
	 * @param AnswerInterface $answer
	 */
	public function __construct(UserInterface $user, QuizInterface $quiz, AnswerInterface $answer){
		$this->user = $user;
		$this->quiz = $quiz;
		$this->answer = $answer;
	}

	/**
	 * Generate Quiz
	 * @param  int $user_id     ID of a user
	 * @param  array  $chapter_ids ID's of chapters to be included in the quiz
	 * @param array $question_ids ID's of questions to be included in the quiz
	 * @param int $challenge_id ID of the challenge
	 * @return Quiz              Newly created quiz
	 */
	public function generate($user_id, $chapter_ids = array(), $question_ids = array(), $challenge_id = NULL){

		//Create a new Quiz
		$quiz = $this->quiz->create(array(
			'status' => "unfinished",
			'user_id' => $user_id,
			'marks' => "0",
			'challenge_id' => $challenge_id
			));

		//Attach the selected chapters to the quiz
		$quiz->chapters()->sync($chapter_ids);

		//If no questions are given, generate from given chapters
		if(empty($question_ids)){
			//Fetch 5 random questions each from the selected chapters
			$chapters = $quiz->chapters()->with(array('questions' => function($query){
				$query->orderByRaw('RAND()')->take(5)->get();
			}))->get();

			//Questions to be included in the quiz
			$question_ids = array();

			//Aggregate the IDs from the questions
			foreach ($chapters as $chapter) {
				foreach ($chapter->questions as $question) {
					$question_ids[] = $question->id;
				}
			}
		}


		//Attach the aggregated questions to the quiz
		$quiz->questionsAsked()->sync($question_ids);

		//Return the created quiz
		return $quiz;
	}


	/**
	 * Get the next unanswered question
	 * @param  int $user_id ID of a user
	 * @param  int $quiz_id ID of a quiz
	 * @return Question The question to be asked
	 */
	public function getNextQuestion($user_id, $quiz_id){

		//Get the quiz
		$quiz = $this->user->requireByID($user_id)->quizes()->findOrFail($quiz_id);

		//Fetch an unanswered question along with it's options
		$question_asked = $quiz->questionsAsked()->wherePivot("is_answered", "<>", 1)->with(array("options" => function($query){
			$query->orderByRaw('RAND()');
		}))->first();

		//Return the question
		return $question_asked;
	}


	/**
	 * Check the answer
	 * @param  int $user_id ID of a user
	 * @param  array  $input   An array of input values
	 * @return array          Generated response
	 */
	public function checkAnswer($user_id, $input = array()){
		//Marks per question
		$marks_per_question = $input['marks_per_question'];

		//Input Data
		$quiz_id = $input["quiz_id"];
		$option_id = $input["option_id"];
		$question_id = $input["question_id"];
		$time_taken = $input["time_taken"];
		$attempted = $input['attempted'];
		$marks = ($marks_per_question-$time_taken);
		$marks = ($marks <= 0) ? 0 : $marks;

		//The Response
		$response = array("is_correct" => "", "marks" => "0", "error" => false);

		//Get the given quiz of the given user
		$quiz = $this->user->requireByID($user_id)->quizes()->findOrFail($quiz_id);

		//Find the Question Asked, which is unanswered
		$question = $quiz->questionsAsked()->wherePivot("is_answered", "<>", 1)->wherePivot('question_id', $question_id)->withPivot('id')->first();

		//Find the selected option
		$option = $question->options()->findOrFail($option_id);

		//If the answer is correct
		//and attempted
		if($option->is_answer && $attempted){
			//Set the answer as correct
			$response['is_correct'] = true;
			//Give the marks
			$response['marks'] = $marks;
		}else{
			//If the answer is incorrect
			//or unattempted
			$response['is_correct'] = false;
			$marks = 0;
			$response['marks'] = 0;
		}

		//Gather the data
		$data = array(
			'user_id' => $user_id,
			'quiz_id' => $quiz_id,
			'option_id' => $option_id,
			'question_quiz_id' => $question->pivot->id,
			'time_taken' => $time_taken,
			'marks' => $marks,
			'attempted' => $attempted
			);

		//Create the answer
		$answer = $this->answer->create($data);

		//If the answer was created
		if($answer){

			//Set total marks on the quiz
			$quiz->marks = $quiz->marks + $marks;

			//Save the quiz
			if(!$quiz->save()){
				$response['error'] = "Looks like there is something wrong. Please try again!";
			}

			//Set the question asked as answered
			$update = $quiz->questionsAsked()->updateExistingPivot($question->id, array('is_answered' => 1));

			//If the question asked is not saved
			if(!$update){
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
	 * Finish the quiz
	 * @param  int $user_id ID of a user
	 * @param  int  $quiz_id ID of a quiz
	 * @return Boolean
	 */
	public function finish($user_id, $quiz_id){

		//Get the given quiz of the given user
		$quiz = $this->user->requireByID($user_id)->quizes()->findOrFail($quiz_id);

		//Mark the quiz as finished
		$quiz->status = "finished";

		//Save the quiz
		if(!$quiz->save()){
			//Error saving quiz
			return false;
		}

		//Challenge, the quiz belongs to
		$challenge = $quiz->challenge;

		//If the quiz is part of a challenge
		if($challenge){
			//Quiz of the current winner of the challenge
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
			return $challenge->save() ? $quiz : false;
		}else{
			return $quiz;
		}
	}
}