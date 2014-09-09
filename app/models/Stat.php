<?php

/**
 * The Stat Class
 */
class Stat extends \Eloquent {
	/**
	 * The Fillable Fields
	 */
	protected $fillable = array();

	/**
	 * The User the Stat belongs to
	 * @return User Collection
	 */
	public function user() {
		return $this -> belongsTo('User');
	}

}
