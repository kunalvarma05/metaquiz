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

}
