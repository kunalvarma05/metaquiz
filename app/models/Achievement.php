<?php
/**
 * The Achievement Class
 */
class Achievement extends \Eloquent {
	/**
	 * The fillable fields
	 * Array
	 */
	protected $fillable = array();

	/**
	 * The Users the achievement belongs to
	 * @return User Collection
	 */
	public function users() {
		return $this -> belongsToMany('User');
	}

}
