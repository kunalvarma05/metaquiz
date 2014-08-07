<?php

class Admin extends \Eloquent {
	protected $fillable = array();

	public $timestamps = false;
	
	public function user() {
		return $this -> morphOne('User', 'accountable');
	}

}
