<?php
namespace MetaQuiz\Repositories\Quiz;

use MetaQuiz\Repositories\AbstractEloquentRepository;
use MetaQuiz\Service\Cache\CacheInterface;
use Illuminate\Database\Eloquent\Model;

class EloquentQuiz extends AbstractEloquentRepository implements QuizInterface {

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
	 * __construct Create a new Eloquent Quiz
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
	 * all Fetch all the Quizs
	 * @param  array $with Related Models for Eager Loading
	 * @return Object The Quiz Collection
	 */
	public function all($with = array()) {
		//Generate the key
		$key = md5('quizes.all');
		//Check if it already exists
		if ($this -> cache -> has($key)) {
			//Return from cache
			return $this -> cache -> get($key);
		}
		//Else query the data source
		$quizes = parent::all($with);
		//Store Cache
		$this -> cache -> put($key, $quizes);
		//And return
		return $quizes;
	}

	/**
	 * byUserID Get a Single Quiz by UserID
	 * @param string $user_id UserID of the Quiz
	 * @return Object Quiz Collection
	 */
	public function byUserID($user_id, $with = array()) {
		//Else query the data source
		$quiz = $this -> getFirstBy('user_id', $user_id, $with);
		//Return
		return $quiz;
	}

	/**
	 * create Create a Quiz
	 * @param Array $input Input Data to be stored
	 * @return The Newly created Quiz Model Instance
	 */
	public function create(array $input) {
		//Return the Model Create method
		return $this -> model -> create($input);
	}

}
