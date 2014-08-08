<?php
namespace MetaQuiz\Repositories\Organization;

use MetaQuiz\Service\Cache\CacheInterface;
use Illuminate\Database\Eloquent\Model;

class EloquentOrganization implements OrganizationInterface {

	//The Org object
	protected $org;

	//The User Object
	protected $user;

	//The Cache Object
	protected $cache;

	//Class Dependency: Eloquent Model
	public function __construct(Model $org, Model $user, CacheInterface $cache) {
		//Set the object
		$this -> org = $org;
		$this -> user = $user;
		$this -> cache = $cache;
	}

	/**
	 * All
	 * Get All the Organizations
	 * @return object Object of the Organizations information
	 */
	public function all() {
		return $this -> org -> all();
	}

	/**
	 * byID
	 * Get a Single Organization by ID
	 * @param Integer ID of the Organization
	 * @return object Object of Organization information
	 */
	public function byID($id) {
		return $this -> org -> findOrFail($id);
	}

	/**
	 * bySlug
	 * Get a Single Organization by Slug
	 * @param string Slug of the Organization
	 * @return object Object of Organization information
	 */
	public function bySlug($slug) {
		return $this -> org -> where('slug', $slug) -> first();
	}

	/**
	 * getTeachers
	 * Get a the teachers of the Organization
	 * @param Integer ID of the Organization
	 * @return object Object of Organization information
	 */
	public function getTeachers($id) {
		return $this -> org -> findOrFail($id) -> teachers() -> get();
	}

	/**
	 * getStudents
	 * Get a the students of the Organization
	 * @param Integer ID of the Organization
	 * @return object Object of Organization information
	 */
	public function getStudents($id) {
		return $this -> org -> findOrFail($id) -> students() -> get();
	}

	/**
	 * getCourses
	 * Get a the courses of the Organization
	 * @param Integer ID of the Organization
	 * @return object Object of Organization information
	 */
	public function getCourses($id) {
		return $this -> org -> findOrFail($id) -> courses() -> get();
	}

	/**
	 * Create
	 * Create a Organization
	 * @param Input Data to be stored
	 * @return bool
	 */
	public function create(array $input) {
	}

}
