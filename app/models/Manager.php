<?php

/**
 * The Manager Class
 */
class Manager extends \Eloquent {
	/**
	 * The Fillable Fields
	 */
	protected $fillable = array();

	/**
	 * The User account
	 * @return User Collection
	 */
	public function profile() {
		return $this -> morphOne('User', 'accountable');
	}

	/**
	 * The Organization the manager belongs to
	 * @return Organization Collection
	 */
	public function organization() {
		return $this -> belongsTo('Organization');
	}

}
