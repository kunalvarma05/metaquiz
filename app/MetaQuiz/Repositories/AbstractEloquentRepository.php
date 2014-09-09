<?php
namespace MetaQuiz\Repositories;

abstract class AbstractEloquentRepository {

	/**
	 * Make a new instance of the entity to query on
	 *
	 * @param array $with
	 */
	public function make($with = array()) {
		return $this -> model -> with($with);
	}

	/**
	 * Return all results that have a required relationship
	 *
	 * @param string $relation
	 */
	public function has($relation, $with = array()) {
		$entity = $this -> make($with);

		return $entity -> has($relation) -> get();
	}

	/**
	 * Return all users
	 *
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public function all($with = array()) {
		$query = $this -> make($with);
		return $query -> get();
	}

	/**
	 * Find an entity by id
	 *
	 * @param int $id
	 * @return Illuminate\Database\Eloquent\Model
	 */
	public function byID($id, $with = array()) {
		$query = $this -> make($with);
		return $query -> find($id);
	}

	/**
	 * Find an entity by id or show error if not found
	 *
	 * @param int $id
	 * @return Illuminate\Database\Eloquent\Model
	 */
	public function requireByID($id, $with = array()) {
		$model = $this -> byID($id, $with);
		if (!$model) {
			throw new EntityNotFoundException("Entity with id {$id} could not be found.");
		}
		return $model;
	}

	/**
	 * Find a single entity by key value
	 *
	 * @param string $key
	 * @param string $value
	 * @param array $with
	 */
	public function getFirstBy($key, $value, $with = array()) {
		return $this -> make($with) -> where($key, '=', $value) -> first();
	}

	/**
	 * Find many entities by key value
	 *
	 * @param string $key
	 * @param string $value
	 * @param array $with
	 */
	public function getManyBy($key, $value, $with = array()) {
		return $this -> make($with) -> where($key, '=', $value) -> get();
	}

	/**
	 * Get Results by Page
	 *
	 * @param int $page
	 * @param int $limit
	 * @param array $with
	 * @return StdClass Object with $items and $totalItems for pagination
	 */
	public function getByPage($page = 1, $limit = 10, $with = array()) {
		$result = new StdClass;
		$result -> page = $page;
		$result -> limit = $limit;
		$result -> totalItems = 0;
		$result -> items = array();

		$query = $this -> make($with);

		$model = $query -> skip($limit * ($page - 1)) -> take($limit) -> get();

		$result -> totalItems = $this -> model -> count();
		$result -> items = $model -> all();

		return $result;
	}

}
