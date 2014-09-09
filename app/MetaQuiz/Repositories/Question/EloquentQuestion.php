<?php
namespace MetaQuiz\Repositories\Question;

use MetaQuiz\Repositories\AbstractEloquentRepository;
use MetaQuiz\Service\Cache\CacheInterface;
use Illuminate\Database\Eloquent\Model;

class EloquentQuestion extends AbstractEloquentRepository implements QuestionInterface {

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
	 * __construct Create a new Eloquent Question
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
	 * all Fetch all the Questions
	 * @param  array $with Related Models for Eager Loading
	 * @return Object The Question Collection
	 */
	public function all($with = array()) {
		//Generate the key
		$key = md5('questions.all');
		//Check if it already exists
		if ($this -> cache -> has($key)) {
			//Return from cache
			return $this -> cache -> get($key);
		}
		//Else query the data source
		$questions = parent::all($with);
		//Store Cache
		$this -> cache -> put($key, $questions);
		//And return
		return $questions;
	}

	/**
	 * create Create a Question
	 * @param Array $input Input Data to be stored
	 * @return The Newly created Question Model Instance
	 */
	public function create(array $input) {
		//Return the Model Create method
		return $this -> model -> create($input);
	}

}
