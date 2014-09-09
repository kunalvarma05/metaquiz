<?php
use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;
/**
 * The Course Class
 */
class Course extends \Eloquent implements SluggableInterface{
	//The Sluggable Trait
	use SluggableTrait;

	/**
	 * The fillable fields
	 */
	protected $fillable = array('name', 'description', 'picture', 'organization_id');

	protected $sluggable = array('build_from' => 'name', 'save_to' => 'slug', );

	/**
	 * The Organization the course belongs to
	 * @return Organization Collection
	 */
	public function organization() {
		return $this -> belongsTo('Organization');
	}

	/**
	 * The Subjects in the Course
	 * @return Subject Collection
	 */
	public function subjects() {
		return $this -> hasMany('Subject', 'course_id');
	}

}
