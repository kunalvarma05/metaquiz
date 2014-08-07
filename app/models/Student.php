<?php

class Student extends \Eloquent {
	protected $fillable = array();

	public $timestamps = false;
	//User
	public function user() {
		return $this -> morphOne('User', 'accountable');
	}

}
