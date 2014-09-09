<?php
namespace MetaQuiz\Repositories\Activity;

interface ActivityInterface {

	/**
	 * All
	 * Get All the Activities
	 * @return object Activity Collection
	 */
	public function all($with = array());

	/**
	 * byID
	 * Get a Single Activity by ID
	 * @param Integer ID of the Activity
	 * @param array Related Models for Eager Loading
	 * @return object  Activity Collection
	 */
	public function byID($id, $with = array());

	/**
	 * requireByID Get a single Activity by ID and show if not found
	 * @param Integer ID of the Activity
	 * @param Array $with [Related Models for Eager Loading]
	 * @return Object Activity Collection
	 */
	public function requireByID($id, $with = array());

	/**
	 * Create
	 * Create a Activity
	 * @param Input Data to be stored
	 * @return bool
	 */
	public function create(array $input);

}
