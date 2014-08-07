<?php

class Question extends \Eloquent {
	protected $fillable = array();

	//Chapter
	public function chapter() {
		return $this -> belongsTo('Chapter', 'chapter_id');
	}

	//Options
	public function options() {
		return $this -> hasMany('Option', 'question_id');
	}

	//Quizes
	public function quizes() {
		return $this -> belongsToMany('Quiz');
	}

	public function answer() {
		return $this -> hasMany('Answer');
	}

	//Quiz Question
	public function quizQuestion() {
		return $this -> hasMany('quizQuestion');
	}

}
