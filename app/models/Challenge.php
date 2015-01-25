<?php
/**
 * The Challenge Class
 */
class Challenge extends \Eloquent {
	/**
	 * The fillable fields
	 */
	protected $fillable = array('status', 'challenger_id', 'quiz_id', 'winner_id');

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
	 * Winner
	 * The User who won the challenge
	 * @return User Collection
	 */
	public function winner() {
		return $this -> belongsTo('User', 'winner_id');
	}

	/**
	 * referenceQuiz
	 * The Reference Quiz of this Challenge
	 * @return Quiz Collection
	 */
	public function referenceQuiz() {
		return $this -> belongsTo('Quiz', 'quiz_id');
	}

	/**
	 * Quizes
	 * The Quizes the belong to this Challenge
	 * @return Quiz Collection
	 */
	public function quizes() {
		return $this -> hasMany('Quiz', 'challenge_id');
	}

	/**
	 * Requests
	 * The Requests that belong to this Challenge
	 * @return Quiz Collection
	 */
	public function requests() {
		return $this -> hasMany('ChallengeRequest');
	}

}
