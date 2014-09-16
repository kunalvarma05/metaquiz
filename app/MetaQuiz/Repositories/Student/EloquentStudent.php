<?php
namespace MetaQuiz\Repositories\Student;

use MetaQuiz\Repositories\AbstractEloquentRepository;
use MetaQuiz\Service\Cache\CacheInterface;
use Illuminate\Database\Eloquent\Model;

class EloquentStudent extends AbstractEloquentRepository implements StudentInterface {

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
	 * __construct Create a new Eloquent Student
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
	 * all Fetch all the faculties
	 * @param  array $with Related Models for Eager Loading
	 * @return Object The Student Collection
	 */
	public function all($with = array()) {
		//Generate the key
		$key = md5('faculties.all');
		//Check if it already exists
		if ($this -> cache -> has($key)) {
			//Return from cache
			return $this -> cache -> get($key);
		}
		//Else query the data source
		$faculties = parent::all($with);
		//Store Cache
		$this -> cache -> put($key, $faculties);
		//And return
		return $faculties;
	}

	/**
	 * byGrNo Get a Single Student by GrNo
	 * @param string $GrNo GrNo of the Student
	 * @return Object Student Collection
	 */
	public function byGrNo($GrNo, $with = array()) {
		//Else query the data source
		$Student = $this -> getFirstBy('gr_no', $GrNo, $with);
		//Return
		return $Student;
	}

	/**
	 * create Create a Student
	 * @param Array $input Input Data to be stored
	 * @return The Newly created Student Model Instance
	 */
	public function create(array $input) {
		//Return the Model Create method
		return $this -> model -> create($input);
	}

}