<?php
/**
 * The ChallengeRequest Class
 */
class ChallengeRequest extends \Eloquent {
	/**
	 * The fillable fields
	 */
	protected $fillable = array('status', 'challenge_id', 'user_id');

	/**
	 * The Table
	 */
	protected $table = "challenge_request";


}