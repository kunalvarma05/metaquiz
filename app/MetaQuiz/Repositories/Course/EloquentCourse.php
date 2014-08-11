<?php
namespace MetaQuiz\Repositories\Course;

use MetaQuiz\Service\Cache\CacheInterface;
use Illuminate\Database\Eloquent\Model;

class EloquentCourse implements CourseInterface {

	/**
	 * The Course object
	 * @var $course
	 */
	protected $course;

	/**
	 * The User Object
	 * @var $user
	 */
	protected $user;

	/**
	 * The Cache Object
	 * @var $cache
	 */
	protected $cache;

	//Class Dependency: Eloquent Model
	public function __construct(Model $course, Model $user, CacheInterface $cache) {
		//Set the object
		$this -> course = $course;
		$this -> user = $user;
		$this -> cache = $cache;
	}

	/**
	 * All
	 * Get All the courses
	 * @return object Object of the courses information
	 */
	public function all() {
		return $this -> course -> all();
	}

	/**
	 * byID
	 * Get a Single course by ID
	 * @param Integer ID of the course
	 * @return object Object of course information
	 */
	public function byID($id) {
		return $this -> course -> findOrFail($id);
	}

	/**
	 * bySlug
	 * Get a Single course by Slug
	 * @param string Slug of the course
	 * @return object Object of course information
	 */
	public function bySlug($slug) {
		return $this -> course -> where('slug', $slug) -> first();
	}

	/**
	 * getCourses
	 * Get a the subjects of the course
	 * @param Integer ID of the subjects
	 * @return object Object of subject information
	 */
	public function getSubjects($id) {
		return $this -> course -> findOrFail($id) -> subjects() -> get();
	}

	/**
	 * Create
	 * Create a course
	 * @param Input Data to be stored
	 * @return The Created Model Instance
	 */
	public function create(array $input) {
		return $this -> course -> create($input);
	}

}
