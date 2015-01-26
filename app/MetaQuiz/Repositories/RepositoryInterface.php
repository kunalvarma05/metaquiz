<?php
namespace MetaQuiz\Repositories;

interface RepositoryInterface {

	/**
	 * Make a new instance of the entity to query on
	 *
	 * @param array $with
	 */
	public function make($with = array());

	/**
	 * Return all results that have a required relationship
	 *
	 * @param string $relation
	 */
	public function has($relation, $with = array());

	/**
	 * Return all results
	 *
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public function all($with = array());

	/**
	 * Find an entity by id
	 *
	 * @param int $id
	 * @return Illuminate\Database\Eloquent\Model
	 */
	public function byID($id, $with = array());

	/**
	 * Find an entity by id or show error if not found
	 *
	 * @param int $id
	 * @return Illuminate\Database\Eloquent\Model
	 */
	public function requireByID($id, $with = array());

	/**
	 * Find a single entity by key value
	 *
	 * @param string $key
	 * @param string $value
	 * @param array $with
	 */
	public function getFirstBy($key, $value, $with = array());

	/**
	 * Find many entities by key value
	 *
	 * @param string $key
	 * @param string $value
	 * @param array $with
	 */
	public function getManyBy($key, $value, $with = array());

	/**
	 * Get Results by Page
	 *
	 * @param int $page
	 * @param int $limit
	 * @param array $with
	 * @return StdClass Object with $items and $totalItems for pagination
	 */
	public function getByPage($page = 1, $limit = 10, $with = array());

	/**
	 * Create
	 * Create a Resource
	 * @param Input Data to be stored
	 * @return bool
	 */
	public function create(array $input);

}
