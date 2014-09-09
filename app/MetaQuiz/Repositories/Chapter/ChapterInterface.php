<?php
namespace MetaQuiz\Repositories\Chapter;

interface ChapterInterface {

	/**
	 * all Fetch all the Chapters
	 * @param  array $with Related Models for Eager Loading
	 * @return Object The Chapter Collection
	 */
	public function all($with = array());

	/**
	 * byID Find Chapter by ID
	 * @param  Integer $id   The ID of the Chapter
	 * @param  array  $with Related Models for Eager Loading
	 * @return Object The Chapter Collection
	 */
	public function byID($id, $with = array());

	/**
	 * requireByID Get a single Chapter by ID and show if not found
	 * @param Integer ID of the Chapter
	 * @param Array $with [Related Models for Eager Loading]
	 * @return Object Chapter Collection
	 */
	public function requireByID($id, $with = array());

	/**
	 * bySlug Get a Single Chapter by Slug
	 * @param string $slug Slug of the Chapter
	 * @return Object Chapter Collection
	 */
	public function bySlug($slug, $with = array());

	/**
	 * create Create a Chapter
	 * @param Array $input Input Data to be stored
	 * @return The Newly created Chapter Model Instance
	 */
	public function create(array $input);

}
