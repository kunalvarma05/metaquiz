<?php

class Achievement extends \Eloquent {
	protected $fillable = array();
	
	//Users
	public function users() {
		return $this -> belongsToMany('User');
	}
}