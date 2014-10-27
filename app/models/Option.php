<?php

/**
 * 	The Option Class
 */
class Option extends \Eloquent {
	/**
	 * The Fillable Fields
	 */
	protected $fillable = array('title','is_answer','question_id');

	/**
	 * The Hidden Fields
	 */
	protected $hidden = array('is_answer');

	/**
	 * The Question the option belongs to
	 * @return Question Collection
	 */
	public function question() {
		return $this -> belongsTo('Question', 'question_id');
	}

}
