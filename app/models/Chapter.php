<?php
use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;
/**
 * The Chapter Class
 */
class Chapter extends \Eloquent implements SluggableInterface {
	//The Sluggable Trait
	use SluggableTrait;

	/**
	 * The fillable fields
	 */
	protected $fillable = array('name', 'description', 'subject_id', 'slug');

	protected $sluggable = array('build_from' => 'name', 'save_to' => 'slug', );

	/**
	 * The Subject the Chapter belongs to
	 * @return Subject Collection
	 */
	public function subject() {
		return $this -> belongsTo('Subject', 'subject_id');
	}

	/**
	 * Questions in the Chapter
	 * @return Question Collection
	 */
	public function questions() {
		return $this -> hasMany('Question', 'chapter_id');
	}

}
