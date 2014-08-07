<?php

class Stat extends \Eloquent {
	protected $fillable = array();
	
	//User
	public function user() {
		return $this -> belongsTo('User');
	}
}
