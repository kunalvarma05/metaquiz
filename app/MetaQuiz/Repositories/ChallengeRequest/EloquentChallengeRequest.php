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
	 * Accept a given challenge request
	 * @param  int $id ID of the ChallengeRequest
	 * @return Object ChallengeRequest     Collection
	 */
	public function accept($id){
		$request = $this->model->findOrFail($id);
		$request->status = "accepted";
		return $request->save();
	}

	/**
	 * Reject a given challenge request
	 * @param  int $id ID of the ChallengeRequest
	 * @return Object ChallengeRequest     Collection
	 */
	public function reject($id){
		$request = $this->model->findOrFail($id);
		$request->status = "rejected";
		return $request->save();
	}

}
