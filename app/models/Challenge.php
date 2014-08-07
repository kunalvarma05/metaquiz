<?php

class Challenge extends \Eloquent {
	protected $fillable = array();

	protected $table = "challenges";

	/**
	 * Users
	 * All the users who have been challenged for this challenge
	 * @return Users Collection
	 */
	public function users() {
		return $this -> belongsToMany('User');
	}

	/**
	 * Challenger
	 * The User who has challenged
	 * @return Challenger Collection
	 */
	public function challenger() {
		return $this -> belongsTo('User', 'challenger_id');
	}

	/**
	 * Quiz
	 * The Quiz, part of this Challenge
	 * @return Quiz Collection
	 */
	public function quiz() {
		return $this -> hasOne('Quiz');
	}

}
