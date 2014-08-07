<?php

class Chapter extends \Eloquent {
	protected $fillable = array();

	//Subject
	public function subject() {
		return $this -> belongsTo('Subject', 'subject_id');
	}

	//Questions
	public function questions() {
		return $this -> hasMany('Questions', 'chapter_id');
	}

}
