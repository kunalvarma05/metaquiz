<?php
namespace MetaQuiz\Repositories\Faculty;

interface FacultyInterface {

	/**
	 * all Fetch all the Facultys
	 * @param  array $with Related Models for Eager Loading
	 * @return Object The Faculty Collection
	 */
	public function all($with = array());

	/**
	 * byID Find Faculty by ID
	 * @param  Integer $id   The ID of the Faculty
	 * @param  array  $with Related Models for Eager Loading
	 * @return Object The Faculty Collection
	 */
	public function byID($id, $with = array());

	/**
	 * requireByID Get a single Faculty by ID and show if not found
	 * @param Integer ID of the Faculty
	 * @param Array $with [Related Models for Eager Loading]
	 * @return Object Faculty Collection
	 */
	public function requireByID($id, $with = array());

	/**
	 * byGrNo Get a Single Faculty by GrNo
	 * @param string $GrNo GrNo of the Faculty
	 * @return Object Faculty Collection
	 */
	public function byGrNo($GrNo, $with = array());

	/**
	 * create Create a Faculty
	 * @param Array $input Input Data to be stored
	 * @return The Newly created Faculty Model Instance
	 */
	public function create(array $input);

}
