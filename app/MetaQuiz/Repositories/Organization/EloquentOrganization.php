<?php
namespace MetaQuiz\Repositories\Organization;

use MetaQuiz\Repositories\AbstractEloquentRepository;
use MetaQuiz\Service\Cache\CacheInterface;
use Illuminate\Database\Eloquent\Model;

class EloquentOrganization extends AbstractEloquentRepository implements OrganizationInterface {

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
	 * __construct Create a new Eloquent Organization
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
	 * all Fetch all the organizations
	 * @param  array $with Related Models for Eager Loading
	 * @return Object The Organization Collection
	 */
	public function all($with = array()) {
		//Generate the key
		$key = md5('organziations.all');
		//Check if it already exists
		if ($this -> cache -> has($key)) {
			//Return from cache
			return $this -> cache -> get($key);
		}
		//Else query the data source
		$organizations = parent::all($with);
		//Store Cache
		$this -> cache -> put($key, $organizations);
		//And return
		return $organizations;
	}	

	/**
	 * bySlug Get a Single organization by Slug
	 * @param string $slug Slug of the organization
	 * @return Object Organization Collection
	 */
	public function bySlug($slug, $with = array()) {			
		//Else query the data source
		$organization = $this -> getFirstBy('slug', $slug, $with);
		//Return		
		return $organization;
	}	

	/**
	 * create Create a organization
	 * @param Array $input Input Data to be stored
	 * @return The Newly created Organization Model Instance
	 */
	public function create(array $input) {
		//Return the Model Create method
		return $this -> model -> create($input);
	}

}
