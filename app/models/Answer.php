<?php

class Answer extends \Eloquent {
	protected $fillable = array();

	//Quiz Questions
	public function quizQuestion() {
		return $this -> belongsTo('QuizQuestion', 'quiz_question_id');
	}

	//Answerer
	public function answerer() {
		return $this -> belongsTo('User', 'user_id');
	}

	//Option
	public function option() {
		return $this -> belongsTo('Option', 'option_id');
	}

}
