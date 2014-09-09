<?php
use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;
/**
 * The Subject Class
 */
class Subject extends \Eloquent implements SluggableInterface {
	//The Sluggable Trait
	use SluggableTrait;

	/**
	 * The Fillable Fields
	 */
	protected $fillable = array('name','description','slug', 'course_id');

	protected $sluggable = array('build_from' => 'name', 'save_to' => 'slug', );

	/**
	 * The Course the subject belongs to
	 * @return Course Collection
	 */
	public function course() {
		return $this -> belongsTo('Course', 'course_id');
	}

	/**
	 * The Chapters that belongs to this subject
	 * @return Chapter Collection
	 */
	public function chapters() {
		return $this -> hasMany('Chapter', 'subject_id');
	}

	/**
	 * The Faculties that belong to this subject
	 * @return Faculty Collection
	 */
	public function faculties() {
		return $this -> belongsToMany('Faculty');
	}

}
