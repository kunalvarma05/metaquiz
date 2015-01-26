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

}
