<?php
namespace MetaQuiz\Repositories\Faculty;

use MetaQuiz\Repositories\AbstractEloquentRepository;
use MetaQuiz\Service\Cache\CacheInterface;
use Illuminate\Database\Eloquent\Model;

class EloquentFaculty extends AbstractEloquentRepository implements FacultyInterface {

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
	 * __construct Create a new Eloquent Faculty
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
	 * byGrNo Get a Single Faculty by GrNo
	 * @param string $GrNo GrNo of the Faculty
	 * @return Object Faculty Collection
	 */
	public function byGrNo($GrNo, $with = array()) {
		//Else query the data source
		$faculty = $this -> getFirstBy('gr_no', $GrNo, $with);
		//Return
		return $faculty;
	}

}
