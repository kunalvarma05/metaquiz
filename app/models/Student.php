<?php

/**
 * The Student Class
 */
class Student extends \Eloquent {
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
	 * The Organization the student belongs to
	 * @return Organization Collection
	 */
	public function organization() {
		return $this -> belongsTo('Organization');
	}

	/**
	 * The Activation
	 * @return Activation Collection
	 */
	public function activation() {
		return $this -> morphOne('Activation', 'activable');
	}

	/**
	 * The Course the student belongs to
	 * @return Course Collection
	 */
	public function course() {
		return $this -> belongsTo('Course');
	}

}
