<?php

class Activity extends \Eloquent {
	/**
	 * The Fillable Fields
	 */
	protected $fillable = array('message','targetable_id', 'targetable_type', 'user_id', 'type');

	/**
	 * The Target of activity
	 * @return Eloquent Collection
	 */
	public function targetable() {
		return $this -> morphTo();
	}

	/**
	 * The user the activity belongs to
	 * @return Organization Collection
	 */
	public function user() {
		return $this -> belongsTo('User');
	}

}
