<?php

/**
 * The QuestionQuiz Class
 */
class QuestionQuiz extends \Eloquent {
	/**
	 * The Fillable Fields
	 */
	protected $fillable = array('status', 'type', 'user_id');

	/**
	 * The Table
	 */
	protected $table = "question_quiz";

	/**
	 * All the quizes the question is asked
	 * @return Quizes Collection
	 */
	public function quizes() {
		return $this -> belongsToMany('Quiz');
	}

	/**
	 * The Question being asked
	 */
	public function question(){
		return $this->belongsTo('Question');
	}

	/**
	 * The answer of this question given by the user
	 */
	public function answer(){
		return $this -> hasOne('Answer', 'question_quiz_id');
	}
}