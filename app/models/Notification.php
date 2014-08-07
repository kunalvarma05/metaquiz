<?php

class Notification extends \Eloquent {
	protected $fillable = array();

	/**
	 * The Target object of the notification
	 */
	public function targetable() {
		return $this -> morphTo();
	}

	/**
	 * User
	 * The User the notification belongs to
	 * @return User Collection
	 */
	public function user() {
		return $this -> belongsTo('User');
	}

}
