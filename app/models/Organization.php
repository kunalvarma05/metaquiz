<?php

class Organization extends \Eloquent {
	protected $fillable = array();

	//Students
	public function students() {
		return $this -> hasMany('User', 'organization_id') -> where('accountable_type', '=', 'Student');
	}

	//Teachers
	public function teachers() {
		return $this -> hasMany('User', 'organization_id') -> where('accountable_type', '=', 'Teacher');
	}

	//Admins
	public function admins() {
		return $this -> hasMany('User', 'organization_id') -> where('accountable_type', '=', 'Admin');
	}

	//Courses
	public function courses() {
		return $this -> hasMany('Course', 'organization_id');
	}

	//Creator
	public function creator() {
		return $this -> hasOne('User', 'creator_id');
	}

}
