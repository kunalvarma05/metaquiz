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
	 * create Create a Challenge
	 * @param Array $input Input Data to be stored
	 * @return The Newly created Challenge Model Instance
	 */
	public function create(array $input) {
		//Return the Model Create method
		return $this -> model -> create($input);
	}

}
