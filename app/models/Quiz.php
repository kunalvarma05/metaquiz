<?php

/**
 * The Quiz Class
 */
class Quiz extends \Eloquent {
	/**
	 * The Fillable Fields
	 */
	protected $fillable = array();

	/**
	 * The Table
	 */
	protected $table = "quizes";

	/**
	 * All the questions asked in the quiz
	 * @return Questions Collection
	 */
	public function questions() {
		return $this -> belongsToMany('Question');
	}

	/**
	 * All the users in the quiz
	 * @return Users Collection
	 */
	public function users() {
		return $this -> belongsToMany('User');
	}

	/**
	 * All the chapters in the quiz
	 * @return Chapter Collection
	 */
	public function chapters() {
		return $this -> belongsToMany('Chapter');
	}

	/**
	 * The Result of the quiz
	 * @return Result Collection
	 */
	public function result() {
		return $this -> hasOne('Result');
	}

	/**
	 * The Challenge, this quiz is part of
	 * @return Challenge Collection
	 */
	public function challenge() {
		return $this -> belongsTo('Challenge', 'challenge_id');
	}

}
