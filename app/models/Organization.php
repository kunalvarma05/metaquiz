<?php
use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;
/**
 * The Organization Class
 */
class Organization extends \Eloquent implements SluggableInterface {
	//The Sluggable Trait
	use SluggableTrait;

	/**
	 * The Fillable Fields
	 */
	protected $fillable = array('name','description','picture','slug');

	protected $sluggable = array('build_from' => 'name', 'save_to' => 'slug', );

	/**
	 * The Students of this Organization
	 * @return User Collection
	 */
	public function students() {
		return $this -> hasMany('User', 'organization_id')->where('accountable_type', 'Student');
	}

	/**
	 * The Faculty of this Organization
	 * @return User Collection
	 */
	public function faculties() {
		return $this -> hasMany('User', 'organization_id')->where('accountable_type', 'Faculty');
	}

	/**
	 * The Manager of this Organization
	 * @return User Collection
	 */
	public function manager() {
		return $this -> hasOne('User', 'organization_id')->where('accountable_type', 'Manager');
	}

	/**
	 * The Courses of this Organization
	 * @return Course Collection
	 */
	public function courses() {
		return $this -> hasMany('Course', 'organization_id');
	}

}
