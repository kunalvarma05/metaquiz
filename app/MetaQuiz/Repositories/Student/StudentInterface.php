<?php
namespace MetaQuiz\Repositories\Student;

interface StudentInterface {

	/**
	 * all Fetch all the Students
	 * @param  array $with Related Models for Eager Loading
	 * @return Object The Student Collection
	 */
	public function all($with = array());

	/**
	 * byID Find Student by ID
	 * @param  Integer $id   The ID of the Student
	 * @param  array  $with Related Models for Eager Loading
	 * @return Object The Student Collection
	 */
	public function byID($id, $with = array());

	/**
	 * requireByID Get a single Student by ID and show if not found
	 * @param Integer ID of the Student
	 * @param Array $with [Related Models for Eager Loading]
	 * @return Object Student Collection
	 */
	public function requireByID($id, $with = array());

	/**
	 * byGrNo Get a Single Student by GrNo
	 * @param string $GrNo GrNo of the Student
	 * @return Object Student Collection
	 */
	public function byGrNo($GrNo, $with = array());

	/**
	 * create Create a Student
	 * @param Array $input Input Data to be stored
	 * @return The Newly created Student Model Instance
	 */
	public function create(array $input);

}
