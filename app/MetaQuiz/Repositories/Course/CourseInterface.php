<?php
namespace MetaQuiz\Repositories\Course;

interface CourseInterface {

	/**
	 * all Fetch all the Courses
	 * @param  array $with Related Models for Eager Loading
	 * @return Object The Course Collection
	 */
	public function all($with = array());

	/**
	 * byID Find Course by ID
	 * @param  Integer $id   The ID of the Course
	 * @param  array  $with Related Models for Eager Loading
	 * @return Object The Course Collection
	 */
	public function byID($id, $with = array());

	/**
	 * requireByID Get a single Course by ID and show if not found
	 * @param Integer ID of the Course
	 * @param Array $with [Related Models for Eager Loading]
	 * @return Object Course Collection
	 */
	public function requireByID($id, $with = array());

	/**
	 * bySlug Get a Single Course by Slug
	 * @param string $slug Slug of the Course
	 * @return Object Course Collection
	 */
	public function bySlug($slug, $with = array());	

	/**
	 * create Create a Course
	 * @param Array $input Input Data to be stored
	 * @return The Newly created Course Model Instance
	 */
	public function create(array $input);

}
