<?php
namespace MetaQuiz\Repositories\Challenge;

use MetaQuiz\Repositories\AbstractEloquentRepository;
use MetaQuiz\Service\Cache\CacheInterface;
use Illuminate\Database\Eloquent\Model;

class EloquentChallenge extends AbstractEloquentRepository implements ChallengeInterface {

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
	 * __construct Create a new Eloquent Challenge
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
	 * byQuizID Find Challenge by QuizID
	 * @param  Integer $quiz_id   The QuizID of the Challenge
	 * @param  array  $with Related Models for Eager Loading
	 * @return Object The Challenge Collection
	 */
	public function byQuizID($quiz_id, $with = array()){
		return $this->getFirstBy('quiz_id', $quiz_id);
	}

}
