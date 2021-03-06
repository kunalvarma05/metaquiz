<?php

/**
 * The Question Class
 */
class Question extends \Eloquent {
	/**
	 * The Fillable Fields
	 */
	protected $fillable = array('title','chapter_id');

	/**
	 * The Chapter the Question belongs to
	 * @return Chapter Collection
	 */
	public function chapter() {
		return $this -> belongsTo('Chapter', 'chapter_id');
	}

	/**
	 * The Options of this Question
	 * @return Option Collection
	 */
	public function options() {
		return $this -> hasMany('Option', 'question_id');
	}

	/**
	 * The Quizes the Question belongs tom
	 * @return Quiz Collection
	 */
	public function quizes() {
		return $this -> belongsToMany('Quiz');
	}

}
