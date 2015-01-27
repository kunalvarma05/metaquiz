<?php

class Answer extends \Eloquent {
	/**
	 * The fillable fields
	 */
	protected $fillable = array("quiz_id","question_quiz_id","user_id","option_id", 'time_taken', 'marks', 'attempted');

	/**
	 * The Quiz this answer belongs to
	 * @return Quiz Collection
	 */
	public function quiz() {
		return $this -> belongsTo('Quiz', 'quiz_id');
	}

	/**
	 * The QuizQuestion for this answer
	 * @return QuizQuestion Collection
	 */
	public function quizQuestion() {
		return $this -> belongsTo('QuestionQuiz', 'question_quiz_id');
	}

	/**
	 * The User who gave the answer
	 * @return User Collection
	 */
	public function user() {
		return $this -> belongsTo('User', 'user_id');
	}

	/**
	 * The Option selected by the user
	 * @return Option Collection
	 */
	public function option() {
		return $this -> belongsTo('Option', 'option_id');
	}

}
