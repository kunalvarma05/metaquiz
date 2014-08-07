<?php

class Option extends \Eloquent {
	protected $fillable = array();

	//Question
	public function question() {
		return $this -> belongsTo('Question', 'question_id');
	}

}
