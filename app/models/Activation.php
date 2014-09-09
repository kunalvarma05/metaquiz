<?php

class Activation extends \Eloquent {
	/**
	 * The Fillable Fields
	 */
	protected $fillable = array('code','activable_id', 'activable_type', 'organization_id');

	/**
	 * The Type of account to be activated
	 * @return Eloquent Collection
	 */
	public function activable() {
		return $this -> morphTo();
	}

	/**
	 * The organization the activation account belongs to
	 * @return Organization Collection
	 */
	public function organization() {
		return $this -> belongsTo('Organization');
	}

}
