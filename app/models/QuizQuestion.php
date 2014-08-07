<?php

class QuizQuestion extends \Eloquent {
	protected $fillable = array();

	protected $table = "question_quiz";

	//Question
	public function question() {
		return $this -> belongsTo('Question');
	}

	//Quiz
	public function quiz() {
		return $this -> hasOne('Quiz', 'quiz_id');
	}

	//Answers
	public function answers() {
		return $this -> hasOne('Answer', 'quiz_question_id');
	}

}
