<?php
namespace MetaQuiz\Repositories\Answer;

use MetaQuiz\Repositories\AbstractEloquentRepository;
use MetaQuiz\Service\Cache\CacheInterface;
use Illuminate\Database\Eloquent\Model;

class EloquentAnswer extends AbstractEloquentRepository implements AnswerInterface {

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
	 * __construct Create a new Eloquent Answer
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
	 * all Fetch all the Answers
	 * @param  array $with Related Models for Eager Loading
	 * @return Object The Answer Collection
	 */
	public function all($with = array()) {
		//Generate the key
		$key = md5('answers.all');
		//Check if it already exists
		if ($this -> cache -> has($key)) {
			//Return from cache
			return $this -> cache -> get($key);
		}
		//Else query the data source
		$answers = parent::all($with);
		//Store Cache
		$this -> cache -> put($key, $answers);
		//And return
		return $answers;
	}

	/**
	 * byUserID Get a Single Answer by UserID
	 * @param string $user_id UserID of the Answer
	 * @return Object Answer Collection
	 */
	public function byUserID($user_id, $with = array()) {
		//Else query the data source
		$answer = $this -> getFirstBy('user_id', $user_id, $with);
		//Return
		return $answer;
	}

	/**
	 * byQuizID Get a Single Answer by QuizID
	 * @param string $quiz_id QuizID of the Answer
	 * @return Object Answer Collection
	 */
	public function byQuizID($quiz_id, $with = array()) {
		//Else query the data source
		$answers = $this -> getManyBy('quiz_id', $quiz_id, $with);
		//Return
		return $answers;
	}

	/**
	 * create Create a Answer
	 * @param Array $input Input Data to be stored
	 * @return The Newly created Answer Model Instance
	 */
	public function create(array $input) {
		//Return the Model Create method
		return $this -> model -> create($input);
	}

}
