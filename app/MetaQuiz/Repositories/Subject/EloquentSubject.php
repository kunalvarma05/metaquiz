<?php
namespace MetaQuiz\Repositories\Subject;

use MetaQuiz\Repositories\AbstractEloquentRepository;
use MetaQuiz\Service\Cache\CacheInterface;
use Illuminate\Database\Eloquent\Model;

class EloquentSubject extends AbstractEloquentRepository implements SubjectInterface {

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
	 * __construct Create a new Eloquent Subject
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
	 * all Fetch all the Subjects
	 * @param  array $with Related Models for Eager Loading
	 * @return Object The Subject Collection
	 */
	public function all($with = array()) {
		//Generate the key
		$key = md5('subjects.all');
		//Check if it already exists
		if ($this -> cache -> has($key)) {
			//Return from cache
			return $this -> cache -> get($key);
		}
		//Else query the data source
		$subjects = parent::all($with);
		//Store Cache
		$this -> cache -> put($key, $subjects);
		//And return
		return $subjects;
	}

	/**
	 * bySlug Get a Single Subject by Slug
	 * @param string $slug Slug of the Subject
	 * @return Object Subject Collection
	 */
	public function bySlug($slug, $with = array()) {
		//Else query the data source
		$subject = $this -> getFirstBy('slug', $slug, $with);
		//Return
		return $subject;
	}

	/**
	 * create Create a Subject
	 * @param Array $input Input Data to be stored
	 * @return The Newly created Subject Model Instance
	 */
	public function create(array $input) {
		//Return the Model Create method
		return $this -> model -> create($input);
	}

}
