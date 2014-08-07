<?php

class Subject extends \Eloquent {
	protected $fillable = array();

	//Course
	public function course() {
		return $this -> belongsTo('Course', 'course_id');
	}

	//Chapters
	public function chapters() {
		return $this -> hasMany('Chapter', 'subject_id');
	}

}
