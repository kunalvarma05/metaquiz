<?php
namespace MetaQuiz\Repositories\Organization;

interface OrganizationInterface {

	/**
	 * All
	 * Get All the Organizations
	 * @return object Object of the Organizations information
	 */
	public function all();

	/**
	 * byID
	 * Get a Single Organization by ID
	 * @param Integer ID of the Organization
	 * @return object Object of Organization information
	 */
	public function byID($id);

	/**
	 * bySlug
	 * Get a Single Organization by Slug
	 * @param string Slug of the Organization
	 * @return object Object of Organization information
	 */
	public function bySlug($slug);

	/**
	 * getTeachers
	 * Get a the teachers of the Organization
	 * @param Integer ID of the Organization
	 * @return object Object of Organization information
	 */
	public function getTeachers($id);

	/**
	 * getStudents
	 * Get a the students of the Organization
	 * @param Integer ID of the Organization
	 * @return object Object of Organization information
	 */
	public function getStudents($id);

	/**
	 * getCourses
	 * Get a the courses of the Organization
	 * @param Integer ID of the Organization
	 * @return object Object of Organization information
	 */
	public function getCourses($id);

	/**
	 * Create
	 * Create a Organization
	 * @param Input Data to be stored
	 * @return bool
	 */
	public function create(array $input);

}
