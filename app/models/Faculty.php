<?php

/**
 * The Faculty Class
 */
class Faculty extends \Eloquent {
	/**
	 * The Fillable Fields
	 */
	protected $fillable = array('gr_no', 'organization_id');

	/**
	 * The User account
	 * @return User Collection
	 */
	public function profile() {
		return $this -> morphOne('User', 'accountable');
	}

	/**
	 * The Organization the faculty belongs to
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
	 * The Subjects taken by the faculty
	 * @return Subject Collection
	 */
	public function subjects() {
		return $this -> belongsToMany('Subject');
	}

}
