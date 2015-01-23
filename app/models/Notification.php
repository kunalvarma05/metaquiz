<?php

/**
 * The Notification Class
 */
class Notification extends \Eloquent {
	/**
	 * The Fillable Fields
	 */
	protected $fillable = array('message', 'targetable_type', 'targetable_id');

	/**
	 * The Target object of the notification
	 * @return Eloquent Collection
	 */
	public function targetable() {
		return $this -> morphTo();
	}

	/**
	 * The User the notification belongs to
	 * @return User Collection
	 */
	public function user() {
		return $this -> belongsTo('User');
	}

}
