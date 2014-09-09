<?php
namespace MetaQuiz\Repositories\Activity;

use MetaQuiz\Repositories\AbstractEloquentRepository;
use MetaQuiz\Service\Cache\CacheInterface;
use Illuminate\Database\Eloquent\Model;

class EloquentActivity extends AbstractEloquentRepository implements ActivityInterface {

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
	 * __construct Create a new Eloquent Activity
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
	 * all Fetch all the Activitys
	 * @param  array $with Related Models for Eager Loading
	 * @return Object The Activity Collection
	 */
	public function all($with = array()) {
		//Generate the key
		$key = md5('activities.all');
		//Check if it already exists
		if ($this -> cache -> has($key)) {
			//Return from cache
			return $this -> cache -> get($key);
		}
		//Else query the data source
		$Activitys = parent::all($with);
		//Store Cache
		$this -> cache -> put($key, $Activitys);
		//And return
		return $Activitys;
	}

	/**
	 * The WhereIn Database Builder Method
	 * @param  String $field   Field to Query
	 * @param  Closure $closure
	 */
	public function whereIn($field, $closure){
		return $this->model->whereIn($field, $closure);
	}
		/**
		 * create Create a Activity
		 * @param Array $input Input Data to be stored
		 * @return The Newly created Activity Model Instance
		 */
		public function create(array $input) {
			//Return the Model Create method
			return $this -> model -> create($input);
		}

	}
