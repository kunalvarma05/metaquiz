<?php

class Quiz extends \Eloquent {
	protected $fillable = array();

	//Table
	protected $table = "quizes";

	/**
	 * Questions
	 * All the questions asked in the quiz
	 * @return Questions Collection
	 */
	public function questions() {
		return $this -> belongsToMany('Question');
	}

	/**
	 * QuizQuestions
	 * All the questions the user has given answer to
	 * @return QuizQuestions Collection
	 */
	public function quizQuestions() {
		return $this -> hasMany('quizQuestion');
	}

	/**
	 * Challenge
	 * The Challenge, this quiz is part of
	 * @return Challenge Collection
	 */
	public function challenge() {
		return $this -> belongsTo('Challenge');
	}

}
