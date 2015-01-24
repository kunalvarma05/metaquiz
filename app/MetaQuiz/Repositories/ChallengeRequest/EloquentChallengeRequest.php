<?php
namespace MetaQuiz\Repositories\ChallengeRequest;

use MetaQuiz\Repositories\AbstractEloquentRepository;
use MetaQuiz\Service\Cache\CacheInterface;
use Illuminate\Database\Eloquent\Model;

class EloquentChallengeRequest extends AbstractEloquentRepository implements ChallengeRequestInterface {

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
	 * __construct Create a new Eloquent ChallengeRequest
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
	 * all Fetch all the ChallengeRequests
	 * @param  array $with Related Models for Eager Loading
	 * @return Object The ChallengeRequest Collection
	 */
	public function all($with = array()) {
		//Generate the key
		$key = md5('challenges.all');
		//Check if it already exists
		if ($this -> cache -> has($key)) {
			//Return from cache
			return $this -> cache -> get($key);
		}
		//Else query the data source
		$challenges = parent::all($with);
		//Store Cache
		$this -> cache -> put($key, $challenges);
		//And return
		return $challenges;
	}

	/**
	 * create Create a ChallengeRequest
	 * @param Array $input Input Data to be stored
	 * @return The Newly created ChallengeRequest Model Instance
	 */
	public function create(array $input) {
		//Return the Model Create method
		return $this -> model -> create($input);
	}

}
