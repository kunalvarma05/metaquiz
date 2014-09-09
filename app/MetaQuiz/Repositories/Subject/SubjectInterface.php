<?php
namespace MetaQuiz\Repositories\Subject;

interface SubjectInterface {

	/**
	 * all Fetch all the Subjects
	 * @param  array $with Related Models for Eager Loading
	 * @return Object The Subject Collection
	 */
	public function all($with = array());

	/**
	 * byID Find Subject by ID
	 * @param  Integer $id   The ID of the Subject
	 * @param  array  $with Related Models for Eager Loading
	 * @return Object The Subject Collection
	 */
	public function byID($id, $with = array());

	/**
	 * requireByID Get a single Subject by ID and show if not found
	 * @param Integer ID of the Subject
	 * @param Array $with [Related Models for Eager Loading]
	 * @return Object Subject Collection
	 */
	public function requireByID($id, $with = array());

	/**
	 * bySlug Get a Single Subject by Slug
	 * @param string $slug Slug of the Subject
	 * @return Object Subject Collection
	 */
	public function bySlug($slug, $with = array());

	/**
	 * create Create a Subject
	 * @param Array $input Input Data to be stored
	 * @return The Newly created Subject Model Instance
	 */
	public function create(array $input);

}
