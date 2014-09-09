<?php
namespace MetaQuiz\Repositories\Course;

use MetaQuiz\Repositories\AbstractEloquentRepository;
use MetaQuiz\Service\Cache\CacheInterface;
use Illuminate\Database\Eloquent\Model;

class EloquentCourse extends AbstractEloquentRepository implements CourseInterface {

	/**
	 * $model The Eloquent model
	 * @var Illuminate\Database\Eloquent\Model
	 */
	protected $model;

	/**
	 * $cache The Cache Interface
	 * @var MetaQuiz\Service\Cache\CacheInterface
	 */
	protected $cache;

	/**
	 * __construct Create a new Eloquent Course
	 * @param Illuminate\Database\Eloquent\Model          $model The Eloquent Model
	 * @param MetaQuiz\Service\Cache\CacheInterface $cache The Cache Interface
	 * @return void
	 */
	public function __construct(Model $model, CacheInterface $cache) {
		//Set the object
		$this -> model = $model;
		$this -> cache = $cache;
	}

	/**
	 * all Fetch all the Courses
	 * @param  array $with Related Models for Eager Loading
	 * @return Object The Course Collection
	 */
	public function all($with = array()) {
		//Generate the key
		$key = md5('courses.all');
		//Check if it already exists
		if ($this -> cache -> has($key)) {
			//Return from cache
			return $this -> cache -> get($key);
		}
		//Else query the data source
		$Courses = parent::all($with);
		//Store Cache
		$this -> cache -> put($key, $Courses);
		//And return
		return $Courses;
	}

	/**
	 * bySlug Get a Single Course by Slug
	 * @param string $slug Slug of the Course
	 * @return Object Course Collection
	 */
	public function bySlug($slug, $with = array()) {
		//Else query the data source
		$Course = $this -> getFirstBy('slug', $slug, $with);
		//Return
		return $Course;
	}

	/**
	 * create Create a Course
	 * @param Array $input Input Data to be stored
	 * @return The Newly created Course Model Instance
	 */
	public function create(array $input) {
		//Return the Model Create method
		return $this -> model -> create($input);
	}

}
