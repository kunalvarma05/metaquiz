<?php

class FriendRequest extends \Eloquent {

	protected $fillable = array("status","user_id","sender_id");

	/**
	 * The user who sent the friend request
	 * @return Eloquent Collection
	 */
	public function sender(){
		$this->belongsTo("User","sender_id");
	}

	/**
	 * The user who rec'd the friend request
	 * @return Eloquent Collection
	 */
	public function user(){
		$this->belongsTo("User","user_id");
	}
}