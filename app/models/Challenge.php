<?php
/**
 * The Challenge Class
 */
class Challenge extends \Eloquent {
	/**
	 * The fillable fields
	 */
	protected $fillable = array();

	/**
	 * The Table
	 */
	protected $table = "challenges";

	/**
	 * Users
	 * All the users who have been challenged for this challenge
	 * @return User Collection
	 */
	public function users() {
		return $this -> belongsToMany('User');
	}

	/**
	 * Challenger
	 * The User who has challenged
	 * @return User Collection
	 */
	public function challenger() {
		return $this -> belongsTo('User', 'challenger_id');
	}

	/**
	 * Opponent
	 * The User who has been challenged
	 * @return User Collection
	 */
	public function opponent() {
		return $this -> belongsTo('User', 'opponent_id');
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
