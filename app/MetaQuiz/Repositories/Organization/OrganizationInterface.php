<?php
namespace MetaQuiz\Repositories\Organization;

interface OrganizationInterface {

	/**
	 * all Fetch all the organizations
	 * @param  array $with Related Models for Eager Loading
	 * @return Object The Organization Collection
	 */
	public function all($with = array());

	/**
	 * byID Find Organization by ID
	 * @param  Integer $id   The ID of the Organization
	 * @param  array  $with Related Models for Eager Loading
	 * @return Object The Organization Collection
	 */
	public function byID($id, $with = array());

	/**
	 * requireByID Get a single organization by ID and show if not found
	 * @param Integer ID of the organization
	 * @param Array $with [Related Models for Eager Loading]
	 * @return Object Organization Collection
	 */
	public function requireByID($id, $with = array());

	/**
	 * bySlug Get a Single organization by Slug
	 * @param string $slug Slug of the organization
	 * @return Object Organization Collection
	 */
	public function bySlug($slug, $with = array());	

	/**
	 * create Create a organization
	 * @param Array $input Input Data to be stored
	 * @return The Newly created Organization Model Instance
	 */
	public function create(array $input);

}
