<?php

class Course extends \Eloquent {
	protected $fillable = array();

	//Organization
	public function organization() {
		return $this -> belongsTo('Organization');
	}

	//Subjects
	public function subjects() {
		return $this -> hasMany('Subject', 'course_id');
	}

}
