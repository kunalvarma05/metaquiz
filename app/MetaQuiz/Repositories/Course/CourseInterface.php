<?php
namespace MetaQuiz\Repositories\Course;

interface CourseInterface {

	/**
	 * All
	 * Get All the courses
	 * @return object Object of the courses information
	 */
	public function all();

	/**
	 * byID
	 * Get a Single course by ID
	 * @param Integer ID of the course
	 * @return object Object of course information
	 */
	public function byID($id);

	/**
	 * bySlug
	 * Get a Single course by Slug
	 * @param string Slug of the course
	 * @return object Object of course information
	 */
	public function bySlug($slug);

	/**
	 * getSubjects
	 * Get a the subjects of the course
	 * @param Integer ID of the course
	 * @return object Object of subject information
	 */
	public function getSubjects($id);

	/**
	 * Create
	 * Create a course
	 * @param Input Data to be stored
	 * @return bool
	 */
	public function create(array $input);

}
